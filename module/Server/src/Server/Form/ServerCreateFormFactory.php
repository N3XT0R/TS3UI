<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id: c8d6eeae438b03459c199ecd06c3dbc0ef8e1194 $
 * $Date$
 */

namespace Server\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Server\Filter\ServerFilter;

class ServerCreateFormFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $oForm = new ServerForm("CreateForm");
        $oForm->addTokenElement();
        $oForm->addUsernameElement();
        $oForm->addPasswordElement();
        $oForm->addHostnameElement();
        $oForm->addPasswordElement();
        $oForm->addPortElement();
        $oForm->addSubmitElement();
        $oForm->setInputFilter(new ServerFilter());
        $oForm->setValidationGroup(array(
            'username',
            'password',
            'server',
            'port',
        ));
        
        return $oForm;
    }

}
