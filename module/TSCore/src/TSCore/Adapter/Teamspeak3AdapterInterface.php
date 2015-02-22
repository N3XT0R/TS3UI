<?php

namespace TSCore\Adapter;

use TeamSpeak3\Node\Server;

interface Teamspeak3AdapterInterface {
    
    public function init(array $config);
    
    public function connect();
    
    public function writeMessage($message);
    
    public function setTeamspeak(Server $teamspeak);
    
    /**
     * @return TeamSpeak3
     */
    public function getTeamspeak();
    
    public function setConfig(array $config);
    public function getConfig();
    
}
