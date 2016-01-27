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

namespace ServerTests\Entity;

use PHPUnit_Framework_TestCase;
use Server\Entity\Server;
use Server\Entity\Snapshot;

class ServerTest extends PHPUnit_Framework_TestCase{
    
    private $oServer;
    
    public function setUp(){
        $oServer = new Server();
        $this->oServer = $oServer;
    }
    
    public function testSetGetServerID(){
        $serverID = 12;
        $this->oServer->setServerID($serverID);
        $gotServerID = $this->oServer->getServerID();
        $this->assertEquals($serverID, $gotServerID);
    }
    
    public function testSetGetServer(){
        $server = "127.0.0.1";
        $this->oServer->setServer($server);
        $gotServer = $this->oServer->getServer();
        $this->assertEquals($gotServer, $server);
    }
    
    public function testSetGetPort(){
        $port = 10011;
        $this->oServer->setPort($port);
        $gotPort = $this->oServer->getPort();
        $this->assertEquals($gotPort, $port);
    }
    
    public function testSetGetUsername(){
        $username = "serveradmin";
        $this->oServer->setUsername($username);
        $gotUsername = $this->oServer->getUsername();
        $this->assertEquals($gotUsername, $username);
    }
    
    public function testSetGetPassword(){
        $password = "encryptedPass";
        $this->oServer->setPassword($password);
        $gotPassword = $this->oServer->getPassword();
        $this->assertEquals($gotPassword, $password);
    }
    
    public function testSetGetAddSnapshot(){
        $snapshot = new Snapshot();
        $this->oServer->addSnapshot($snapshot);
        $gotSnapshots = $this->oServer->getSnapshots();
        $this->assertCount(1, $gotSnapshots);
        
        $this->oServer->setSnapshots($gotSnapshots);
        $gotSecondSnapshots = $this->oServer->getSnapshots();
        $this->assertEquals($gotSecondSnapshots, $gotSnapshots);
    }
    
    public function testgetSnapshotsByVirtualServerId(){
        $id = 4711;
        $snapshot = new Snapshot();
        $snapshot->setSnapshotId($id);
        $this->oServer->addSnapshot($snapshot);
        $snapshot->setSnapshotId(42);
        $this->oServer->addSnapshot(clone $snapshot);
        $oGotSnapshots = $this->oServer->getSnapshotsByVirtualServerId($id);
        
        foreach($oGotSnapshots as $oSnapshot){
            $this->assertEquals($oSnapshot->getSnapshotId(), $id);
        }
    }
}
