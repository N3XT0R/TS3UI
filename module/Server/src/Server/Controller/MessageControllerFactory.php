<?php
/**
 * Created by PhpStorm.
 * User: N3X-Home
 * Date: 01.03.2017
 * Time: 21:18
 */

namespace Server\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MessageControllerFactory implements FactoryInterface{

    /**
     * @inheritDoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $oSM    = $serviceLocator->getServiceLocator();

        $oController    = new MessageController();
        return $oController;
    }


}