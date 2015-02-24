<?php

namespace TSCore\Entity;

use Zend\Stdlib\ArraySerializableInterface;

interface UserEntityInterface extends ArraySerializableInterface{
    
    public function setId($id);
    public function getId();
    public function setUsername($username);
    public function getUsername();
    
    public function setPassword($password);
    public function getPassword();
}
