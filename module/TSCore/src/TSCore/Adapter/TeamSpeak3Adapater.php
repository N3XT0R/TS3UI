<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace TSCore\Adapter;

use TeamSpeak3\TeamSpeak3;
use Zend\Stdlib\Exception\InvalidArgumentException;
use TeamSpeak3\Node\Server;

class TeamSpeak3Adapater implements TeamSpeak3AdapaterInterface{

    protected $ts;
    
    public function init($config) {
        
        if(!array_key_exists("username", $config)){
            throw new InvalidArgumentException("Username for Teamspeak-Server not set");
        }
        
        if(!array_key_exists("password", $config)){
            throw new InvalidArgumentException("Password for Teamspeak-Server not set");
        }
        
        if(!array_key_exists("server", $config)){
            throw new InvalidArgumentException("Servername for Teamspeak-Server not set");
        }
        
        if(!array_key_exists("port", $config)){
            throw new InvalidArgumentException("Port for Teamspeak-Server not set");
        }
        
        $username = $config["username"];
        $password = $config["password"];
        $server = $config["server"];
        $port = $config["port"];
        $ts = TeamSpeak3::factory("serverquery://$username:$password@$server/?server_port=$port");
        $this->setTeamspeak($ts);
    }

    public function writeMessage($message) {
        $this->getTeamspeak()->message($message);
    }

    /**
     * Get Teamspeak
     * @return Server
     */
    public function getTeamspeak() {
        return $this->ts;
    }

    /**
     * Set Teamspeak
     * @param TeamSpeak3 $teamspeak
     */
    public function setTeamspeak(Server $teamspeak) {
        $this->ts = $teamspeak;
    }

}
