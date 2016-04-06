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

namespace Server\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of SnapshotServiceFactory
 *
 * @author N3X-Home
 */
class SnapshotServiceFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $oTS      = $serviceLocator->get("TSCore\Service\Teamspeak"); 
        $oMapper  = $serviceLocator->get("Server\Mapper\Snapshot");
        $oService = new SnapshotService();
        $oService->setTeamspeakService($oTS);
        $oService->setSnapshotMapper($oMapper);
        return $oService;
    }
    
}
