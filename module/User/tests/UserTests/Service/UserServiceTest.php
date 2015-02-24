<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace UserTests\Service;

use Zend\Test\PHPUnit\Controller\AbstractControllerTestCase;
use User\Service\UserService;
use Doctrine\ORM\EntityManager;

class UserServiceTest extends AbstractControllerTestCase{
    
    
    public function setUp() {
        parent::setUp();
        $this->setApplicationConfig(include "./config/application.config.php");
    }
    
    public function testSetGetAuthenticationANDAdapter(){
        $auth = $this->getApplicationServiceLocator()->get("User\Auth\Service");
        $entityManager = $this->getApplicationServiceLocator()->get("Doctrine\ORM\EntityManager");
        $userService = new UserService($auth, $entityManager);
        $GotAuth = $userService->getAuthentication();
        $gotEntityManager = $userService->getEntityManager();

        $this->assertTrue($GotAuth instanceof \Zend\Authentication\AuthenticationService);
        $this->assertTrue($gotEntityManager instanceof EntityManager);
    }
}
