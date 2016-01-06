<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace Server\Listener;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FormListener implements ListenerAggregateInterface, ServiceLocatorAwareInterface{
    
    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();
    protected $oServiceManager;
    
    public function attach(EventManagerInterface $events) {
        
        $sharedEvents      = $events->getSharedManager();
        $this->listeners[] = $sharedEvents->attach(
            'Server\Service\ServerService', 
            'setForm', 
            array(
                $this, 'onSetForm'
           ), 
           100
        );
        
        $this->listeners[]  = $sharedEvents->attach(
            'Server\Service\VirtualServerService', 
            'setVirtualServerForm', 
            array(
                $this, 'onVirtualSetForm',
            ),
            101
        );
    }
    
    public function detach(EventManagerInterface $events){
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)){
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * 
     * @param  Zend\EventManager\Event $e
     */
    public function onSetForm(EventInterface $e){
        $oServiceManager = $this->getServiceLocator();
        $type = $e->getParam('type', 'ServerCreate');
        $service = $oServiceManager->get('Server\Service\Server');
        $form    = $oServiceManager->get('Server\Form\\' . ucfirst($type));
        $service->setForm($type, $form);
    }
    
    public function onVirtualSetForm(EventInterface $e){
        $oServiceManager    = $this->getServiceLocator();
        $type               = $e->getParam("type", "VirtualServerEdit");
        $service            = $oServiceManager->get('Server\Service\VirtualServer');
        $form               = $oServiceManager->get('Server\Form\\' . ucfirst($type));
        $service->setForm($type, $form);
    }

    public function getServiceLocator() {
        return $this->oServiceManager;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->oServiceManager = $serviceLocator;
        return $this;
    }

}
