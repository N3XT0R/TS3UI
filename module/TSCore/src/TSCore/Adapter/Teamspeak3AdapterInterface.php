<?php

namespace TSCore\Adapter;

use TeamSpeak3\Node\AbstractNode;
use TeamSpeak3\Node\Host;
use TeamSpeak3\Node\Server;

interface Teamspeak3AdapterInterface {
    
    /**
     * @return Teamspeak3AdapterInterface
     */
    public function connect();
    
    
    
    public function setTeamspeak(AbstractNode $teamspeak);
    
    /**
     * @return Host|Server
     */
    public function getTeamspeak();
    
    public function setConfig(array $config);
    public function getConfig();
    
}
