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
use Doctrine\ORM\EntityRepository;
use Server\Entity\ServerEntity;

class ServerService implements EventManagerAwareInterface{

    protected $aForms = array();
    protected $aMessages = array();#
    protected $oEventManager;
    protected $oServerRepository;
    
    /**
     * Set Server-Repository
     * @param EntityRepository $oServerRepository
     * @return \Server\Service\ServerService
     */
    public function setServerRepository(EntityRepository $oServerRepository){
        $this->oServerRepository = $oServerRepository;
        return $this;
    }
    
    /**
     * Get Server-Repository
     * @return EntityRepository
     */
    public function getServerRepository(){
        return $this->oServerRepository;
    }

    /**
     * Get EventManager
     * @return EventManagerInterface
     */
    public function getEventManager() {
        return $this->oEventManager;
    }

    /**
     * Set EventManager
     * @param EventManagerInterface $eventManager
     * @return \Server\Service\ServerService
     */
    public function setEventManager(EventManagerInterface $eventManager) {
        $eventManager->setIdentifiers(array(__CLASS__));
        $this->oEventManager = $eventManager;
        return $this;
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

    /**
     * Get single Server-Entity
     * @param int $id
     * @return ServerEntity
     */
    public function getOneById($id){
        $oRepository = $this->getServerRepository();
        /* @var $oServer ServerEntity */
        $oServer     = $oRepository->findOneBy(array("serverID" => $id));
        return $oServer;
    }
    
    

}
