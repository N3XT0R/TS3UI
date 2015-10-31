<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id: 1168ccdf6bca74bd7d4cd0526934b75597c480e4 $
 * $Date$
 */

namespace Server\Service;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

class VirtualServerService implements EventManagerAwareInterface{
    
    use EventManagerAwareTrait;
}
