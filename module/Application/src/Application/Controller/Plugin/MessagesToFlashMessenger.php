<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class MessagesToFlashMessenger extends AbstractPlugin{
    
    protected $flashMessenger;
    
    public function setFlashMessenger(FlashMessenger $flashMessenger){
        $this->flashMessenger = $flashMessenger;
        return $this;
    }
    
    public function getFlashMessenger(){
        return $this->flashMessenger;
    }
    
    public function add(array $messages, $hops = 0){
        foreach($messages as $sType =>  $typemessages){
            foreach($typemessages as $message){
                $this->getFlashMessenger()->addMessage($message, $sType, $hops);
            }
        }
    }
}
