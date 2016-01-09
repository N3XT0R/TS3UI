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

namespace Server\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Server\Filter\ServerFilter;

/**
 * Description of ServerEditFormFactory
 *
 * @author N3X-Home
 */
class ServerEditFormFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $oForm = new ServerForm("EditForm");
        $oForm->addTokenElement();
        $oForm->addServerIDElement();
        $oForm->addUsernameElement();
        $oForm->addPasswordElement();
        $oForm->addHostnameElement();
        $oForm->addPortElement();
        $oForm->addSubmitElement();
        $oForm->setInputFilter(new ServerFilter());
        $oForm->setValidationGroup(array(
            'serverID',
            'username',
            'password',
            'server',
            'port',
        ));
        
        return $oForm;
    }

}
