<?php

namespace TSCore\Enum;

class PermissionGroupDatabaseTypes extends AbstractBaseEnum{
    
    /**
     * template group (used for new virtual servers)
     */
    const PermGroupDBTypeTemplate       = 0;
    
    /**
     * regular group (used for regular clients)
     */
    const PermGroupDBTypeRegular        = 1;
    
    /**
     * global query group (used for ServerQuery clients)
     */
    const PermGroupDBTypeQuery          = 2;
    
    protected $aModules = [
        self::PermGroupDBTypeTemplate,
        self::PermGroupDBTypeRegular,
        self::PermGroupDBTypeQuery,
    ];
}
