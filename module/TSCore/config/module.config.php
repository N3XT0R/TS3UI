<?php

return array(
    'service_manager' => array(
        'invokables' => array(
            'TSCore\Adapter\TeamspeakAdapter' => 'TSCore\Adapter\Teamspeak3Adapter',
        ),
        'factories' => array(
            'TSCore\Adapter\Teamspeak' => 'TSCore\Adapter\Teamspeak3AdapterFactory',
            'TSCore\Auth\Adapter'      => 'TSCore\Authentication\TS3AdapterFactory',
            'TSCore\Auth\Service'      => 'TSCore\Authentication\ServiceFactory',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'TSCore_Entities' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/TSCore/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'TSCore\Entity' => 'TSCore_Entities'
                ),
            ),
        ),
    ),
);

