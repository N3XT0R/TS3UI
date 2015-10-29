<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Server\Entity;


interface ServerInterface{
    
    public function setServerID($serverID);
    public function getServerID();
    
    public function setServer($server);
    public function getServer();
    
    public function setPort($port);
    public function getPort();
    
    public function setUsername($username);
    public function getUsername();
    
    public function setPassword($password);
    public function getPassword();
}
