<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace Server\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity 
 * @ORM\Table(name="server")
 */
class Server implements ServerInterface{
    
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $serverID;
    
    /** @ORM\Column(type="string") */
    protected $server;
    
    /** @ORM\Column(type="integer") */
    protected $port;
    
    /** @ORM\Column(type="string") */
    protected $username;
    
    /** @ORM\Column(type="string") */
    protected $password;
    
    public function setServerID($serverID){
        $this->serverID = $serverID;
        return $this;
    }
    
    public function getServerID(){
        return $this->serverID;
    }
    
    public function setServer($server){
        $this->server = $server;
        return $this;
    }
    
    public function getServer(){
        return $this->server;
    }
    
    public function setPort($port){
        $this->port = (int)$port;
    }
    
    public function getPort(){
        return $this->port;
    }
    
    public function setUsername($username){
        $this->username = $username;
        return $this;
    }
    
    public function getUsername(){
        return $this->username;
    }
    
    public function setPassword($password){
        $this->password = $password;
    }
    
    public function getPassword(){
        return $this->password;
    }
    
}
