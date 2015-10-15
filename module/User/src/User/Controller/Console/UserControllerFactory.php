<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace User\Controller\Console;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserControllerFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $oServiceManager = $serviceLocator->getServiceLocator();
        $userService = $oServiceManager->get("User\Service\User");
        $oUserController = new UserController($userService);
        return $oUserController;
    }

}
