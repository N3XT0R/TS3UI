<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace TSCoreTests\Adapter;

use TSCore\Adapter\Teamspeak3Adapter;
use PHPUnit_Framework_TestCase;
use TeamSpeak3\TeamSpeak3;
use TeamSpeak3\Ts3Exception;

class Teamspeak3AdapterTest extends PHPUnit_Framework_TestCase{
    
    protected $oAdapter;
    
    public function setUp() {
        parent::setUp();
        $this->oAdapter = new Teamspeak3Adapter();
    }
    public function testException(){
        try{
            $teamspeak = TeamSpeak3::factory("serverquery://username:password@176.57.128.197:10011/?server_port=9987");
            $this->fail();
        } catch (\Exception $ex) {
            $this->assertTrue($ex instanceof Ts3Exception);
        }
    }
}
