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

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EditFormFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $oForm = new UserForm("edit");
        $oForm->addUserIDElement();
        $oForm->addCsrfElement();
        $oForm->addPasswordElement();
        $oForm->addRetypePasswordElement();
        
        $oForm->addSubmitElement("submit", "USER_EDIT_PROFILE");
        return $oForm;
    }

}
