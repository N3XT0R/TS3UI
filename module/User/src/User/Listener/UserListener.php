<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace User\Listener;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;
use Zend\Console\Request as ConsoleRequest;

class UserListener implements ListenerAggregateInterface{
    
    protected $listeners;
    
    public function attach(EventManagerInterface $events) {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_DISPATCH, array($this, 'checkAcl'), 100
        );
        
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_RENDER, array($this, 'addAclToNavigation'), -100
        );
    }

    public function detach(EventManagerInterface $events) {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }
    
    /**
     * 
     * @param \Zend\Mvc\MvcEvent $e
     * @return type
     */
    public function checkAcl(EventInterface $e){
        
        // get route match, params and objects
        $routeMatch       = $e->getRouteMatch();
        $controllerParam  = $routeMatch->getParam('controller');
        $actionParam      = $routeMatch->getParam('action');
        $serviceManager   = $e->getApplication()->getServiceManager();
        $controllerLoader = $serviceManager->get('ControllerLoader');
        $acl              = $serviceManager->get('User\Acl\Service');
        
        
        
        // try to load current controller
        try {
            /* @var $controller \Zend\Mvc\Controller\AbstractActionController */
            $controller = $controllerLoader->get($controllerParam);
        } catch (\Exception $exception) {
            return;
        }
        
        // check acl
        if (!$acl->isAllowed($controllerParam, $actionParam)) {
            // check for guests
            if ($acl->getRole() == 'guest') {
                $routeMatch->setParam('controller', 'user');
                $routeMatch->setParam('action', 'login');
            } else {
                $routeMatch->setParam('controller', 'user');
                $routeMatch->setParam('action', 'forbidden');
            }
        }
        
    }
    
    public function addAclToNavigation(EventInterface $e){
        // get service manager, view manager and acl service
        $serviceManager = $e->getApplication()->getServiceManager();
        $viewManager    = $serviceManager->get('viewmanager');
        $aclService     = $serviceManager->get('User\Acl\Service');
        
        // set navigation plugin and set acl and role
        $plugin = $viewManager->getRenderer()->plugin('navigation');
        $plugin->setRole($aclService->getRole());
        $plugin->setAcl($aclService->getAcl());
    }

}