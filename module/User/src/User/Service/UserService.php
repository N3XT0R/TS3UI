<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2014, Ilya Beliaev
 * @since          Version 1.0
 */

namespace User\Service;

use Zend\Authentication\AuthenticationServiceInterface;
use TSCore\Adapter\Teamspeak3AdapterInterface;

class UserService implements UserServiceInterface{
    
    protected $authentication;
    protected $teamspeak;
    
    public function __construct(AuthenticationServiceInterface $authentication, Teamspeak3AdapterInterface $teamspeak) {
        $this->setAuthentication($authentication);
        $this->setTeamspeak($teamspeak);
    }

    public function getAuthentication() {
        return $this->authentication;
    }

    public function setAuthentication(AuthenticationServiceInterface $authentication) {
        $this->authentication = $authentication;
        return $this;
    }
    
    public function getTeamspeak() {
        return $this->teamspeak;
    }

    public function setTeamspeak(Teamspeak3AdapterInterface $teamspeak) {
        $this->teamspeak = $teamspeak;
        return $this;
    }
    
    public function login(array $data){
        
    }

    

}
