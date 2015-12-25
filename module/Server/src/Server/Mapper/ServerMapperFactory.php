<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id: 3b6ea08a0992ed3ba848bbb573048b504cad0dc6 $
 * $Date$
 */

namespace Server\Mapper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ServerMapperFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        
        $aConfig = $serviceLocator->get("Config");
        $aTSConf = $aConfig["teamspeak"];
        
        /* @var $oEM \Doctrine\ORM\EntityManager */
        $oEM     = $serviceLocator->get("Doctrine\ORM\EntityManager");
        $oMapper = new ServerMapper();
        $oMapper->setEntityManager($oEM);
        $oMapper->setConfig($aTSConf);
        return $oMapper;
    }

}
