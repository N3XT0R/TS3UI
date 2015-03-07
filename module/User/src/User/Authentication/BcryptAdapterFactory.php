<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace User\Authentication;
use Zend\Crypt\Password\Bcrypt;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BcryptAdapterFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        /* @var $oEM \Doctrine\ORM\EntityManager */
        $oEM = $serviceLocator->get("Doctrine\ORM\EntityManager");
        $repository = $oEM->getRepository("User\Entity\UserEntity");
        
        $bcrypt = new Bcrypt(array("cost" => 12));
        $adapter = new BcryptAdapter($repository, $bcrypt);
        return $adapter;
    }

}
