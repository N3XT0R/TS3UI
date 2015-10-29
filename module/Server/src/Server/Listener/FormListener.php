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

class FormListener implements ListenerAggregateInterface{
    
    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();
    
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
    }
    
    public function detach(EventManagerInterface $events){
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)){
                unset($this->listeners[$index]);
            }
        }
    }

    public function onSetForm($e){
        $type = $e->getParam('type', 'ServerCreate');
        $service = $this->serviceLocator->get('Server\Service\Server');
        $form    = $this->serviceLocator->get('Server\Form\\' . ucfirst($type));
        $service->setForm($form, $type);
    }

}
