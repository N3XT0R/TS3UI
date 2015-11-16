<?php

namespace TSCore\Enum;

class TextMessageTargetMode extends AbstractBaseEnum{
    
    /**
     * target is a client
     */
    const TextMessageTarget_CLIENT      = 1;
    
    /**
     *  target is a channel
     */
    const TextMessageTarget_CHANNEL     = 2;
    
    /**
     * target is a virtual server
     */
    const TextMessageTarget_SERVER      = 3;
    
    protected $aModules = [
        self::TextMessageTarget_CLIENT,
        self::TextMessageTarget_CHANNEL,
        self::TextMessageTarget_SERVER,
    ];
}
