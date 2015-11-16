<?php

namespace TSCore\Enum;

class AbstractBaseEnum {
    
    protected $aModes = [];
    
    public function setModes(array $aModes){
        $this->aModes = $aModes;
        return $this;
    }
    
    public function getModes(){
        return $this->aModes;
    }
}
