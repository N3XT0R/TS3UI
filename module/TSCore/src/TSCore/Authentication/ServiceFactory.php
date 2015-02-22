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
use Zend\Authentication\AuthenticationService;

class ServiceFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $authAdapter = $serviceLocator->get("TSCore\Auth\Adapter");
        
        $auth = new AuthenticationService();
        $auth->setAdapter($authAdapter);
        return $auth;
    }

}
