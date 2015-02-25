<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace UserTests\Controller\Controller;

use User\Controller\UserController;
use User\Service\UserService;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;


class UserControllerTest extends AbstractHttpControllerTestCase{
    
    public function setUp() {
        $this->setApplicationConfig(include "./config/application.config.php");
        parent::setUp();
    }
    
    public function testSetGetService(){
        $auth = $this->getApplicationServiceLocator()->get("TSCore\Auth\Service");
        $entityManager = $this->getApplicationServiceLocator()->get("Doctrine\ORM\EntityManager");
        $service = new UserService($auth, $entityManager);
        $controller = new UserController($service);
        $gotService = $controller->getUserService();
        $this->assertTrue($gotService instanceof UserService);
    }
    
    public function testIndexAction(){
        $this->dispatch("/user");
        $this->assertControllerClass("usercontroller");
        $this->assertControllerName("user");
        $this->assertActionName("login");
        $this->assertResponseStatusCode(200);
    }
    
    public function testLoginAction(){
        $this->dispatch("/user/login");
        $this->assertControllerName("user");
        $this->assertActionName("login");
        $this->assertResponseStatusCode(200);
    }
    
    public function test404Error(){
        $this->dispatch("/user/44444");
        $this->assertResponseStatusCode(404);
    }
}
