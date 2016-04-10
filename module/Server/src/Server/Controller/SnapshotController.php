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

    public function indexAction() {
        return new ViewModel([

        ]);
    }

    public function deleteAction(){
        return new ViewModel([

        ]);
    }

}