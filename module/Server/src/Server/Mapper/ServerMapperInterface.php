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

use Doctrine\ORM\EntityManagerInterface;
use Server\Entity\Server;

interface ServerMapperInterface {
    
    
    /**
     * Get single Server-Entity
     * @param integer $id
     * @return Server
     */
    public function getOneById($id);
    
    public function getServers($blPagination, $aFilter = array());
    
    public function update(array $data, $id);
    
    public function create(array $data);
    
    public function delete($id);
}
