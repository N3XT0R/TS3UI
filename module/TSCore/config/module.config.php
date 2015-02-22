<?php

return array(
    'service_manager' => array(
        'invokables' => array(
            'TSCore\Adapter\TeamspeakAdapter' => 'TSCore\Adapter\Teamspeak3Adapter',
        ),
        'factories' => array(
            'TSCore\Adapter\Teamspeak' => 'TSCore\Adapter\Teamspeak3AdapterFactory',
            'TSCore\Auth\Adapter'      => 'TSCore\Authentication\TS3AdapterFactory',
            'TSCore\Adapter\Service'   => 'TSCore\Authentication\ServiceFactory',
        ),
    ),
);

