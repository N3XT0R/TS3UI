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

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MessagesToFlashMessengerFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $oMessenger = $serviceLocator->get("FlashMessenger");
        $oPlugin    = new MessagesToFlashMessenger();
        $oPlugin->setFlashMessenger($oMessenger);
        return $oPlugin;
    }

}
