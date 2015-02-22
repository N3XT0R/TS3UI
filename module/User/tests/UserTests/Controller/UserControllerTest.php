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
use Zend\Test\PHPUnit\Controller\AbstractControllerTestCase;


class UserControllerTest extends AbstractControllerTestCase{
    
    public function setUp() {
        parent::setUp();
    }
    
    public function testSetGetService(){
        $service = new UserService();
        $controller = new UserController($service);
        $gotService = $controller->getUserService();
        $this->assertTrue($gotService instanceof UserService);
    }
}
