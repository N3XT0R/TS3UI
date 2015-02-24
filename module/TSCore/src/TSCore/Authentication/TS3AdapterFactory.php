<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace TSCore\Authentication;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class TS3AdapterFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $config = $serviceLocator->get("Config");
        $oAdapter = $serviceLocator->get("TSCore\Adapter\TeamspeakAdapter");
        $teamspeakConfig = (array_key_exists("teamspeak", $config)) ? $config["teamspeak"] : array();
        $oAuthAdapter = new TS3Adapter($oAdapter, $teamspeakConfig);
        return $oAuthAdapter;
    }

}
