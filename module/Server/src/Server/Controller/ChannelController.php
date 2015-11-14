<?php

namespace Server\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ChannelController extends AbstractActionController{
    
    protected $oVirtualServerService;
    
    public function setVirtualServerService($oVirtualServerService){
        $this->oVirtualServerService = $oVirtualServerService;
        return $this;
    }
    
    public function getVirtualServerService(){
        return $this->oVirtualServerService;
    }
    
    
    /**
     * Sub Channel List
     * @return ViewModel
     */
    public function indexAction() {
        $serverID   = (int)$this->params()->fromRoute("id", 0);
        $virtualID  = (int)$this->params()->fromRoute("virtualId", 0);
        
        
        return new ViewModel([
            
        ]);
    }
}
