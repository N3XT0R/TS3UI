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
use Server\Entity\Server;
use TeamSpeak3\Node\Server as VirtualServer;
use TeamSpeak3\TeamSpeak3;
use TeamSpeak3\Ts3Exception;

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
    
    /**
     * 
     * @param Server $oServer
     * @return type
     */
    public function createServerSnapshot(Server $oServer, VirtualServer $oVirtualServer){
        $oSnapshot          = null;
        
        try{
            $sSnapshot          = $oVirtualServer->snapshotCreate(TeamSpeak3::SNAPSHOT_BASE64);
        } catch (Ts3Exception $ex) {
            /* @var $oHost \TeamSpeak3\Node\Host */
            $oHost              = $oVirtualServer->getParent();
            var_dump($oVirtualServer);
            die();
            $oClient        = $oVirtualServer->clientGetByName($sUsername);
            var_dump($oClient);
            die();
        }
        
        $oSnapshotMapper    =  $this->getSnapshotMapper();
        
        $aData = [
            'server'                => $oServer,
            'virtualServerID'       => $virtualID,
            'config'                => $sSnapshot,
        ];
        
        var_dump($aData); die();
        
        try{
           $oSnapshot = $oSnapshotMapper->create($aData);
        } catch (\Exception $ex) {}
        
        return $oSnapshot;
    }
}
