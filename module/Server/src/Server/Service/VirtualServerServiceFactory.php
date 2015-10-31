<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Server\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class VirtualServerServiceFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $oTS      = $serviceLocator->get("TSCore\Service\Teamspeak"); 
        $oService = new VirtualServerService();
        $oService->setTeamspeakService($oTS);
        return $oService;
    }

}
