<?php
/**
 * Created by PhpStorm.
 * User: N3X-Home
 * Date: 07.04.2016
 * Time: 21:57
 */

namespace Server\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Server\Service\VirtualServerService;
use Server\Service\SnapshotService;

class SnapshotController extends AbstractActionController
{

    private $oSnapshotService;
    private $oVirtualServerService;
    private $oServerService;

    public function __construct(SnapshotService $oSnapshotService) {
        $this->setSnapshotService($oSnapshotService);
    }

    /**
     * @param SnapshotService $oSnapshotService
     * @return $this
     */
    public function setSnapshotService(SnapshotService $oSnapshotService){
        $this->oSnapshotService = $oSnapshotService;
        return $this;
    }

    /**
     * @return SnapshotService
     */
    public function getSnapshotService(){
        return $this->oSnapshotService;
    }

    /**
     * @return VirtualServerService
     */
    public function getVirtualServerService(){
        return $this->oVirtualServerService;
    }

    /**
     * @param VirtualServerService $oVirtualServerService
     * @return $this
     */
    public function setVirtualServerService(VirtualServerService $oVirtualServerService){
        $this->oVirtualServerService = $oVirtualServerService;
        return $this;
    }

    public function setServerService($oServerService){
        $this->oServerService = $oServerService;
        return $this;
    }
    /**
     *
     * @return \Server\Service\ServerService
     */
    public function getServerService(){
        return $this->oServerService;
    }

    public function indexAction() {
        $serverID       = (int)$this->params()->fromRoute("id", 0);
        $id             = (int)$this->params()->fromRoute("virtualId", 0);
        $snapShotID     = (int)$this->params()->fromRoute("SnapshotId", 0);

        $oSnapshot      = $this->getSnapshotService()->getServerSnapshotByID($snapShotID);
        if(!$oSnapshot){
            $this->redirect()->toRoute("server");
            return false;
        }

        $oServer        = $oSnapshot->getServer();
        $iVirtualId     = $oSnapshot->getVirtualServerID();
        
        if($iVirtualId != $id || $oServer->getServerID() != $serverID){
            $this->redirect()->toRoute("server");
            return false;
        }


        return new ViewModel([
            "oSnapshot"     => $oSnapshot,
        ]);
    }

    public function deleteAction(){
        return new ViewModel([

        ]);
    }

}