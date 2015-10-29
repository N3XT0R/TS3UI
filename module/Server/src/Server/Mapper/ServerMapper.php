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

class ServerMapper implements ServerMapperInterface{
    
    protected $oServerRepository;
    
    /**
     * Set Server-Repository
     * @param EntityRepository $oServerRepository
     * @return \Server\Service\ServerService
     */
    public function setServerRepository(EntityRepository $oServerRepository){
        $this->oServerRepository = $oServerRepository;
        return $this;
    }
    
    /**
     * Get Server-Repository
     * @return EntityRepository
     */
    public function getServerRepository(){
        return $this->oServerRepository;
    }
    
    /**
     * Get single Server-Entity
     * @param integer $id
     * @return Server
     */
    public function getOneById($id){
        $oRepository = $this->getServerRepository();
        /* @var $oServer ServerEntity */
        $oServer     = $oRepository->findOneBy(array("serverID" => $id));
        return $oServer;
    }

    public function create(array $data) {
        
    }

    public function delete($id) {
        
    }

    public function getServers($blPagination, $aFilter = array()) {
        
    }

    public function update(array $data, $id) {
        
    }

}
