<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace User\Acl;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ServiceFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $config = $serviceLocator->get("Config");
        if(!array_key_exists("acl", $config)){
            $config["acl"] = array();
        }
        $auth = $serviceLocator->get("User\Auth\Service");
        $role = "guest";
        
        if($auth->hasIdentity()){
            if($auth->getIdentity()->getRole() !== null){
                $role = $auth->getIdentity()->getRole()->getRolename();
            }
        }

        $acl = new Service($role, $config["acl"]);
        return $acl;
    }

}
