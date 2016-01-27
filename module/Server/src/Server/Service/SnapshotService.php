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

use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;
use TeamSpeak3\Node\Server;
use TeamSpeak3\TeamSpeak3;

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
    
    public function getSnapshotMapper(){
        return $this->oMapper;
    }
    
    public function setSnapshotMapper($oSnapshotMapper){
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
    
    public function createServerSnapshot(Server $oServer){
        $oSnapshot          = null;
        $sSnapshot          = $oServer->snapshotCreate(TeamSpeak3::SNAPSHOT_BASE64);
        $oSnapshotMapper    =  $this->getSnapshotMapper();
        $oHost              = $oServer->getParent();
        
        $aData = [
            'server'                => $oHost,
            'virtualServerID'       => $oServer->getId(),
            'config'                => $sSnapshot,
        ];
        
        try{
           $oSnapshot = $oSnapshotMapper->create($aData);
        } catch (\Exception $ex) {}
        
        return $oSnapshot;
    }
}
