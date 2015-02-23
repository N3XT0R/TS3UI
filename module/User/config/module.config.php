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
                ),    
                'may_terminate' => true,
                'child_routes' => array(
                    'action' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route'         => '/:action[/:id]',
                            'constraints' => array(
                                'action'        => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'            => '[0-9]+',
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
            'User\Acl\Service'   => 'User\Acl\ServiceFactory',
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
    'view_helpers' => array(
        'factories'=> array(
           // 'UserShowWidget' => 'User\View\Helper\UserShowWidgetFactory',
            'UserIsAllowed'  => 'User\View\Helper\UserIsAllowedFactory',
        ),
    ),
    'acl' => array(
        'guest' => array(
            'user' => array(
                'deny' => array('logout'),
            ),
        ),
    ),
);

