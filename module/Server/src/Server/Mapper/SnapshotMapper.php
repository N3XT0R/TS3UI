<?php

/*
 * TS3UI - Teamspeak 3 Webinterface
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace Server\Mapper;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Server\Entity\Snapshot;

class SnapshotMapper {
    
    protected $oEntityManager;
    
    
    public function setEntityManager(EntityManager $oEntityManager){
        $this->oEntityManager = $oEntityManager;
        return $this;
    }
    
    public function getEntityManager(){
        return $this->oEntityManager;
    }
    
    public function getOneById($id){
        $oEM         = $this->getEntityManager();
        $oRepository = $oEM->getRepository("Server\Entity\Snapshot");
        $oSnapshot   = $oRepository->findOneBy(["snapshotId" => $id]);
        return $oSnapshot;
    }
    
    public function getSnapshots($blPagination, $vserverID = null, array $aFilter = []){
        $oEM    = $this->getEntityManager();
        $oRepo  = $oEM->getRepository("Server\Entity\Snapshot");
        /* @var $oQB \Doctrine\ORM\QueryBuilder */
        $oQB    = $oRepo->createQueryBuilder("s");
        
        if($vserverID !== null){
            $oQB->where("s.virtualServerID = :vserverID");
            $oQB->setParameter("vserverID", $vserverID, \PDO::PARAM_INT);
        }
        
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
    
    /**
     * Create a new Snapshot from a Virtual-Server
     * @param array $data data
     * @return Snapshot
     */
    public function create(array $data){
        $oEM                = $this->getEntityManager();
        $oHydrator          = new DoctrineHydrator($oEM);
        $oSnapshot          = new Snapshot();
        $oSnapshot->setUpdated();
        
        
        $oSnapshot          = $oHydrator->hydrate($data, $oSnapshot);
         
        $oEM->persist($oSnapshot);
        $oEM->flush();
        
        return $oSnapshot;
    }
}
