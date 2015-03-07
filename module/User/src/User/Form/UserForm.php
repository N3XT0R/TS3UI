<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Form;

use Zend\Form\Form;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Text;
use Zend\Form\Element\Password;
use Zend\Form\Element\Button;

class UserForm extends Form{
    
    public function addCsrfElement($name = "token"){
        $oElement = new Csrf($name);
        $this->add($oElement);
    }
    
    public function addUsernameElement($name = "username", $label = "USER_USERNAME"){
        $oElement = new Text($name);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addPasswordElement($name = "password", $label = "USER_PASSWORD"){
        $oElement = new Password($name);
        $oElement->setLabel($label);
        $this->add($oElement);
    }
    
    public function addSubmitElement($name = "submit", $label = "USER_LOGIN"){
        $oElement = new Button($name);
        $oElement->setAttribute("type", "submit");
        $oElement->setLabel($label);
        $this->add($oElement);
    }
}
