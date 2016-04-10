<?php

/*
 * TS3UI - Teamspeak 3 Webinterface
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace Server\Service;

use Server\Mapper\SnapshotMapper;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;
use Server\Entity\Server;
use TeamSpeak3\Node\Server as VirtualServer;
use TeamSpeak3\TeamSpeak3;
use TeamSpeak3\Ts3Exception;
use Server\Entity\Snapshot;

class SnapshotService implements EventManagerAwareInterface{
    
    use EventManagerAwareTrait;
    
    protected $aMessages = array();
    protected $oTeamspeakService;
    protected $oForms = array();
    protected $oMapper;
    
    public function setTeamspeakService($oTeamspeakService){
        $this->oTeamspeakService = $oTeamspeakService;
        return $this;
    }
    
    /**
     * 
     * @return \TSCore\Service\TeamspeakService
     */
    public function getTeamspeakService(){
        return $this->oTeamspeakService;
    }

    /**
     * @return SnapshotMapper
     */
    public function getSnapshotMapper(){
        return $this->oMapper;
    }
    
    public function setSnapshotMapper(SnapshotMapper $oSnapshotMapper){
        $this->oMapper = $oSnapshotMapper;
        return $this;
    }
    
    /**
     * add Message
     * @param string $sType
     * @param string $sMessage
     * @return \Server\Service\ServerService
     */
    public function addMessage($sType, $sMessage){
        $this->aMessages[$sType][] = $sMessage;
        return $this;
    }

    /**
     * get Messages
     * @return array
     */
    public function getMessages(){
        return $this->aMessages;
    }

    /**
     * set Messages
     * @param array $aMessages
     * @return \Server\Service\ServerService
     */
    public function setMessages(array $aMessages){
        $this->aMessages = $aMessages;
        return $this;
    }

    /**
     * Clear Messages
     * @return \Server\Service\ServerService
     */
    public function clearMessages(){
        $this->aMessages = array();
        return $this;
    }
    
    /**
     * 
     * @param Server $oServer
     * @param VirtualServer $oVirtualServer
     * @return type
     */
    public function createServerSnapshot(Server $oServer, VirtualServer $oVirtualServer){
        $oSnapshot          = null;
        
        try{
            $sSnapshot          = $oVirtualServer->snapshotCreate(TeamSpeak3::SNAPSHOT_BASE64);
        } catch (Ts3Exception $ex) {

        }

        $oSnapshotMapper        =  $this->getSnapshotMapper();


        
        $aData = [
            'serverID'              => $oServer->getServerID(),
            'virtualServerID'       => $oVirtualServer->getId(),
            'config'                => $sSnapshot,
        ];

        
        try{
           $oSnapshot = $oSnapshotMapper->create($aData);
            $this->addMessage("success", "SERVER_VIRTUAL_SNAPSHOT_CREATE_SUCCESS");
        } catch (\Exception $ex) {
            $this->addMessage("error", "SERVER_VIRTUAL_SNAPSHOT_CREATE_FAILED");
        }
        
        return $oSnapshot;
    }

    /**
     * @param $id
     * @return Snapshot|null
     */
    public function getServerSnapshotByID($id){
        $oSnapshot          = null;
        $oSnapshotMapper    = $this->getSnapshotMapper();
        $oSnapshot          = $oSnapshotMapper->getOneById($id);
        return $oSnapshot;
    }
}
