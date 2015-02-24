<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2014, Ilya Beliaev
 * @since          Version 1.0
 */

namespace User\Controller;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class UserControllerFactory implements FactoryInterface{
    
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $oServiceManager = $serviceLocator->getServiceLocator();
        
        $userService = $oServiceManager->get("User\Service\User");
        
        $oUserController = new UserController($userService);
        
        return $oUserController;
    }

}
