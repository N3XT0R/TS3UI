<?php

namespace User\Service;

Use Zend\Authentication\AuthenticationServiceInterface;
use TSCore\Adapter\Teamspeak3AdapterInterface;

interface UserServiceInterface {
    
    public function __construct(AuthenticationServiceInterface $authentication, Teamspeak3AdapterInterface $teamspeak);
    
    public function setAuthentication(AuthenticationServiceInterface $authentication);
    public function getAuthentication();
    
    public function setTeamspeak(Teamspeak3AdapterInterface $teamspeak);
    public function getTeamspeak();
}
