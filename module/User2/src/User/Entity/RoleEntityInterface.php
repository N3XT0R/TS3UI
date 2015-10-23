<?php

/*
 * Here comes the text of your license
 * Each line should be prefixed with  * 
 */

/**
 *
 * @author N3X
 */


namespace User\Entity;

use Zend\Stdlib\ArraySerializableInterface;

interface RoleEntityInterface extends ArraySerializableInterface{
    
    /**
     * Set Role ID
     * @param integer $RoleID
     */
    public function setRoleID($RoleID);
    
    /**
     * Get Role ID
     * @return integer
     */
    public function getRoleID();
    
    
    /**
     * Set Role Name
     * @param string $name
     */
    public function setRolename($name);
    
    /**
     * Get Role Name
     * @return string
     */
    public function getRolename();
}
