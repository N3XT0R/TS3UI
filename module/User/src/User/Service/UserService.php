<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2014, Ilya Beliaev
 * @since          Version 1.0
 */

namespace User\Service;

use Zend\Authentication\AuthenticationServiceInterface;
use Doctrine\ORM\EntityManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class UserService implements 
UserServiceInterface,
EventManagerAwareInterface
{
    
    protected $authentication;
    protected $entityRepository;
    protected $eventManager;
    protected $form = array();
    protected $aMessages = array();
    
    public function __construct(EntityManager $entityManager) {

        $this->setEntityManager($entityManager);
    }
    
    /**
     * Add new Message
     * @param string $sType Type of Message (e.g. error, info, success)
     * @param string $sMessage Message
     * @return \User\Service\UserService
     */
    public function addMessage($sType, $sMessage){
        $this->aMessages[$sType] = $sMessage;
        return $this;
    }
    
    /**
     * Set multiple Messages
     * @param array $aMessages
     * @return \User\Service\UserService
     */
    public function setMessages(array $aMessages){
        $this->aMessages = $aMessages;
        return $this;
    }
    
    /**
     * Get Messages
     * @return array
     */
    public function getMessages(){
        return $this->aMessages;
    }
    
    /**
     * Clean Messages
     * @return \User\Service\UserService
     */
    public function cleanMessages(){
        $this->aMessages = array();
        return $this;
    }
    
    /**
     * 
     * @return EntityManager
     */
    public function getEntityManager() {
        return $this->entityRepository;
    }

    public function setEntityManager(EntityManager $entityManager) {
        $this->entityRepository = $entityManager;
        return $this;
    }

    /**
     * 
     * @return \Zend\Authentication\AuthenticationService
     */
    public function getAuthentication() {
        return $this->authentication;
    }

    public function setAuthentication(AuthenticationServiceInterface $authentication) {
        $this->authentication = $authentication;
        return $this;
    }
    
    public function setForm($type, $form){
        $this->form[$type] = $form;
    }
    
    /**
     * 
     * @param type $type
     * @return \Zend\Form\Form
     */
    public function getForm($type = "login"){
        if(!isset($this->form[$type])){
            $this->getEventManager()->trigger(
                'setForm', __CLASS__, array("type" => $type)
            );
        }
        return $this->form[$type];
    }
    
    public function getUserList($page = 1, $perPage = 15){
        $query = $this->getEntityManager()->getRepository("User\Entity\User")
                                          ->createQueryBuilder("u")
                                          ->addSelect("userRole")
                                          ->join("u.role", "userRole")
                                          ->getQuery();
        $oPaginator = new Paginator(
            new DoctrinePaginator(new ORMPaginator($query))
        );
        $oPaginator->setCurrentPageNumber($page);
        $oPaginator->setItemCountPerPage($perPage);
        
        return $oPaginator;
    }
    
    public function getEventManager() {
        return $this->eventManager;
    }

    public function setEventManager(EventManagerInterface $eventManager) {
        $eventManager->setIdentifiers(array(__CLASS__));
        $this->eventManager = $eventManager;
    }

}
