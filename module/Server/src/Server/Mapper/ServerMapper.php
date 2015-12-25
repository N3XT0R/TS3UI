<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id: b4503ebad4341de3103471caa18b4d753bc747a7 $
 * $Date$
 */

namespace Server\Mapper;

use Doctrine\ORM\EntityManager;
use Server\Entity\Server;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Zend\Paginator\Paginator;
use Zend\Crypt\BlockCipher;
use Zend\Crypt\Symmetric\Mcrypt;

class ServerMapper implements ServerMapperInterface{
    
    protected $oServerRepository;
    protected $oEntityManager;
    protected $aConfig;
    
    public function setConfig(array $aConfig){
        $this->aConfig = $aConfig;
        return $this;
    }
    
    public function getConfig(){
        return $this->aConfig;
    }
    
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
        
        /* @var $oServer Server */
        $oServer     = $oRepository->findOneBy(["serverID" => $id]);
        if($oServer){
            $sPassword = $oServer->getPassword();
            $sPassword = $this->decryptPassword($sPassword);
            $oServer->setPassword($sPassword);
        }
        return $oServer;
    }

    /**
     * Create new Server
     * @param array $data
     * @return Server
     */
    public function create(array $data) {
        $oEM                = $this->getEntityManager();
        $oHydrator          = new DoctrineHydrator($oEM);
        $data["password"]   = $this->encryptPassword($data["password"]);
        $oServer            = $oHydrator->hydrate($data, new Server());
        
        $oEM->persist($oServer);
        $oEM->flush();
        
        return $oServer;
    }
    
    protected function encryptPassword($sPassword){
        $aConfig    = $this->getConfig();
        
        if(array_key_exists("encryption_key", $aConfig)){
            $sKey = $aConfig["encryption_key"];
        }else{
            $sKey = "changeme";
        }
        
        $oMcrypt = new Mcrypt(array(
            'algo' => 'aes',
        ));
        $oBlockCipher = new BlockCipher($oMcrypt);
        $oBlockCipher->setKey($sKey);
        $sCrypted = $oBlockCipher->encrypt($sPassword);
        return $sCrypted;
    }
    
    protected function decryptPassword($sPassword){
        $aConfig    = $this->getConfig();
        
        if(array_key_exists("encryption_key", $aConfig)){
            $sKey = $aConfig["encryption_key"];
        }else{
            $sKey = "changeme";
        }
        
        $oMcrypt = new Mcrypt(array(
            'algo' => 'aes',
        ));
        $oBlockCipher = new BlockCipher($oMcrypt);
        $oBlockCipher->setKey($sKey);
        $sDecrypted   = $oBlockCipher->decrypt($sPassword);
        return $sDecrypted;
    }

    public function delete($id) {
        
    }

    /**
     * 
     * @param bool $blPagination
     * @param array $aFilter
     * @return Paginator|array
     */
    public function getServers($blPagination, array $aFilter = []) {
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
