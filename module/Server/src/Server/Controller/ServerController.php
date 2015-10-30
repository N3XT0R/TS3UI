<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */


namespace Server\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Server\Service\ServerService;
use Zend\Http\PhpEnvironment\Response;

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
        $aServers = $this->getServerService()->fetchServers(array());
        $aServers->setCurrentPageNumber($page);
        
        return new ViewModel(array(
            "aServers" => $aServers,
        ));
    }
    
    public function virtualServerListAction(){
        $serverID   = (int)$this->params()->fromRoute("id", 0);
        $aVirtualServer = $this->getServerService()->fetchVirtualServer($serverID);
        if(count($aVirtualServer) == 0){
            $this->redirect()->toRoute("server/action", array("action" => "index"));
            return false;
        }
        
        return new ViewModel(array(
            "aVirtualServer" => $aVirtualServer,
        ));
    }
    
    public function createAction(){
        $oForm = $this->getServerService()->getForm("ServerCreate");
        $sUrl = $this->url()->fromRoute("server/action", array("action" => "create"));
        $oPrg = $this->prg($sUrl, true);
        
        if($oPrg instanceof Response){
            return $oPrg;
        }elseif($oPrg !== false){
            $this->getServerService()->create($oPrg);
            $aMessages = $this->getServerService()->getMessages();
            $this->MessagesToFlashMessenger()->add($aMessages);
        }
        
        return new ViewModel(array(
            "oForm" => $oForm,
        ));
    }
}
