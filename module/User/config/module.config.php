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
            'User\Auth\Adapter' => 'User\Authentication\BcryptAdapterFactory',
            'User\Auth\Service'  => 'User\Authentication\ServiceFactory',
            //Forms
            'User\Form\Login'   => 'User\Form\LoginFormFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
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
    'doctrine' => array(
        'driver' => array(
            'User_Entities' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/User/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'User\Entity' => 'User_Entities'
                ),
            ),
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
            'User' => array(
                'allow' => array('login'),
                'deny' => array('logout'),
            ),
        ),
        'Admin' => array(
            'User' => array(
                'allow' => null,
            ),
        ),
        'SuperAdmin' => array(
            'User' => array(
                'allow' => null,
            ),
        ),
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
                'user' => array(
                    'options' => array(
                        'route' => 'user [--help] [add|delete]:mode [<username>] [<password>]',
                        'defaults' => array(
                            'controller' => 'User',
                            'action' => 'update',
                        ),
                    ),
                ),
            ),
        ),
    ),
);

