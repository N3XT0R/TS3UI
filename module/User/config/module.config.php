<?php

return array(
    'router' => array(
        'routes' => array(
            'user' => array(
                'type' => 'literal',
                'options' => array(
                    'route'    => '/user',
                    'defaults' => array(
                        'controller' => 'User',
                        'action'     => 'index',
                    ),
                    'may_terminate' => true,
                    'child_routes' => array(
                        'action' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route'         => '/[:controller[/:action[/:id]]]',
                                'constraints' => array(
                                    'controller'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    'action'        => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    'id'            => '[a-zA-Z][a-zA-Z0-9_-]*',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'User\Service\User' => 'User\Service\UserServiceFactory',
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'User' => 'User\Controller\UserControllerFactory',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);

