<?php

namespace TSCore\Enum;

class GroupDbType extends AbstractBaseEnum{
    
    /**
     * server group permission
     */
    const PermGroupTypeServerGroup      = 0;
    /**
     *  client specific permission
     */
    const PermGroupTypeGlobalClient     = 1;
    
    /**
     * channel specific permission
     */
    const PermGroupTypeChannel          = 2;
    
    /**
     * channel group permission
     */
    const PermGroupTypeChannelGroup     = 3;
    
    /**
     * channel-client specific permission
     */
    const PermGroupTypeChannelClient    = 4;
    
    protected $aModes = [
        self::PermGroupTypeServerGroup,
        self::PermGroupTypeGlobalClient,
        self::PermGroupTypeChannel,
        self::PermGroupTypeChannelGroup,
        self::PermGroupTypeChannelClient,
    ];
}
