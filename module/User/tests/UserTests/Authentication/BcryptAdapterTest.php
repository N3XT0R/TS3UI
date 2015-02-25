<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace UserTests\Authentication;

use Zend\Test\PHPUnit\Controller\AbstractControllerTestCase;
use Zend\Authentication\Result;

class BcryptAdapterTest extends AbstractControllerTestCase{
    
    public function setUp() {
        parent::setUp();
        $this->setApplicationConfig(include "./config/application.config.php");
    }
    
    public function testSetGetGentitityRepository(){
        /* @var $oBcryptService \User\Authentication;\BcryptAdapter */
        $oBcryptService = $this->getApplicationServiceLocator()->get("User\Auth\Adapter");
        $oEM = $oBcryptService->getEntityRepositoryr();
        $oBcryptService->setEntityRepository($oEM);
        $gotEM = $oBcryptService->getEntityRepositoryr();
        $this->assertEquals($gotEM, $oEM);
    }
    
    public function testSetGetIdentity(){
        $oAdapter = $this->getApplicationServiceLocator()->get("User\Auth\Adapter");
        $identity = "Test";
        $oAdapter->setIdentity($identity);
        $gotIdentity = $oAdapter->getIdentity();
        $this->assertEquals($gotIdentity, $identity);
    }
    
    public function testSetGetCredential(){
        $oAdapter = $this->getApplicationServiceLocator()->get("User\Auth\Adapter");
        $credential = "test";
        $oAdapter->setCredential($credential);
        $gotCredential = $oAdapter->getCredential();
        $this->assertEquals($gotCredential, $credential);
    }
    
    public function testAuthenticateFailure(){
        $oAdapter = $this->getApplicationServiceLocator()->get("User\Auth\Adapter");
        $oResult = $oAdapter->authenticate();
        $this->assertEquals($oResult->getCode(), Result::FAILURE);
        
        $identity = "test";
        $oAdapter->setIdentity($identity);
        
        /* @var $oResult Result */
        $oResult = $oAdapter->authenticate();
        $this->assertEquals($oResult->getCode(), Result::FAILURE);
        
        $credential = "test";
        $oAdapter->setCredential($credential);
        
        $oResult = $oAdapter->authenticate();
        $this->assertEquals($oResult->getCode(), Result::FAILURE);
        
        $identity = "Admin";
        $oAdapter->setIdentity($identity);
        
        $oResult = $oAdapter->authenticate();
        $this->assertEquals($oResult->getCode(), Result::FAILURE_CREDENTIAL_INVALID);
    }
}
