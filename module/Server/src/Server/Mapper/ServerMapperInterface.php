<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace Server\Mapper;

use Doctrine\ORM\EntityRepository;
use Server\Entity\Server;

interface ServerMapperInterface {
    
    /**
     * Set Server-Repository
     * @param EntityRepository $oServerRepository
     * @return \Server\Service\ServerService
     */
    public function setServerRepository(EntityRepository $oServerRepository);
    
    /**
     * Get Server-Repository
     * @return EntityRepository
     */
    public function getServerRepository();
    
    /**
     * Get single Server-Entity
     * @param integer $id
     * @return Server
     */
    public function getOneById($id);
}
