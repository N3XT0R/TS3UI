<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id: b3199f982e85b6f361b32705e5ed7c707e645f45 $
 * $Date$
 */


namespace Server\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Server\Service\ServerService;
use Zend\Http\PhpEnvironment\Response;
use Zend\Stdlib\Hydrator\ClassMethods;

class ServerController extends AbstractActionController{
    
    protected $oServerService;
    
    
    public function __construct(ServerService $oServerService) {
        $this->setServerService($oServerService);
    }
    
    public function setServerService(ServerService $oServerService){
        $this->oServerService = $oServerService;
        return $this;
    }
    
    public function getServerService(){
        return $this->oServerService;
    }
    
    
    public function indexAction(){
        $page   = (int)$this->params()->fromQuery("page", 0);
        $aServers = $this->getServerService()->fetchServers([]);
        $aServers->setCurrentPageNumber($page);
        
        return new ViewModel([
            "aServers" => $aServers,
        ]);
    }
    
    public function virtualServerListAction(){
        $serverID   = (int)$this->params()->fromRoute("id", 0);
        $aVirtualServer = $this->getServerService()->fetchVirtualServer($serverID);
        if(count($aVirtualServer) == 0){
            $this->MessagesToFlashMessenger()->add($this->getServerService()->getMessages(), 1);
            $this->redirect()->toRoute("server/action", ["action" => "index"]);
            return false;
        }
        
        return new ViewModel([
            "aVirtualServer" => $aVirtualServer,
            "iServerID"      => $serverID,
        ]);
    }
    
    public function createAction(){
        $oForm = $this->getServerService()->getForm("ServerCreate");
        $sUrl = $this->url()->fromRoute("server/action", ["action" => "create"]);
        $oPrg = $this->prg($sUrl, true);
        
        if($oPrg instanceof Response){
            return $oPrg;
        }elseif($oPrg !== false){
            $this->getServerService()->create($oPrg);
            $aMessages = $this->getServerService()->getMessages();
            $this->MessagesToFlashMessenger()->add($aMessages);
        }
        
        return new ViewModel([
            "oForm" => $oForm,
        ]);
    }
    
    public function editAction(){
        //Check if serverID is given, when not redirect
        $serverID   = (int)$this->params()->fromRoute("id", 0);
        if($serverID == 0){
            $this->redirect()->toRoute("server");
            return false;
        }
        
        /**
         * Server found by id ? When not redirect user
         */
        $oServer = $this->getServerService()->getOneServerById($serverID);
        if(!$oServer){
            $this->redirect()->toRoute("server");
            return false;
        }
        
        $oHydrator = new ClassMethods();
        $aData     = $oHydrator->extract($oServer);
        $oForm = $this->getServerService()->getForm("ServerEdit");
        $oForm->setData($aData);
        
        return new ViewModel([
            'oForm'     => $oForm,
            'oServer'   => $oServer,
        ]);
    }
}
