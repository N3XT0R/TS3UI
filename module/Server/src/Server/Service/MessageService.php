<?php
/**
 * Created by PhpStorm.
 * User: N3X-Home
 * Date: 01.03.2017
 * Time: 20:39
 */

namespace Server\Service;

use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;
use TeamSpeak3\Node\AbstractNode;

class MessageService implements EventManagerAwareInterface{

    use EventManagerAwareTrait;

    protected $oTeamspeakService;

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

    public function sendTextMessage(AbstractNode $oTarget, $iTargetMode = 2, $iTarget = 1, $sMessage = ""){
        $sPrepared  = $oTarget->prepare("sendtextmessage targetmode=".(int)$iTargetMode." target =".(int)$iTarget." msg =".$sMessage);
        $oTarget->request($sPrepared);
    }

}