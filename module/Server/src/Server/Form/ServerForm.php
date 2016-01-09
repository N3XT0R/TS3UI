<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace Server\Form;

use Zend\Form\Form;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Text;
use Zend\Form\Element\Password;
use Zend\Form\Element\Number;
use Zend\Form\Element\Button;

class ServerForm extends Form{
    
    
    public function addTokenElement($name = "token"){
        $oElement = new Csrf($name);
        $this->add($oElement);
    }
    
    public function addServerIDElement($name = "serverID"){
        $oElement = new Hidden($name);
        $this->add($oElement);
    }
    
    public function addUsernameElement($name = "username", $label = "SERVER_FORM_USERNAME"){
        $oElement = new Text($name);
        $oElement->setLabel($label);
        $oElement->setAttribute("placeholder", $label);
        $this->add($oElement);
    }
    
    public function addPasswordElement($name = "password", $label = "SERVER_FORM_PASSWORD"){
        $oElement = new Password($name);
        $oElement->setLabel($label);
        $oElement->setAttribute("placeholder", $label);
        $this->add($oElement);
    }
    
    public function addHostnameElement($name = "server", $label = "SERVER_FORM_HOSTNAME"){
        $oElement = new Text($name);
        $oElement->setLabel($label);
        $oElement->setAttribute("placeholder", $label);
        $this->add($oElement);
    }
    
    public function addPortElement($name = "port", $label = "SERVER_FORM_PORT"){
        $oElement = new Number($name);
        $oElement->setLabel($label);
        $oElement->setAttribute("placeholder", 10011);
        $this->add($oElement);
    }
    
    public function addSubmitElement($name = "submit", $label = "SERVER_FORM_SAVE"){
        $oElement = new Button($name);
        $oElement->setLabel($label);
        $oElement->setAttribute("type", "submit");
        $this->add($oElement);
    }
}
