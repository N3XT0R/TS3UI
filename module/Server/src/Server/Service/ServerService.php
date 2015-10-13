<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace Server\Service;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;

class ServerService implements EventManagerAwareInterface{
    
    protected $aForms = array();
    protected $aMessages = array();#
    protected $oEventManager;
    
    public function getEventManager() {
        return $this->oEventManager;
    }

    public function setEventManager(EventManagerInterface $eventManager) {
        $eventManager->setIdentifiers(array(__CLASS__));
        $this->oEventManager = $eventManager;
        return $this;
    }
    
    
    public function addMessage($sType, $sMessage){
        $this->aMessages[$sType] = $sMessage;
        return $this;
    }
    
    public function getMessages(){
        return $this->aMessages;
    }
    
    public function setMessages(array $aMessages){
        $this->aMessages = $aMessages;
        return $this;
    }
    
    public function clearMessages(){
        $this->aMessages = array();
        return $this;
    }
    
    public function setForm($sName, $oForm){
        $this->aForms[$sName] = $oForm;
        return $this;
    }
    
    public function getForm(){
        
    }
    
    public function save(array $data){
        
    }

    

}
