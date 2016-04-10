<?php
/**
 * Created by PhpStorm.
 * User: N3X-Home
 * Date: 10.04.2016
 * Time: 23:34
 */

namespace API\Service;

use Zend\Soap\Server;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ServerServiceFactory implements FactoryInterface{

    /**
     * @inheritDoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $sm                 = $serviceLocator->getServiceLocator();
        $aConfig            = $sm->get("Config");
        $aClassmap          = $aConfig["server_classmap"];

        $oSoapServer        = new Server(null, array(
            'soap_version'  => SOAP_1_2,
            'classmap'      => $aClassmap,
        ));

        $oService           = new ServerService();
        $oService->setSoapServer($oSoapServer);
        return $oService;
    }


}