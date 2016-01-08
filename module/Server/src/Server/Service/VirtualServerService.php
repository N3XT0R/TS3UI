<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id: 0c9abaae62b8f473846eb69a7de2c609efe9bd4b $
 * $Date$
 */

namespace Server\Service;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\Form\FormInterface;
use Server\Entity\ServerInterface;
use TeamSpeak3\Node\Server;

class VirtualServerService implements EventManagerAwareInterface{
    
    use EventManagerAwareTrait;
    
    protected $aMessages = array();
    protected $oTeamspeakService;
    protected $oForms = array();
    
    public function setTeamspeakService($oTeamspeakService){
        $this->oTeamspeakService = $oTeamspeakService;
        return $this;
    }
    
    /**
     * 
     * @return \TSCore\Service\TeamspeakService
     */
    public function getTeamspeakService(){
        return $this->oTeamspeakService;
    }
    
    /**
     * add Message
     * @param string $sType
     * @param string $sMessage
     * @return \Server\Service\ServerService
     */
    public function addMessage($sType, $sMessage){
        $this->aMessages[$sType][] = $sMessage;
        return $this;
    }

    /**
     * get Messages
     * @return array
     */
    public function getMessages(){
        return $this->aMessages;
    }

    /**
     * set Messages
     * @param array $aMessages
     * @return \Server\Service\ServerService
     */
    public function setMessages(array $aMessages){
        $this->aMessages = $aMessages;
        return $this;
    }

    /**
     * Clear Messages
     * @return \Server\Service\ServerService
     */
    public function clearMessages(){
        $this->aMessages = array();
        return $this;
    }
    
    /**
     * get Form
     * @param string $sName
     * @return \Zend\Form\FormInterface
     */
    public function getForm($sName){
        if(!isset($this->oForms[$sName])){
            $this->getEventManager()->trigger(
                'setVirtualServerForm', __CLASS__, array('type' => $sName)
            );
        }
        return $this->oForms[$sName];
    }
    
    /**
     * set Form
     * @param string $sName
     * @param FormInterface $oForm
     * @return \Server\Service\ServerService
     */
    public function setForm($sName, FormInterface $oForm){
        $this->oForms[$sName] = $oForm;
        return $this;
    }
    
    /**
     * Get one Virtual Server
     * @param ServerInterface $oServer
     * @param integer $id VirtualServerID
     * @return \TeamSpeak3\Node\Server|null
     */
    public function getOneVirtualServerById(ServerInterface $oServer, $id){
        $oVirtualServer = null;
        $oTeamspeak = $this->getTeamspeakService();
        $oTeamspeak->setServer($oServer);
        
        try{
            $oVirtualServer = $oTeamspeak->getOneVirtualServerById($id);
        } catch (\Exception $ex) {
            $this->addMessage("error", $ex->getMessage());
        }
        
        return $oVirtualServer;
    }
    
    /**
     * Get Channels (list)
     * @param Server $oServer
     * @param array $aFilter
     * @return \TeamSpeak3\Node\Channel[]
     */
    public function getChannels(Server $oServer, array $aFilter = array()){
        $aChannels = array();
        
        try{
            $aChannels = $oServer->channelList($aFilter);
        } catch (\Exception $ex) {
            $this->addMessage("error", $ex->getMessage());
        }
        
        return $aChannels;
    }
    
    /**
     * Update VirtualServer Settings
     * @param Server $oServer Server-Instance from Database
     * @param array $data Modification-Data
     * @param integer $id virtualServerId
     * @return boolean
     */
    public function update(ServerInterface $oServer, array $data, $id){
        $blResult           = false;
        $oForm              = $this->getForm("VirtualServerEdit");
        $oForm->setData($data);
        
        if(!$oForm->isValid()){
            return false;
        }
        
        $oVirtualServer     = $this->getOneVirtualServerById($oServer, $id);
        
        $this->getEventManager()->trigger(__FUNCTION__.".pre", $this, compact("oForm", "oServer", "oVirtualServer"));
        
        try{
            $aData = $oForm->getData();
            //Remove Application relevant data
            unset($aData["serverID"]);
            unset($aData["virtualserver_id"]);
            $oVirtualServer->modify($aData);
            $blResult       = true;
            $this->addMessage("success", "SERVER_VIRTUAL_UPDATE_SUCCESS");
        } catch (\Exception $ex) {
            $this->addMessage("error", $ex->getMessage());
        }
        
        $this->getEventManager()->trigger(__FUNCTION__.".post", $this, compact("oForm", "oServer", "oVirtualServer", "blResult"));
        
        return $blResult;
    }
    
    
    /**
     * Get Server Group List for a Virtual Server
     * @param ServerInterface $oServer
     * @param integer $id
     * @param array $aFilter
     * @return \TeamSpeak3\Node\Servergroup[]
     */
    public function getServerGroupList(ServerInterface $oServer, $id, array $aFilter = array()){
        $oVirtualServer     = $this->getOneVirtualServerById($oServer, $id);
        $aGroups            = $oVirtualServer->serverGroupList($aFilter);
        return $aGroups;
    }
    
    /**
     * Get Channel Group List for a Virtual Server
     * @param ServerInterface $oServer
     * @param integer $id
     * @param array $aFilter
     * @return \TeamSpeak3\Node\Servergroup[]
     */
    public function getChannelGroupList(ServerInterface $oServer, $id, array $aFilter = array()){
        $oVirtualServer     = $this->getOneVirtualServerById($oServer, $id);
        $aGroups            = $oVirtualServer->channelGroupList($aFilter);
        return $aGroups;
    }
}
