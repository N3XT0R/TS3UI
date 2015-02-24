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

class UserService implements UserServiceInterface{
    
    protected $authentication;
    protected $entityRepository;
    
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
     * @return \Zend\Authentication\AuthenticationServiceInterface
     */
    public function getAuthentication() {
        return $this->authentication;
    }

    public function setAuthentication(AuthenticationServiceInterface $authentication) {
        $this->authentication = $authentication;
        return $this;
    }
    
    public function login(array $data){
        
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

    

}
