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
        $id         = (int)$this->params()->fromRoute("id", 0);
        $virtualID  = (int)$this->params()->fromRoute("virtualId", 0);
        
        $oServer = $this->getServerService()->getOneServerById($id);
        
        if(!$oServer){
            $this->redirect()->toRoute("server");
            return false;
        }
        
        $oVirtualServer = $this->getVirtualServerService()->getOneVirtualServerById(
            $oServer, $virtualID
        );
        
        if(!$oVirtualServer){
            $this->redirect()->toRoute("server");
            return false;
        }
        
        $aChannels = $this->getVirtualServerService()->getChannels($oVirtualServer);
        
        return new ViewModel([
            'id'                => $id,
            'oVirtualServer'    => $oVirtualServer,
            'aChannels'         => $aChannels,
        ]); 
    }
}
