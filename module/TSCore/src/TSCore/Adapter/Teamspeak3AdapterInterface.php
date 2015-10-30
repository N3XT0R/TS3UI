<?php

namespace TSCore\Adapter;

use TeamSpeak3\Node\Host;

interface Teamspeak3AdapterInterface {
    
    /**
     * @return Teamspeak3AdapterInterface
     */
    public function connect();
    
    
    
    public function setTeamspeak(Host $teamspeak);
    
    /**
     * @return Host
     */
    public function getTeamspeak();
    
    public function setConfig(array $config);
    public function getConfig();
    
}
