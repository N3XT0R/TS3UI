<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2014, Ilya Beliaev
 * @since          Version 1.0
 */

namespace User\Service;

use Zend\Authentication\AuthenticationServiceInterface;
use Doctrine\ORM\EntityManager;
use User\Entity\UserEntity;
use Zend\Math\Rand;
use Doctrine\ORM\ORMException;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\Session\Container;
use Zend\Authentication\Storage\Session;

class UserService implements 
UserServiceInterface,
EventManagerAwareInterface
{
    
    protected $authentication;
    protected $entityRepository;
    protected $eventManager;
    protected $form = array();
    
    public function __construct(AuthenticationServiceInterface $authentication, EntityManager $entityManager) {
        $this->setAuthentication($authentication);
        $this->setEntityManager($entityManager);
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
    
    public function login(array $data){
        $oForm = $this->getForm("login");
        $oForm->setData($data);
        
        if(!$oForm->isValid()){
            //do something
            return false;
        }
        
        $aUser = $oForm->getData();
        
        $oAuthentication = $this->getAuthentication();
        $oAuthentication->getAdapter()->setIdentity($aUser["username"]);
        $oAuthentication->getAdapter()->setCredential($aUser["password"]);
        
        $oResult = $oAuthentication->authenticate();
        
        if(!$oResult->isValid()){
            return false;
        }
        
        return $oResult->getIdentity();
    }
    
    public function logout(){
        $oAuthentication = $this->getAuthentication();
        $oAuthentication->clearIdentity();
        
        $oAuthNamespace = new Container(Session::NAMESPACE_DEFAULT);
        $oAuthNamespace->getManager()->destroy();
        return true;
    }

    public function save(array $data, $id = null){
        $mode = is_null($id) ? "register" : "update";
        $oRepository = $this->getEntityManager()->getRepository("User\Entity\UserEntity");
        
        if($mode == "register"){
            $oUser = new UserEntity();
        }else{
            $oUser = $oRepository->find($id);
        }
        
        $oUser->exchangeArray($data);
        
        if(!empty($data["password"])){
            $bcrypt = $this->getAuthentication()->getAdapter()->getBcrypt();
            $salt = $this->createSalt();
            $bcrypt->setSalt($salt);
            $hash = $bcrypt->create($oUser->getPassword());
            $oUser->setPassword($hash);
            $oUser->setSalt($salt);
        }
        
        try{
            if($mode == "register"){
                $this->getEntityManager()->persist($oUser);
            }else{
                $this->getEntityManager()->refresh($oUser);
            }
            $this->getEntityManager()->flush();
            $id = $oUser->getId();
        } catch (ORMException $ex) {
            return false;
        }
        
        $oUser = $oRepository->find($id);
        return $oUser;
    }
    
    protected function createSalt(){
        return Rand::getString(40);
    }

    public function getEventManager() {
        return $this->eventManager;
    }

    public function setEventManager(EventManagerInterface $eventManager) {
        $eventManager->setIdentifiers(array(__CLASS__));
        $this->eventManager = $eventManager;
    }

}
