<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace User\View\Helper;


use Zend\View\Helper\AbstractHelper;
use User\Acl\Service as AclService;

class UserIsAllowed extends AbstractHelper{
    
    protected $acl;
    
    public function __construct(AclService $acl) {
        $this->setAcl($acl);
    }
    
    public function setAcl(AclService $acl){
        $this->acl = $acl;
        return $this;
    }
    
    public function getAcl(){
        return $this->acl;
    }
    
    public function __invoke($resource, $privilege = "index") {
        return $this->getAcl()->isAllowed($resource, $privilege);
    }
}
