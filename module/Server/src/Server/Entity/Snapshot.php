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

namespace Server\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity 
 * @ORM\Table(name="snapshot")
 */
class Snapshot {
    
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $snapshotId;
    
    /**
     * @ORM\ManyToOne(targetEntity="Server")
     * @ORM\JoinColumn(name="serverID", referencedColumnName="serverID")
     */
    protected $server;
    
    /** 
     * @ORM\Column(type="integer") 
     */
    protected $virtualServerID;
    
    /** 
     * @ORM\Column(type="text") 
     */
    protected $config;
    
    /**
     * @ORM\Column(name="timestamp", type="datetime")
     */
    protected $timestamp;
    
    /**
     * Set Snapshot Id
     * @param int $snapshotId
     * @return \Server\Entity\Snapshot
     */
    public function setSnapshotId($snapshotId){
        $this->snapshotId = $snapshotId;
        return $this;
    }
    
    /**
     * Get Snapshot Id
     * @return int
     */
    public function getSnapshotId(){
        return $this->snapshotId;
    }
    
    /**
     * Set Server
     * @param \Server\Entity\ServerInterface $server
     * @return \Server\Entity\Snapshot
     */
    public function setServer(ServerInterface $server){
        $this->server = $server;
        return $this;
    }
    
    /**
     * Get Server
     * @return ServerInterface
     */
    public function getServer(){
        return $this->server;
    }
    
    /**
     * Set VirtualServer ID
     * @param integer $virtualServerID
     * @return \Server\Entity\Snapshot
     */
    public function setVirtualServerID($virtualServerID){
        $this->virtualServerID = (int)$virtualServerID;
        return $this;
    }
    
    /**
     * Get VirtualServer ID
     * @return integer
     */
    public function getVirtualServerID(){
        return $this->virtualServerID;
    }
    
    /**
     * Set Config
     * @param string $config
     * @return \Server\Entity\Snapshot
     */
    public function setConfig($config){
        $this->config = $config;
        return $this;
    }
    
    /**
     * Get Config
     * @return string
     */
    public function getConfig(){
        return $this->config;
    }
    
    /**
     * Set Timestamp
     * @param \DateTime $timestamp
     * @return \Server\Entity\Snapshot
     */
    public function setTimestamp(\DateTime $timestamp){
        $this->timestamp = $timestamp;
        return $this;
    }
    
    /**
     * Get Timestamp
     * @return \DateTime
     */
    public function getTimestamp(){
        return $this->timestamp;
    }
    
    /**
     * Updates a Timestamp to current datetime
     * @return \Server\Entity\Snapshot
     */
    public function setUpdated(){
        $dateTime = new \DateTime("now");
        $this->setTimestamp($dateTime);
        return $this;
    }
}
