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
use Zend\Stdlib\Exception\InvalidArgumentException;

class Teamspeak3AdapterTest extends PHPUnit_Framework_TestCase{
    
    protected $oAdapter;
    
    public function setUp() {
        parent::setUp();
        $this->oAdapter = new Teamspeak3Adapter();
    }
    public function testException(){
        try{
           $this->oAdapter->init(array("server" => "localhost", "port" => "15"));
           $this->oAdapter->connect();
        } catch (\Exception $ex) {
            $this->assertTrue($ex instanceof Ts3Exception);
        }
    }
    
    public function testSetGetConfig(){
        $config = array(
            "username" => "Foo",
            "password" => "Bar",
            "server" => "localhost:11001",
            "port" => "9987",
        );
        $this->oAdapter->setConfig($config);
        $getConfig = $this->oAdapter->getConfig();
        $this->assertEquals($getConfig, $config);
    }
    
    public function testThrowSErverInbvalidException(){
        try{
            $this->oAdapter->init(array());
            $this->oAdapter->connect();
        } catch (\Exception $ex) {
            $this->assertTrue($ex instanceof InvalidArgumentException);
        }
    }
    
   public function testThrowsPortInvalidException(){
       try{
            $this->oAdapter->init(array("server" => "localhost"));
            $this->oAdapter->connect();
        } catch (\Exception $ex) {
            $this->assertTrue($ex instanceof InvalidArgumentException);
        }
   }
}
