<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TSCoreTests\Entity;

use PHPUnit_Framework_TestCase;
use TSCore\Entity\ServerEntity;

class ServerEntityTest extends PHPUnit_Framework_TestCase{
    
    protected $oServer;
    
    public function setUp() {
        parent::setUp();
        $this->oServer = new ServerEntity();
    }
    
    public function testSetGetID(){
        $serverID = 12;
        $this->oServer->setServerID($serverID);
        $gotServerID = $this->oServer->getServerID();
        $this->assertEquals($gotServerID, $serverID);
    }
    
    public function testSetGetServer(){
        $server = "example.com";
        $this->oServer->setServer($server);
        $gotServer = $this->oServer->getServer();
        $this->assertEquals($gotServer, $server);
    }
    
    public function testSetGetPort(){
        $port = 1045;
        $this->oServer->setPort($port);
        $gotPort = $this->oServer->getPort();
        $this->assertEquals($gotPort, $port);
    }
    
    public function testSetGetUsername(){
        $username = "Admin";
        $this->oServer->setUsername($username);
        $gotUsername = $this->oServer->getUsername();
        $this->assertEquals($gotUsername, $username);
    }
    
    public function testSetGetPassword(){
        $password = "s3cr3tp4ssw0rd";
        $this->oServer->setPassword($password);
        $gotPassword = $this->oServer->getPassword();
        $this->assertEquals($gotPassword, $password);
    }
    
    public function testExchange(){
        $data = $this->oServer->getArrayCopy();
        $data["serverID"] = 12;
        $array = $data;
        $array["invalid"] = "test";
        $array["empty"] = null;
        $this->oServer->exchangeArray($array);
        $gotArray = $this->oServer->getArrayCopy();
        $this->assertEquals($gotArray, $data);
    }
}
