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
use Zend\Form\FormInterface;

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

    /**
     * set Form
     * @param string $sName
     * @param FormInterface $oForm
     * @return \Server\Service\ServerService
     */
    public function setForm($sName, FormInterface $oForm){
        $this->aForms[$sName] = $oForm;
        return $this;
    }

    /**
     * get Form
     * @param string $sType
     * @return \Zend\Form\FormInterface
     */
    public function getForm($sType){
        $oForm = null;
        if(array_key_exists($sType, $this->aForms)){
            $oForm = $this->aForms[$sType];
        }
        return $oForm;
    }

    public function save(array $data){

    }



}
