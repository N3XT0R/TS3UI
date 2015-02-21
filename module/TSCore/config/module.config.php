<?php

return array(
    'service_manager' => array(
        'invokables' => array(
            'TS3Core\Adapter\TeamspeakAdapter' => 'TS3\Adapter\Teamspeak3Adapter',
        ),
        'factories' => array(
            'TS3Core\Adapter\Teamspeak' => 'TS3\Adapter\Teamspeak3AdapterFactory',
        ),
    ),
);

