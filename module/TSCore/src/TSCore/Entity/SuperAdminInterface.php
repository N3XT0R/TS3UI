<?php

namespace TSCore\Entity;

use Zend\Stdlib\ArraySerializableInterface;

interface SuperAdminInterface extends ArraySerializableInterface{
    
    public function setUsername($username);
    public function getUsername();
    
    public function setPassword($password);
    public function getPassword();
}
