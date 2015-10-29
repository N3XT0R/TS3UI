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
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class ServerMapper implements ServerMapperInterface{
    
    protected $oServerRepository;
    protected $oEntityManager;
    
    public function setEntityManager(EntityManagerInterface $oEntityManager){
        $this->oEntityManager = $oEntityManager;
        return $this;
    }
    
    public function getEntityManager(){
        return $this->oEntityManager;
    }
    
    
    /**
     * Get single Server-Entity
     * @param integer $id
     * @return Server
     */
    public function getOneById($id){
        $oEM = $this->getEntityManager();
        $oRepository = $oEM->getRepository("Server\Entity\Server");
        
        /* @var $oServer ServerEntity */
        $oServer     = $oRepository->findOneBy(array("serverID" => $id));
        return $oServer;
    }

    /**
     * Create new Server
     * @param array $data
     * @return Server
     */
    public function create(array $data) {
        $oEM = $this->getEntityManager();
        $oHydrator = new DoctrineHydrator($oEM);
        $oServer = $oHydrator->hydrate($data, new Server());
        
        $oEM->persist($oServer);
        $oEM->flush();
        
        return $oServer;
    }

    public function delete($id) {
        
    }

    public function getServers($blPagination, $aFilter = array()) {
        
    }

    public function update(array $data, $id) {
        
    }

}
