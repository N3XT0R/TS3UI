<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace TSCore\Adapter;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Teamspeak3AdapterFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $adapter = $serviceLocator->get("TS3Core\Adapter\TeamspeakAdapter");
        $config = $serviceLocator->get("Config");
        $teamspeakConfig = $config["teamspeak"];
        $adapter->init($teamspeakConfig);
        return $adapter;
    }

}
