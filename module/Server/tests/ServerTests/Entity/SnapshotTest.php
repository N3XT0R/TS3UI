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
use Server\Entity\Snapshot;
use Server\Entity\Server;

/**
 * Description of SnapshotTest
 *
 * @author N3X-Home
 */
class SnapshotTest extends PHPUnit_Framework_TestCase{
    
    private $oSnapshot;
    
    public function setUp() {
        parent::setUp();
        $this->oSnapshot = new Snapshot();
    }
    
    public function testSetGetSnapshotId(){
        $snapshotId = 12;
        $this->oSnapshot->setSnapshotId($snapshotId);
        $gotSnapshotId = $this->oSnapshot->getSnapshotId();
        $this->assertEquals($gotSnapshotId, $snapshotId);
    }
    
    public function testSetGetVirtualServerID(){
        $virtualServerID = 93;
        $this->oSnapshot->setVirtualServerID($virtualServerID);
        $gotVirtualServerID = $this->oSnapshot->getVirtualServerID();
        $this->assertEquals($gotVirtualServerID, $virtualServerID);
    }
    
    public function testSetGetConfig(){
        $config = "cryptoconfig";
        $this->oSnapshot->setConfig($config);
        $gotConfig = $this->oSnapshot->getConfig();
        $this->assertEquals($gotConfig, $config);
    }
    
    public function testSetGetTimestamp(){
        $timestamp = new \DateTime();
        $this->oSnapshot->setTimestamp($timestamp);
        $gotTimestamp = $this->oSnapshot->getTimestamp();
        $this->assertEquals($gotTimestamp, $timestamp);
    }
    
    public function testSetGetServer(){
        $server = new Server();
        $this->oSnapshot->setServer($server);
        $gotServer = $this->oSnapshot->getServer();
        $this->assertEquals($gotServer, $server);
    }
}
