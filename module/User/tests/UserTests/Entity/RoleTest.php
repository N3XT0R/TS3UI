<?php

/*
 * TS3UI - Teamspeak 3 Webinterface
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace UserTests\Entity;

use PHPUnit_Framework_TestCase;
use User\Entity\Role;

class RoleTest extends PHPUnit_Framework_TestCase{
    
    protected $oRole;
    
    public function setUp() {
        parent::setUp();
        $this->oRole = new Role();
    }
    
    public function testSetGetId(){
        $id = 1;
        $this->oRole->setId($id);
        $gotId = $this->oRole->getId();
        $this->assertEquals($gotId, $id);
    }
    
    public function testSetGetRoleId(){
        $roleId = "Users";
        $this->oRole->setRoleId($roleId);
        $gotRoleId = $this->oRole->getRoleId();
        $this->assertEquals($roleId, $gotRoleId);
    }
    
    public function testSetGetParent(){
        $parent = new Role();
        $this->oRole->setParent($parent);
        $gotParent = $this->oRole->getParent();
        $this->assertEquals($gotParent, $parent);
    }
}
