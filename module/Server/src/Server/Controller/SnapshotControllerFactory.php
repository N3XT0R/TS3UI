<?php
/**
 * Created by PhpStorm.
 * User: N3X-Home
 * Date: 07.04.2016
 * Time: 21:58
 */

namespace Server\Controller;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class SnapshotControllerFactory implements  FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sm                     = $serviceLocator->getServicelocator();
        $oService               = $sm->get("Server\Service\Snapshot");#
        $oVirtualService        = $sm->get("Server\Service\VirtualServer");#
        $oController    = new SnapshotController($oService);
        return $oController;
    }


}