<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace User\Entity;

use PHPUnit_Framework_TestCase;
use User\Entity\UserEntity;

class UserTest extends PHPUnit_Framework_TestCase{
    
    protected $oUser;
    
    public function setUp() {
        $this->oUser = new UserEntity();
        parent::setUp();
    }
    
    public function testSetGetUsername(){
        $username = "Foo";
        $this->oUser->setUsername($username);
        $gotUsername = $this->oUser->getUsername();
        $this->assertEquals($gotUsername, $username);
    }
    
    public function testSetGetPassword(){
        $password = "s3cr3tP4ssw0rd";
        $this->oUser->setPassword($password);
        $gotPassword = $this->oUser->getPassword();
        $this->assertEquals($gotPassword, $password);
    }
    
    public function testExchange(){
        $data = $this->oUser->getArrayCopy();
        $data["username"] = "Foo";
        $array = $data;
        $array["invalid"] = "Test";
        $array["empty"] = null;
        $this->oUser->exchangeArray($array);
        $gotArray = $this->oUser->getArrayCopy();
        $this->assertEquals($gotArray, $data);
    }
    public function testSetGetId(){
        $id = 12;
        $this->oUser->setId($id);
        $gotID = $this->oUser->getId();
        $this->assertEquals($gotID, $id);
    }
}
