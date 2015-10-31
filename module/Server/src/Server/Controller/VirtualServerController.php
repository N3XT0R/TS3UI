<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id: 2c9080b5c84e48b5276a81ec588a048f4c3c90c8 $
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
}
