<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace TSCore\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TeamspeakServiceFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $oAdapter = $serviceLocator->get("TSCore\Adapter\Teamspeak");
        $oService = new TeamspeakService();
        $oService->setTeamspeakAdapter($oAdapter);
        return $oService;
    }

}
