<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace User\Form;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class CreateFormFactory implements FactoryInterface{
    
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $oForm = new UserForm("CreateUser");
        $oForm->addCsrfElement();
        $oForm->addUsernameElement();
        $oForm->addPasswordElement();
        $oForm->addRetypePasswordElement();
        $oForm->addRoleElement();
        $oForm->addSubmitElement("submit", "USER_CREATE");
        
        return $oForm;
    }

}
