<?php

namespace TSCore\Enum;

class CodecEncryptionMode extends AbstractBaseEnum{
    
    /**
     *  configure per channel
     */
    const CODEC_CRYPT_INDIVIDUAL    = 0;
    
    /**
     * globally disabled
     */
    const CODEC_CRYPT_DISABLED      = 1;
    
    /**
     * globally enabled
     */
    const CODEC_CRYPT_ENABLED       = 2;
    
    protected $aModules = [
        self::CODEC_CRYPT_INDIVIDUAL,
        self::CODEC_CRYPT_DISABLED,
        self::CODEC_CRYPT_ENABLED,
    ];
}
