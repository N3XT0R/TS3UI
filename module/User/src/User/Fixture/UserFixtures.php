<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace User\Fixture;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class UserFixtures implements FixtureInterface, ServiceLocatorAwareInterface, OrderedFixtureInterface{
    
    protected $oServiceLocator;
    
    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator() {
        return $this->oServiceLocator;
    }

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->oServiceLocator = $serviceLocator;
        return $this;
    }
    
    public function load(ObjectManager $manager) {
        /* @var $oUserService \ZfcUser\Service\User */
        $oUserService = $this->getServiceLocator()->get("zfcuser_user_service");
        $oUserService->getOptions()->setUseRegistrationFormCaptcha(false);
        /* @var $oEM \Doctrine\ORM\EntityManager */
        $oEM          = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $oRepo        = $oEM->getRepository("User\Entity\Role");
        $oRole        = $oRepo->findOneBy(array("roleId" => "Administrator"));
        
        $data = array(
            "username"          => "Administrator",
            "display_name"      => "Administrator",
            "displayName"       => "Administrator",
            "email"             => "admin@example.com",
            "password"          => "Administrator",
            "passwordVerify"    => "Administrator",
        );
        /* @var $oUser \User\Entity\User */
        $oUser = $oUserService->register($data);
        $oUser->addRole($oRole);
        $oUser->setState(1);
        
        $manager->persist($oUser);
        $manager->flush();
    }

    public function getOrder() {
        return 2;
    }

}
