<?php

namespace TSCore\Adapter;

use TeamSpeak3\Node\AbstractNode;

interface Teamspeak3AdapterInterface {
    
    public function init(array $config);
    
    public function connect();
    
    
    
    public function setTeamspeak(AbstractNode $teamspeak);
    
    /**
     * @return AbstractNode
     */
    public function getTeamspeak();
    
    public function setConfig(array $config);
    public function getConfig();
    
}
