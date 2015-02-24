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

class UserServiceTest extends AbstractControllerTestCase{
    
    
    public function setUp() {
        parent::setUp();
        $this->setApplicationConfig(include "./config/application.config.php");
    }
    
    public function testSetGetAuthenticationANDAdapter(){
        $auth = $this->getApplicationServiceLocator()->get("TSCore\Auth\Service");
        $TSAdapter = $this->getApplicationServiceLocator()->get("TSCore\Adapter\TeamspeakAdapter");
        $userService = new UserService($auth, $TSAdapter);
        $GotAuth = $userService->getAuthentication();
        $gotTSAdapter = $userService->getTeamspeak();

        $this->assertTrue($GotAuth instanceof \Zend\Authentication\AuthenticationService);
        $this->assertTrue($GotAuth->getAdapter() instanceof \TSCore\Authentication\TS3Adapter);
        $this->assertTrue($gotTSAdapter instanceof \TSCore\Adapter\Teamspeak3Adapter);
    }
}
