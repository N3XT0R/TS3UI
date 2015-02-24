<?php

/*
 * TS3UI - Teamspeak 3 Webinterface
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace User;

use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\EventManager\EventInterface;
use User\Listener\UserListener;
use Zend\Console\Request as ConsoleRequest;

class Module implements
BootstrapListenerInterface,
AutoloaderProviderInterface,
ConfigProviderInterface
{

    protected $serviceLocator;
    
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__.'/config/module.config.php';
    }

    public function onBootstrap(EventInterface $e) {
        $this->serviceLocator = $e->getApplication()->getServiceManager();
        $aParams = $e->getParams();
        if(!$aParams["request"] instanceof ConsoleRequest){
            $e->getApplication()->getEventManager()->attachAggregate(new UserListener());
        }
    }

}
