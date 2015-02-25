<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace User\Authentication;

use Zend\Authentication\Result;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Crypt\Password\Bcrypt;
use Doctrine\ORM\EntityRepository;

class BcryptAdapter implements AdapterInterface{
    
    protected $authenticateResultInfo;
    protected $identity;
    protected $credential;
    protected $entityManager;
    protected $bcrypt;
    
    public function __construct(EntityRepository $entityManager, Bcrypt $bCrypt) {
        $this->setEntityRepository($entityManager);
        $this->setBcrypt($bCrypt);
    }
    
    public function setBcrypt(Bcrypt $bcypt){
        $this->bcrypt = $bcypt;
        return $this;
    }
    
    /**
     * 
     * @return \Zend\Crypt\Password\Bcrypt
     */
    public function getBcrypt(){
        return $this->bcrypt;
    }
    
    
    public function setEntityRepository(EntityRepository $entityManager){
        $this->entityManager = $entityManager;
        return $this;
    }
    
    /**
     * 
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getEntityRepositoryr(){
        return $this->entityManager;
    }
    
    public function setIdentity($identity){
        $this->identity = $identity;
        return $this;
    }
    
    public function getIdentity(){
        return $this->identity;
    }
    
    public function setCredential($credential){
        $this->credential = $credential;
        return $this;
    }
    
    public function getCredential(){
        return $this->credential;
    }
    
    /**
     * Setup for authentication result
     */
    protected function setupResult(){
        // setup result info
        $this->authenticateResultInfo = array(
            'code'     => Result::FAILURE,
            'identity' => $this->getIdentity(),
            'messages' => array()
        );
        
        return true;
    }
    
    /**
     * Creates a Zend\Authentication\Result object 
     *
     * @return AuthenticationResult
     */
    protected function createResult(){
        return new Result(
            $this->authenticateResultInfo['code'],
            $this->authenticateResultInfo['identity'],
            $this->authenticateResultInfo['messages']
        );
    }
    
    public function authenticate() {
        $this->setupResult();
        
        if(!$this->getIdentity()){
            $this->authenticateResultInfo["messages"][] = "The Username Field is required.";
            return $this->createResult();
        }
        
        if(!$this->getCredential()){
            $this->authenticateResultInfo["messages"][] = "The Password Field is required.";
            return $this->createResult();
        }
        
        $oUser = $this->getEntityRepositoryr()->findOneBy(array(
            "username" => $this->getIdentity(),
        ));
        if(!$oUser){
            $this->authenticateResultInfo["messages"][] = "Login failed.";
            return $this->createResult();
        }
        $bcrypt = $this->getBcrypt();
        $bcrypt->setSalt($oUser->getSalt());
        $verify = $bcrypt->verify($this->getCredential(), $oUser->getPassword());
        
        if(!$verify){
            $this->authenticateResultInfo['code'] =  Result::FAILURE_CREDENTIAL_INVALID;
            $this->authenticateResultInfo['messages'][] = 'Login failed.';
            return $this->createResult();
        }
        
        $this->authenticateResultInfo['code'] = Result::SUCCESS;
        $this->authenticateResultInfo['identity'] = $oUser;
        $this->authenticateResultInfo["messages"][] = "Successfully logged in.";
        
        return $this->createResult();
    }

}
