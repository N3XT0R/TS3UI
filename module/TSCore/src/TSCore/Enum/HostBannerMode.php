<?php

namespace TSCore\Enum;

class HostBannerMode extends AbstractBaseEnum{
    
    /**
     * do not adjust
     */
    const HostMessageMode_NOADJUST          = 0;
    /**
     * adjust but ignore aspect ratio (like TeamSpeak 2)
     */
    const HostMessageMode_IGNOREASPECT      = 1;
    
    /**
     * adjust and keep aspect ratio
     */
    const HostMessageMode_KEEPASPECT        = 2;
    
    protected $aModes = [
        self::HostMessageMode_NOADJUST,
        self::HostMessageMode_IGNOREASPECT,
        self::HostMessageMode_KEEPASPECT,
    ];
}
