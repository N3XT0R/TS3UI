<?php

namespace User\Service;

Use Zend\Authentication\AuthenticationServiceInterface;
use Doctrine\ORM\EntityManager;

interface UserServiceInterface {
    
    public function __construct(AuthenticationServiceInterface $authentication, EntityManager $entityRepository);
    
    public function setAuthentication(AuthenticationServiceInterface $authentication);
    public function getAuthentication();
    
    public function setEntityManager(EntityManager $entityManager);
    public function getEntityManager();
}
