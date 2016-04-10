<?php

/**
 * Created by PhpStorm.
 * User: N3X-Home
 * Date: 10.04.2016
 * Time: 23:30
 */

namespace API\Service;
use Zend\Soap\Server;

class ServerService {

    private $oSoapServer;

    public function setSoapServer(Server $oServer){
        $this->oSoapServer = $oServer;
        return $this;
    }

    public function getSoapServer(){
        return $this->oSoapServer;
    }

}