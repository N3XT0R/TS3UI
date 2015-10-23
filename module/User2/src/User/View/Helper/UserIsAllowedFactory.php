<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace User\View\Helper;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserIsAllowedFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $sm     = $serviceLocator->getServiceLocator();
        $acl    = $sm->get('User\Acl\Service');
        $helper = new UserIsAllowed($acl);
        return $helper;
    }

}
