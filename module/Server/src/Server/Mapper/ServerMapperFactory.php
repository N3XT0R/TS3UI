<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace Server\Mapper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ServerMapperFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        /* @var $oEM \Doctrine\ORM\EntityManager */
        $oEM     = $serviceLocator->get("Doctrine\ORM\EntityManager");
        $oRepo   = $oEM->getRepository("Server\Entity\Server");
        $oMapper = new ServerMapper();
        $oMapper->setServerRepository($oRepo);
        return $oMapper;
    }

}
