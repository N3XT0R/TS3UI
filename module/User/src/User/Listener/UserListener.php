<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id: 8aa3b1bff7d817bdcbe2db4daa20a77908c11eb7 $
 * $Date$
 */

namespace User\Listener;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;

class UserListener implements ListenerAggregateInterface{
    
    protected $listeners = array();
    
    public function attach(EventManagerInterface $events) {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_DISPATCH, array($this, "changeLayout"), 98
        );
    }

    public function detach(EventManagerInterface $events) {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }
    
    public function changeLayout(EventInterface $e){
        /* @var $oServiceManager \Zend\ServiceManager\ServiceManager */
        $oServiceManager = $e->getApplication()->getServiceManager();
        /* @var $oAcl \BjyAuthorize\Provider\Identity\ProviderInterface */
        $oProvider = $oServiceManager->get("BjyAuthorize\Provider\Identity\ProviderInterface");
        $aRoles    = $oProvider->getIdentityRoles();
        if(in_array("Guest", $aRoles)){
            $viewModel = $e->getViewModel();
            $viewModel->setTemplate("layout/login.phtml");
        }
    }
}
