<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace ModulesTests;
 
use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Service\ServiceManagerConfig;
 
class ServiceManagerGrabber
{
    protected static $serviceConfig = null;
     
    public static function setServiceConfig($config)
    {
        static::$serviceConfig = $config;
    }
     
    public function getServiceManager()
    {
        $configuration = static::$serviceConfig ? : require_once './config/application.config.php';
         
        $smConfig = isset($configuration['service_manager']) ? $configuration['service_manager'] : array();
        $serviceManager = new ServiceManager(new ServiceManagerConfig($smConfig));
        $serviceManager->setService('ApplicationConfig', $configuration);
  
        $serviceManager->get('ModuleManager')->loadModules();
         
        return $serviceManager;
    }
}
