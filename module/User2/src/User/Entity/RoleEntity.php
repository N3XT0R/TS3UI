<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace User\Entity;

use Zend\Filter\StaticFilter;
use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity
 * @ORM\Table(name="role")
 */
class RoleEntity implements RoleEntityInterface{
    
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $roleID = 1;
    
    /** 
     * @ORM\Column(type="string") 
     */
    protected $rolename = "";
    
    public function exchangeArray(array $array) {
        foreach ($array as $key => $value) {
            if (empty($value)) {
                continue;
            }
            $method = 'set' . StaticFilter::execute(
                $key, 'wordunderscoretocamelcase'
            );
            if (!method_exists($this, $method)) {
                continue;
            }
            $this->$method($value);
        }
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }
    
    public function setRoleID($RoleID){
        $this->roleID = $RoleID;
        return $this;
    }
    
    public function getRoleID(){
        return $this->roleID;
    }
    
    public function setRolename($name){
        $this->rolename = $name;
        return $this;
    }
    
    public function getRolename(){
        return $this->rolename;
    }
    
}
