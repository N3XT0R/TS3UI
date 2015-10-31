<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id: 975a93be3f74b42477b38c68bdb44ba2821820be $
 * $Date$
 */

namespace TSCore\Service;

use ZfcBase\EventManager\EventProvider;
use TSCore\Entity\ServerInterface;
use TSCore\Adapter\Teamspeak3AdapterInterface;

class TeamspeakService extends EventProvider{
    
    protected $oServer;
    protected $oTeamspeakAdapter;
    
    /**
     * Set Teamspeak Adapter
     * @param Teamspeak3AdapterInterface $oTeamspeakAdapter
     * @return \TSCore\Service\TeamspeakService
     */
    public function setTeamspeakAdapter(Teamspeak3AdapterInterface $oTeamspeakAdapter){
        $this->oTeamspeakAdapter = $oTeamspeakAdapter;
        return $this;
    }
    
    
    /**
     * Get Teamspeak Adapter
     * @return Teamspeak3AdapterInterface
     */
    public function getTeamspeakAdapter(){
        return $this->oTeamspeakAdapter;
    }
    
    /**
     * Set Server
     * @param ServerInterface $oServer
     * @return \TSCore\Service\TeamspeakService
     */
    public function setServer(ServerInterface $oServer){
        $this->oServer = $oServer;
        return $this;
    }
    
    /**
     * Get Server
     * @return ServerInterface
     */
    public function getServer(){
        return $this->oServer;
    }
    
    public function getVirtualServer(){
        $oServer = $this->getServer();
        $config = array(
            "username"  => $oServer->getUsername(),
            "password"  => $oServer->getPassword(),
            "server"    => $oServer->getServer(),
            "port"      => $oServer->getPort(),
        );
        $oTS = $this->getTeamspeakAdapter();
        $oTS->setConfig($config);
        $oTSHost = $oTS->connect()->getTeamspeak();
        $aServerList = $oTSHost->serverList();
        return $aServerList;
    }
}
