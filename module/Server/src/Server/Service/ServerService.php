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

use Zend\Form\FormInterface;
use ZfcBase\EventManager\EventProvider;
use Server\Mapper\ServerMapperInterface;

class ServerService extends EventProvider{

    protected $aForms = array();
    protected $aMessages = array();
    protected $oServerMapper;
    
    /**
     * Set Server Mapper
     * @param ServerMapperInterface $oServerMapper
     * @return \Server\Service\ServerService
     */
    public function setServerMapper(ServerMapperInterface $oServerMapper){
        $this->oServerMapper = $oServerMapper;
        return $this;
    }
    
    /**
     * Get Server Mapper
     * @return ServerMapperInterface
     */
    public function getServerMapper(){
        return $this->oServerMapper;
    }

    /**
     * add Message
     * @param string $sType
     * @param string $sMessage
     * @return \Server\Service\ServerService
     */
    public function addMessage($sType, $sMessage){
        $this->aMessages[$sType] = $sMessage;
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

    public function save(array $data, $id){
        
    }
    
    public function create(array $data){
        
    }

}
