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
}
