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
use User\Entity\User;
use User\Entity\Role;
use Doctrine\Common\Collections\ArrayCollection;

class UserTest extends PHPUnit_Framework_TestCase{
    
    protected $oUser;
    
    public function setUp() {
        parent::setUp();
        $this->oUser = new User();
    }
    
    public function testSetGetId(){
        $id = 1;
        $this->oUser->setId($id);
        $gotId = $this->oUser->getId();
        $this->assertEquals($id, $gotId);
    }
    
    public function testSetGetUsername(){
        $username = "Administrator";
        $this->oUser->setUsername($username);
        $gotUsername = $this->oUser->getUsername();
        $this->assertEquals($username, $gotUsername);
    }
    
    public function testSetGetEmail(){
        $email = "info@example.tld";
        $this->oUser->setEmail($email);
        $gotEmail = $this->oUser->getEmail();
        $this->assertEquals($email, $gotEmail);
    }
    
    public function testSetGetDisplayName(){
        $displayName = "Admin Admin";
        $this->oUser->setDisplayName($displayName);
        $gotDisplayName = $this->oUser->getDisplayName();
        $this->assertEquals($displayName, $gotDisplayName);
    }
    
    public function testSetGetPassword(){
        $password = "testpass";
        $this->oUser->setPassword($password);
        $gotPassword = $this->oUser->getPassword();
        $this->assertEquals($gotPassword, $password);
    }
    
    
    public function testSetGetState(){
        $state = 1;
        $this->oUser->setState($state);
        $gotState = $this->oUser->getState();
        $this->assertEquals($gotState, $state);
    }
    
    
    public function testSetGetAddRole(){
        $oRole = new Role();
        $oRole->setRoleId("Admins");
        
        $this->oUser->addRole($oRole);
        $gotRoles = $this->oUser->getRoles();
        $gotRole  = $gotRoles[0];
        $this->assertEquals($gotRole, $oRole);
    }
    
    public function testaddRemoveRoles(){
        $oRole = new Role();
        $oRole->setRoleId("Admins");
        
        $oRole2 = new Role();
        $oRole2->setRoleId("Users");
        
        $oCollection = new ArrayCollection();
        $oCollection->add($oRole);
        $oCollection->add($oRole2);
        
        $this->oUser->addRoles($oCollection);
        $gotRoles = $this->oUser->getRoles();
        $givenRoles = $oCollection->getValues();
        $this->assertEquals($givenRoles, $gotRoles);
        
        $this->oUser->removeRoles($oCollection);
        $gotEmptyRoles = $this->oUser->getRoles();
        $this->assertCount(0, $gotEmptyRoles);
    }
    
    public function testAddRemoveRole(){
        $oRole = new Role();
        $this->oUser->addRole($oRole);
        $this->oUser->removeRole($oRole);
        $gotRoles = $this->oUser->getRoles();
        $this->assertCount(0, $gotRoles);
    }
}
