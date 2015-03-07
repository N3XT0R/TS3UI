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
            'Server\Service\Server' => 'Server\Service\ServerServiceFactory',
        ),
    ),
     'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'Server_Entities' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Server/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Server\Entity' => 'Server_Entities'
                ),
            ),
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