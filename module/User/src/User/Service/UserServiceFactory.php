<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace User\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class UserServiceFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $auth = $serviceLocator->get("TSCore\Auth\Service");
        $TSAdapter = $serviceLocator->get("TSCore\Adapter\Teamspeak");
        $userService = new UserService($auth, $TSAdapter);
        return $userService;
    }

}
