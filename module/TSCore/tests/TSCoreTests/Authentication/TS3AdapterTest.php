<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace TSCoreTests\Authentication;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use TSCore\Authentication\TS3Adapter;
use Zend\Authentication\Result;

class TS3AdapterTest extends AbstractHttpControllerTestCase{
    
    public function setUp() {
        $this->setApplicationConfig(include "./config/application.config.php");
        parent::setUp();
    }
    
    public function testCreation(){
        $oAdapter = $this->getApplicationServiceLocator()->get("TSCore\Auth\Adapter");
        $this->assertTrue($oAdapter instanceof TS3Adapter);
    }
    
    public function testSetGetIdentity(){
        $identity = "Foo";
        /* @var $oAdapter TS3Adapter */
        $oAdapter = $this->getApplicationServiceLocator()->get("TSCore\Auth\Adapter");
        $oAdapter->setIdentity($identity);
        $gotIdentity = $oAdapter->getIdentity();
        $this->assertEquals($gotIdentity, $identity);
    }
    
    public function testSetGetCredential(){
        $credential = "Bar";
        /* @var $oAdapter TS3Adapter */
        $oAdapter = $this->getApplicationServiceLocator()->get("TSCore\Auth\Adapter");
        $oAdapter->setCredential($credential);
        $gotCredential = $oAdapter->getCredential();
        $this->assertEquals($gotCredential, $credential);
    }
    
    public function testSetGetConfig(){
        $config = $this->getApplicationServiceLocator()->get("Config");
        $tsconf = $config["teamspeak"];
        /* @var $oAdapter TS3Adapter */
        $oAdapter = $this->getApplicationServiceLocator()->get("TSCore\Auth\Adapter");
        $oAdapter->setConfig($tsconf);
        $gotConfig = $oAdapter->getConfig();
        $this->assertEquals($gotConfig, $tsconf);
    }
    
    public function testLoginIdentityNotSet(){
        /* @var $oAdapter TS3Adapter */
        $oAdapter = $this->getApplicationServiceLocator()->get("TSCore\Auth\Adapter");
        $oResult = $oAdapter->authenticate();
        $this->assertTrue($oResult instanceof Result);
        
        $this->assertEquals($oResult->getCode(), Result::FAILURE);
    }
    
    public function testLoginCredentialNotSet(){
        /* @var $oAdapter TS3Adapter */
        $oAdapter = $this->getApplicationServiceLocator()->get("TSCore\Auth\Adapter");
        $oAdapter->setIdentity("Foo");
        $oResult = $oAdapter->authenticate();
        $this->assertTrue($oResult instanceof Result);
        
        $this->assertEquals($oResult->getCode(), Result::FAILURE);
    }
    
    public function testFailedLogin(){
        /* @var $oAdapter TS3Adapter */
        $oAdapter = $this->getApplicationServiceLocator()->get("TSCore\Auth\Adapter");
        $oAdapter->setIdentity("Foo");
        $oAdapter->setCredential("Bar");
        $oResult = $oAdapter->authenticate();
        $this->assertTrue($oResult instanceof Result);
        
        $this->assertEquals($oResult->getCode(), Result::FAILURE_CREDENTIAL_INVALID);
    }
}
