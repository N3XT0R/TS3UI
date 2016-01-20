<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id: b2d81a8bf25e49072517211fbb5f2a66930afc53 $
 * $Date$
 */

namespace Server\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\PhpEnvironment\Response;
use TSCore\Enum\GroupDbType;

class VirtualServerController extends AbstractActionController{
    
    protected $oVirtualServerService;
    protected $oServerService;
    
    public function setVirtualServerService($oVirtualServerService){
        $this->oVirtualServerService = $oVirtualServerService;
        return $this;
    }
    
    /**
     * 
     * @return \Server\Service\VirtualServerService
     */
    public function getVirtualServerService(){
        return $this->oVirtualServerService;
    }
    
    public function setServerService($oServerService){
        $this->oServerService = $oServerService;
        return $this;
    }
    /**
     * 
     * @return \Server\Service\ServerService
     */
    public function getServerService(){
        return $this->oServerService;
    }
    
    public function indexAction() {
        $id  = (int)$this->params()->fromRoute("id", 0);
        $virtualID = (int)$this->params()->fromRoute("virtualId", 0);
        
        $oServer = $this->getServerService()->getOneServerById($id);
        if(!$oServer){
            $this->redirect()->toRoute("server");
        }
        
        $oVirtualServer = $this->getVirtualServerService()->getOneVirtualServerById(
            $oServer, $virtualID
        );
        
        return new ViewModel([
            'oServer'            => $oServer,
            'oVirtualServer'     => $oVirtualServer,
        ]);
    }
    
    public function channelListAction(){
        $serverID   = (int)$this->params()->fromRoute("id", 0);
        $virtualID  = (int)$this->params()->fromRoute("virtualId", 0);
        
        $oServer = $this->getServerService()->getOneServerById($serverID);
        
        if(!$oServer){
            $this->redirect()->toRoute("server");
            return false;
        }
        
        $oVirtualServer = $this->getVirtualServerService()->getOneVirtualServerById(
            $oServer, $virtualID
        );
        
        // when virtual server not found or not available redirect to virtualserver list
        if(!$oVirtualServer){
            $this->redirect()->toRoute("server/action", [
                "action"    => "virtualServerList", 
                "id"        => $serverID,
            ]);
            return false;
        }
        
        $aChannels = $this->getVirtualServerService()->getChannels($oVirtualServer);
        
        return new ViewModel([
            'id'                => $serverID,
            'oVirtualServer'    => $oVirtualServer,
            'aChannels'         => $aChannels,
        ]); 
    }
    
    public function editAction(){
        $aGroups                = [];
        $aSimpleChannelGroups   = [];
        $serverID               = (int)$this->params()->fromRoute("id",0);
        $virtualID              = (int)$this->params()->fromRoute("virtualId",0);
        
        $oServer                = $this->getServerService()->getOneServerById($serverID);
        
        if(!$oServer){
            $this->redirect()->toRoute("server");
            return false;
        }
        
        /* @var $oVirtualServer \TeamSpeak3\Node\Server */
        $oVirtualServer = $this->getVirtualServerService()->getOneVirtualServerById(
            $oServer, $virtualID
        );
        
        // when virtual server not found or not available redirect to virtualserver list
        if(!$oVirtualServer){ 
            $this->redirect()->toRoute("server/action", [
                "action"    => "virtualServerList", 
                "id"        => $serverID,
            ]);
            return false;
        }
        
        $aServerGroups = $this->getVirtualServerService()->getServerGroupList($oServer, $virtualID);
        $aChannelGroups = $this->getVirtualServerService()->getChannelGroupList(
            $oServer, 
            $virtualID,
            [
                "type" => GroupDbType::PermGroupTypeGlobalClient,
            ]
        );
        
        foreach($aServerGroups as $oGroup){
            $iSGId = $oGroup->getProperty("sgid");
            $sName = $oGroup->getProperty("name")->toString();
            $aGroups[$iSGId] = $sName;
        }
        
        foreach($aChannelGroups as $oChannelGroup){
            $iCGid = $oChannelGroup->getProperty("cgid");
            $sName = $oChannelGroup->getProperty("name")->toString();
            $aSimpleChannelGroups[$iCGid] = $sName;
        }
        
        $oForm = $this->getVirtualServerService()->getForm("VirtualServerEdit");
        $oForm->get("virtualserver_default_server_group")->setValueOptions($aGroups);
        $oForm->get("virtualserver_default_channel_group")->setValueOptions($aSimpleChannelGroups);
        $oForm->get("virtualserver_default_channel_admin_group")->setValueOptions($aSimpleChannelGroups);

        $aInfo = $oVirtualServer->getInfo();
        $oForm->setData($aInfo);
        
        $sUrl = $this->url()->fromRoute("server/virtual/action", [
            "action"    => "edit",
            "id"        => $serverID,
            "virtualId" => $virtualID,
        ]);
        
        $oPRG = $this->prg($sUrl, true);
        
        if($oPRG instanceof Response){
            return $oPRG;
        }elseif($oPRG !== false){
            $this->getVirtualServerService()->update($oServer, $oPRG, $virtualID);
            $aMessages = $this->getVirtualServerService()->getMessages();
            $this->MessagesToFlashMessenger()->add($aMessages, 1);
            
            /**
             * After succesfull server modification redirect user
             * back to Virtual Server List
             */
            $this->redirect()->toRoute("server/action", [
                "action"        => "virtualServerList",
                "id"            => $serverID,
            ]);
            return true;
        }
        
        //print_R($oVirtualServer); die();
        
        return new ViewModel([
            'serverId'          => $serverID,
            'virtualId'         => $virtualID,
            'oVirtualServer'    => $oVirtualServer,
            'oForm'             => $oForm,
        ]);
    }
    
    public function serverGroupListAction(){
        $serverID   = (int)$this->params()->fromRoute("id",0);
        $virtualID  = (int)$this->params()->fromRoute("virtualId",0);
        
        $oServer = $this->getServerService()->getOneServerById($serverID);
        
        if(!$oServer){
            $this->redirect()->toRoute("server");
            return false;
        }
        
        $aGroups    = $this->getVirtualServerService()->getServerGroupList($oServer, $virtualID);
        
        return new ViewModel([
            'aGroups'       => $aGroups,
        ]);
    }
    
    public function snapshotListAction(){
        $serverID   = (int)$this->params()->fromRoute("id",0);
        $virtualID  = (int)$this->params()->fromRoute("virtualId",0);
        
        $oServer = $this->getServerService()->getOneServerById($serverID);
        
        if(!$oServer){
            $this->redirect()->toRoute("server");
            return false;
        }
        
        $aSnapshots = $oServer->getSnapshotsByVirtualServerId($virtualID);
        
        
        return new ViewModel([
            'aSnapshots' => $aSnapshots,
        ]);
    }
}
