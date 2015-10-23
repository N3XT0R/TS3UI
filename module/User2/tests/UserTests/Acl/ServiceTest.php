<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace UserTests\Acl;

use PHPUnit_Framework_TestCase;
use User\Acl\Service;
use Zend\Permissions\Acl\Acl;

class ServiceTest extends PHPUnit_Framework_TestCase{
    
    public function setUp() {
        parent::setUp();    
    }
    
    public function testCreation(){
        $role = "guest";
        $config = array();
        try{
            $oService = new Service($role, $config);
            $this->assertTrue($oService instanceof Service);
        } catch (\Exception $ex) {
            $this->fail();
        }
    }
    
    public function testSetGetConfig(){
        $role = "guest";
        $config = array(
            "admin" => array(
                "user" => array(
                    'allow' => null,
                ),
            ),
        );
        $oService = new Service($role, $config);
        $oService->setConfig($config);
        $gotConfig = $oService->getConfig();
        $this->assertEquals($gotConfig, $config);
    }
    
    public function testSetGetRole(){
        $role = "admin";
        $config = array(
            "admin" => array(
                "user" => array(
                    'allow' => null,
                ),
            ),
        );
        $oService = new Service("guest", $config);
        $oService->setRole($role);
        $sRole = $oService->getRole();
        $this->assertEquals($role, $sRole);
    }
    
    public function testBuildAcl(){
        $role = "guest";
        $config = array(
            "admin" => array(
                "user" => array(
                    'allow' => null,
                ),
            ),
        );
        $oService = new Service($role, $config);
        $oAcl = $oService->buildAcl();
        $this->assertTrue($oAcl instanceof Acl);
    }
    
    public function testSetGetAcl(){
        $role = "guest";
        $config = array(
            "admin" => array(
                "user" => array(
                    'allow' => null,
                ),
            ),
        );
        $oService = new Service($role, $config);
        $oAcl = new Acl();
        $oService->setAcl($oAcl);
        $gotAcl = $oService->getAcl();
        $this->AssertEquals($oAcl, $gotAcl);
    }
    
    public function testIsAllowed(){
        $role = "admin";
        $config = array(
            "admin" => array(
                "user" => array(
                    'allow' => null,
                ),
            ),
        );
        $oService = new Service($role, $config);
        $oService->buildAcl();
        $bool = $oService->isAllowed("user", "index");
        $this->assertTrue($bool);
        
        $oService->setRole("guest");
        $bool = $oService->isAllowed("user", "index");
        $this->assertFalse($bool);
        
        $bool = $oService->isAllowed("user", "");
        $this->assertFalse($bool);
        
        $bool = $oService->isAllowed("", "");
        $this->assertFalse($bool);
    }
}
