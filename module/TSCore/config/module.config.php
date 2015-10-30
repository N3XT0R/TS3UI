<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'TSCore\Adapter\Teamspeak'  => 'TSCore\Adapter\Teamspeak3AdapterFactory',
            'TSCore\Service\Teamspeak'  => 'TSCore\Service\TeamspeakServiceFactory',
        ),
    ),
);

