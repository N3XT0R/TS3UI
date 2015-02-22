<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace TSCore\Authentication;

use Zend\Authentication\Result;
use Zend\Authentication\Adapter\AdapterInterface;
use TSCore\Adapter\Teamspeak3AdapterInterface;
use TSCore\Entity\SuperAdmin;

class TS3Adapter implements AdapterInterface{
    
    protected $authenticateResultInfo;
    protected $identity;
    protected $credential;
    protected $teamspeak;
    protected $config;
    
    public function __construct(Teamspeak3AdapterInterface $teamspeak, array $config) {
        $this->setTeamspeakAdapter($teamspeak);
        $this->setConfig($config);
    }
    
    public function setConfig(array $config){
        $this->config = $config;
    }
    
    public function getConfig(){
        return $this->config;
    }
    
    public function setTeamspeakAdapter(Teamspeak3AdapterInterface $teamspeak){
        $this->teamspeak = $teamspeak;
        return $this;
    }
    
    /**
     * 
     * @return \TSCore\Adapter\Teamspeak3AdapterInterface
     */
    public function getTeamspeakAdapter(){
        return $this->teamspeak;
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
        
        try{
            $onfig = $this->getConfig();
            $config["username"] = $this->getIdentity();
            $config["password"] = $this->getCredential();
            $this->getTeamspeakAdapter()->init($config);
            $this->getTeamspeakAdapter()->connect();
        } catch (\Exception $ex) {
            $this->authenticateResultInfo["code"] = Result::FAILURE_CREDENTIAL_INVALID;
            $this->authenticateResultInfo["messages"][] = "Login failed.";
            return $this->createResult();
        }
        
        $oUser = new SuperAdmin();
        $oUser->setUsername($this->getIdentity());
        $oUser->setPassword($this->getCredential());
        
        $this->authenticateResultInfo['code'] = Result::SUCCESS;
        $this->authenticateResultInfo['identity'] = $oUser;
        $this->authenticateResultInfo["messages"][] = "Successfully logged in.";
        
        return $this->createResult();
    }

}
