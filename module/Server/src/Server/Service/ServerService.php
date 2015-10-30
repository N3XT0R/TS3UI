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
        if (!isset($this->aForms[$sType])){
            $this->getEventManager()->trigger(
                'setForm', __CLASS__, array('type' => $sType)
            );
        }
        return $this->aForms[$sType];
    }

    public function save(array $data, $id){
        
        
    }
    
    /**
     * Create a new dedicated Server
     * @param array $data Input data
     * @return \Server\Entity\Server|null
     */
    public function create(array $data){
        $oServer    = null;
        $oForm      = $this->getForm("ServerCreate");
        $oForm->setData($data);
        
        if(!$oForm->isValid()){
            return false;
        }
        
        $oMapper    = $this->getServerMapper();
        
        try{
            $oServer    = $oMapper->create($oForm->getData());
            $this->addMessage("success", "SERVER_CREATE_SUCCESS");
        } catch (\Exception $ex) {
            print_r($ex->getMessage());
            $this->addMessage("error", "SERVER_CREATE_FAILED");
        }
        
        return $oServer;
    }
    
    /**
     * 
     * @param bool $blPagination
     * @param array $aFilter
     * @return \Zend\Paginator\Paginator|array
     */
    public function fetchServers(array $aFilter = array()){
        $oResult = $this->getServerMapper()->getServers(true, $aFilter);
        return $oResult;
    }

}
