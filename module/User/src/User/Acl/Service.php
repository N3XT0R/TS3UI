<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace User\Acl;

use Zend\Permissions\Acl\Acl;

class Service {
    
    protected $role = "guest";
    protected $config = array();
    protected $acl = null;
    
    public function __construct($role = "guest", array $config){
        $this->setRole($role)->setConfig($config);
        $this->setAcl($this->buildAcl());
    }
    
    public function getRole(){
        return $this->role;
    }
    
    public function setRole($role){
        $this->role = $role;
        return $this;
    }
    
    public function setConfig(array $config){
        $this->config = $config;
        return $this;
    }
    
    public function getConfig(){
        return $this->config;
    }
    
    public function setAcl(Acl $acl){
        $this->acl = $acl;
        return $this;
    }
    
    public function getAcl(){
        return $this->acl;
    }
    
    public function buildAcl(){
        // create acl
        $acl = new Acl();
        $acl->addRole('guest');
        $acl->addRole("Admin", "guest");
        $acl->addRole('SuperAdmin', 'Admin');
        
        // loop through role data
        foreach ($this->config as $role => $resources) {
            // loop through resource data
            foreach ($resources as $resource => $rules) {
                // check for resource
                if (!$acl->hasResource($resource)) {
                    $acl->addResource($resource);
                }
        
                // loop trough rules
                foreach ($rules as $rule => $privileges)
                {
                    // add rule with privileges
                    $acl->$rule($role, $resource, $privileges);
                }
            }
        }
        
        // pass acl
        return $acl;
    }
    
    public function isAllowed($sResource, $sPrivilege){
        
        if (empty($sResource) || !$this->getAcl()->hasResource($sResource)) {
            return false;
        }
        if (empty($sPrivilege)) {
            return false;
        }
        
        $blIsAllowed = $this->getAcl()->isAllowed(
            $this->getRole(), 
            $sResource, 
            $sPrivilege
        );
        
        return $blIsAllowed;
    }
}
