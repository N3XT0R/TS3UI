<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace UserTests\Controller;

use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;

class ConsoleUserControllerTest extends AbstractConsoleControllerTestCase{
    
    public function setUp() {
        parent::setUp();
         $this->setApplicationConfig(include "./config/application.config.php");
    }
    
    public function testAddUser(){
        $this->dispatch('user add Admin2 Admin2');
        $this->assertResponseStatusCode(0);
        $this->assertControllerName('User');
        $this->assertControllerClass('UserController');
        $this->assertActionName("update");
    }
    
    public function testHelp(){
        $this->dispatch('user --help');
        $this->assertResponseStatusCode(0);
        $this->assertControllerName('User');
        $this->assertControllerClass('UserController');
        $this->assertActionName("update");
    }
}
