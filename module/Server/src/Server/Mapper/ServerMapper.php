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

use Doctrine\ORM\EntityManager;
use Server\Entity\Server;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Zend\Paginator\Paginator;

class ServerMapper implements ServerMapperInterface{
    
    protected $oServerRepository;
    protected $oEntityManager;
    
    public function setEntityManager(EntityManager $oEntityManager){
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

    /**
     * 
     * @param bool $blPagination
     * @param array $aFilter
     * @return Paginator|array
     */
    public function getServers($blPagination, array $aFilter = array()) {
        $oEM    = $this->getEntityManager();
        $oRepo  = $oEM->getRepository("Server\Entity\Server");
        $oQB    = $oRepo->createQueryBuilder("s");
        
        $oQuery = $oQB->getQuery();
        
        if($blPagination){
            $oORMPaginator  = new ORMPaginator($oQuery);
            $oAdapter       = new DoctrineAdapter($oORMPaginator);
            $oResult        = new Paginator($oAdapter);
        }else{
            $oResult = $oQuery->getResult();
        }
        
        return $oResult;
    }

    public function update(array $data, $id) {
        
    }

}
