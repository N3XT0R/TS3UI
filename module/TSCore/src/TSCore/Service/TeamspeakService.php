<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace TSCore\Service;

use TSCore\Entity\ServerInterface;
use TSCore\Adapter\Teamspeak3AdapterInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

class TeamspeakService implements EventManagerAwareInterface{
    
    use EventManagerAwareTrait;
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
    
    public function connect($server_id = null){
        $oServer = $this->getServer();
        $config = array(
            "username"  => $oServer->getUsername(),
            "password"  => $oServer->getPassword(),
            "server"    => $oServer->getServer(),
            "port"      => $oServer->getPort(),
        );
        if($server_id){
            $config["server_id"] = $server_id;
        }
        
        $this->getTeamspeakAdapter()->setConfig($config)
                                    ->connect();
        return $this;
    }
    
    public function getVirtualServer(){
        $this->connect();
        $oTSHost = $this->getTeamspeakAdapter()->getTeamspeak();
        $aServerList = $oTSHost->serverList();
        return $aServerList;
    }
    
    /**
     * Get one Virtual Server by ID
     * @param integer $id
     * @return \TeamSpeak3\Node\Server
     */
    public function getOneVirtualServerById($id){
        $this->connect($id);
        $oTSHost = $this->getTeamspeakAdapter()->getTeamspeak();
        return $oTSHost;
    }
}
