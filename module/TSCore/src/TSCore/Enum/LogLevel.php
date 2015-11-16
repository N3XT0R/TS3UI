<?php

namespace TSCore\Enum;

class LogLevel extends AbstractBaseEnum{
    
    /**
     * everything that is really bad
     */
    const LogLevel_ERROR        = 1;
    
    /**
     * everything that might be bad
     */
    const LogLevel_WARNING      = 2;
    
    /**
     * output that might help find a problem
     */
    const LogLevel_DEBUG        = 3;
    
    /**
     * informational output
     */
    const LogLevel_INFO         = 4;
    
    protected $aModules = [
        self::LogLevel_ERROR,
        self::LogLevel_WARNING,
        self::LogLevel_DEBUG,
        self::LogLevel_INFO,
    ];
}
