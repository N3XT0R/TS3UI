<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id: fe250fd9d2d854fcb4243692dd360535149ddc90 $
 * $Date$
 */

namespace Server\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @ORM\Entity 
 * @ORM\Table(name="server")
 */
class Server implements ServerInterface{
    
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $serverID;
    
    /** @ORM\Column(type="string") */
    protected $server;
    
    /** @ORM\Column(type="integer") */
    protected $port;
    
    /** @ORM\Column(type="string") */
    protected $username;
    
    /** @ORM\Column(type="string") */
    protected $password;
    
    /**
     * @ORM\OneToMany(targetEntity="Snapshot", mappedBy="server")
     */
    protected $snapshots;
    
    public function __construct() {
        $snapshots = new ArrayCollection();
        $this->setSnapshots($snapshots);
    }
    
    public function setServerID($serverID){
        $this->serverID = $serverID;
        return $this;
    }
    
    public function getServerID(){
        return $this->serverID;
    }
    
    public function setServer($server){
        $this->server = $server;
        return $this;
    }
    
    public function getServer(){
        return $this->server;
    }
    
    public function setPort($port){
        $this->port = (int)$port;
    }
    
    public function getPort(){
        return $this->port;
    }
    
    public function setUsername($username){
        $this->username = $username;
        return $this;
    }
    
    public function getUsername(){
        return $this->username;
    }
    
    public function setPassword($password){
        $this->password = $password;
    }
    
    public function getPassword(){
        return $this->password;
    }
    
    /**
     * Set Snapshots
     * @param ArrayCollection|Snapshot[] $snapshots
     * @return \Server\Entity\Server
     */
    public function setSnapshots(ArrayCollection $snapshots){
        $this->snapshots = $snapshots;
        return $this;
    }
    
    /**
     * Get Snapshots
     * @return ArrayCollection|Snapshot[]
     */
    public function getSnapshots(){
        return $this->snapshots;
    }
    
    /**
     * Add a Snapshot to Snapshot list
     * @param \Server\Entity\Snapshot $snapshot
     * @return \Server\Entity\Server
     */
    public function addSnapshot(Snapshot $snapshot){
        $snapshot->setServer($this);
        $snapshot->setUpdated();
        $this->getSnapshots()->add($snapshot);
        return $this;
    }
    
    /**
     * Get Snapshots for one VirtualServer by its Id
     * @param integer $id VirtualServer ID
     * @return Snapshot[]
     */
    public function getSnapshotsByVirtualServerId($id){
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq("virtualServerID", $id));
        $aSnapshots = $this->getSnapshots()->matching($criteria);
        return $aSnapshots;
    }
}
