<?php

namespace TSCore\Enum;

class TokenType extends AbstractBaseEnum{
    
    /**
     * server group token (id1={groupID} id2=0)
     */
    const TokenServerGroup      = 0;
    
    /**
     * channel group token (id1={groupID} id2={channelID})
     */
    const TokenChannelGroup     = 1;
    
    protected $aModules = [
        self::TokenServerGroup,
        self::TokenChannelGroup,
    ];
}
