<?php

namespace TSCore\Enum;

class Codec extends AbstractBaseEnum{
    
    /**
     * speex narrowband (mono, 16bit, 8kHz)
     */
    const CODEC_SPEEX_NARROWBAND        = 0;
    
    /**
     * speex wideband (mono, 16bit, 16kHz)
     */
    const CODEC_SPEEX_WIDEBAND          = 1;
    
    /**
     * speex ultra-wideband (mono, 16bit, 32kHz)
     */
    const CODEC_SPEEX_ULTRAWIDEBAND     = 2;
    
    /**
     * celt mono (mono, 16bit, 48kHz)
     */
    const CODEC_CELT_MONO               = 3;
    
    protected $aModes = [
        self::CODEC_SPEEX_NARROWBAND,
        self::CODEC_SPEEX_WIDEBAND,
        self::CODEC_SPEEX_ULTRAWIDEBAND,
        self::CODEC_CELT_MONO,
    ];
}
