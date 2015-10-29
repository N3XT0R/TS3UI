<?php

namespace Server;

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
                'may_terminate' => true,
                'child_routes' => array(
                    'action' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/[:action]/[:id]',
                            'constraints' => array(
                                'action' => '[a-zA-Z]+',
                                'id'     => '[0-9]+',
                            ),
                        ),
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
            'Server\Service\Server'         => 'Server\Service\ServerServiceFactory',
            'Server\Form\Create'            => 'Server\Form\ServerCreateFormFactory',
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
    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type'     => 'phpArray',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.php',
            ),
        ),
    ),
    'navigation' => array(
        'default' => array(
            'Server' => array(
                'type'          => 'mvc',
                'label'         => 'SERVER',
                'route'         => 'server/action',
                'icon'          => 'fa-server',
                'controller'    => 'Server',
                'action'        => 'index',
                'order'         => '10',
                'resource'      => 'Server',
                'privilege'     => null,
                'pages'         => array(
                    'index'     => array(
                        'type'          => 'mvc',
                        'label'         => 'SERVER_SUB_LIST',
                        'route'         => 'server/action',
                        'controller'    => 'Server',
                        'action'        => 'index',
                        'resource'      => 'Server',
                        'privilege'     => 'index',
                    ),
                    'create'    => array(
                        'type'          => 'mvc',
                        'label'         => 'SERVER_SUB_CREATE',
                        'route'         => 'server/action',
                        'controller'    => 'Server',
                        'action'        => 'create',
                    ),
                ),
            ),
        ),
    ),
    'acl' => array(
        'User' => array(
            
        ),
        'Administrator' => array(
            'Server' => array(
                'allow' => null,
            ),
        ),
    ),
);