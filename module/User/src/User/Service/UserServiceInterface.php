<?php

namespace User\Service;

use Doctrine\ORM\EntityManager;

interface UserServiceInterface {
    
    public function __construct(EntityManager $entityRepository);
    
    public function setEntityManager(EntityManager $entityManager);
    public function getEntityManager();
}
