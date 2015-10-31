<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id: 1168ccdf6bca74bd7d4cd0526934b75597c480e4 $
 * $Date$
 */

namespace Server\Service;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

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
    
    
}
