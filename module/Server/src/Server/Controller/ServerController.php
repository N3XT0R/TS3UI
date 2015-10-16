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
        parent::indexAction();
    }
    
    public function createAction(){
        return new ViewModel();
    }
}
