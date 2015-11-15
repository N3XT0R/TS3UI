<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id: 055c418db9628c78392b15d74538acb78bd7f98b $
 * $Date$
 */

namespace Server\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\PhpEnvironment\Response;

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
        $serverID   = (int)$this->params()->fromRoute("id",0);
        $virtualID  = (int)$this->params()->fromRoute("virtualId",0);
        
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
        
        
        $oForm = $this->getVirtualServerService()->getForm("VirtualServerEdit");
        
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
            
        }
        
        return new ViewModel([
            'serverId'          => $serverID,
            'virtualId'         => $virtualID,
            'oVirtualServer'    => $oVirtualServer,
            'oForm'             => $oForm,
        ]);
    }
}
