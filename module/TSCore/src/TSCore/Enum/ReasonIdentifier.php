<?php

namespace TSCore\Enum;

class ReasonIdentifier extends AbstractBaseEnum{
    
    /**
     * kick client from channel
     */
    const REASON_KICK_CHANNEL   = 4;
    
    /**
     * kick client from server
     */
    const REASON_KICK_SERVER    = 5;
    
    protected $aModules = [
        self::REASON_KICK_CHANNEL,
        self::REASON_KICK_SERVER,
    ];
}
