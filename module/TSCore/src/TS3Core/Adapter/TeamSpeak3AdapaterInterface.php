<?php

namespace TS3Core\Adapter;

use TeamSpeak3\Node\Server;

interface TeamSpeak3AdapaterInterface {
    
    public function init($config);
    
    public function writeMessage($message);
    
    public function setTeamspeak(Server $teamspeak);
    
    /**
     * @return TeamSpeak3
     */
    public function getTeamspeak();
}
