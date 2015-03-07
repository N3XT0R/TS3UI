<?php

return array(
    'router' => array(
        'routes' => array(
            'server' => array(
                 'type' => 'literal',
                 'options' => array(
                     'route'    => '/server',
                    'defaults' => array(
                        'controller' => 'Server',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Server' => 'Server\Controller\ServerControllerFactory',
        ),
    ),
    'service_manager' => array(
        'factories' => array(

        ),
    ),
     'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'acl' => array(
        'Admin' => array(
            
        ),
        'SuperAdmin' => array(
            'Server' => array(
                'allow' => null,
            ),
        ),
    ),
);