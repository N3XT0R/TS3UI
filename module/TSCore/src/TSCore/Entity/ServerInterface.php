<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace TSCore\Entity;

interface ServerInterface {
    
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
