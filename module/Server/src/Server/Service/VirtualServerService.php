<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id: f5a5e9bd773132fa6fd6d04da423f28985b77a6f $
 * $Date$
 */

namespace Server\Service;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Server\Entity\ServerInterface;

class VirtualServerService implements EventManagerAwareInterface{
    
    use EventManagerAwareTrait;
    
    protected $aMessages = array();
    protected $oTeamspeakService;
    
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
     * Get one Virtual Server
     * @param ServerInterface $oServer
     * @param integer $id
     * @return \TeamSpeak3\Node\Server|null
     */
    public function getOneVirtualServerById(ServerInterface $oServer, $id){
        $oVirtualServer = null;
        $oTeamspeak = $this->getTeamspeakService();
        $oTeamspeak->setServer($oServer);
        
        try{
            $oVirtualServer = $oTeamspeak->getOneVirtualServerById($id);
        } catch (\Exception $ex) {
            $this->addMessage("error", $ex->getMessage());
        }
        
        return $oVirtualServer;
    }
    
}
