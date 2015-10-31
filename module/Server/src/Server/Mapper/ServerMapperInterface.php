<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id: 076dc75141b62cdc19aed2bbfbc0d25afe185cba $
 * $Date$
 */

namespace Server\Mapper;

use Server\Entity\Server;

interface ServerMapperInterface {
    
    
    /**
     * Get single Server-Entity
     * @param integer $id
     * @return Server
     */
    public function getOneById($id);
    
    /**
     * 
     * @param bool $blPagination
     * @param array $aFilter
     * @return Paginator|array
     */
    public function getServers($blPagination, array $aFilter = []);
    
    public function update(array $data, $id);
    
    public function create(array $data);
    
    public function delete($id);
}
