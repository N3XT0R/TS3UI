<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LoginFormFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $oForm = new UserForm("login");
        
        $oForm->addUsernameElement();
        $oForm->addPasswordElement();
        $oForm->addSubmitElement();
        
        return $oForm;
    }

}
