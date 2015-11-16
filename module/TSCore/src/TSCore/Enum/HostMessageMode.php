<?php

namespace TSCore\Enum;

class HostMessageMode extends AbstractBaseEnum{
    
    const HostMessageMode_LOG           = 1;
    const HostMessageMode_MODAL         = 2;
    const HostMessageMode_MODALQUIT     = 3;
    
    protected $aModes = [
        self::HostMessageMode_LOG,
        self::HostMessageMode_MODAL,
        self::HostMessageMode_MODALQUIT,
    ];
    
}
