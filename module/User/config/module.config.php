<?php

Namespace User;

return [
    'router'       => [
        'routes' => [
            'zfcuser' => [
                'edit' => [
                    'type'    => 'Literal',
                    'options' => [
                        'route'    => '/edit',
                        'defaults' => [
                            'controller' => 'user',
                            'action'     => 'edit',
                        ],
                    ],
                ],
            ],
            'admin'   => [
                'type'    => 'literal',
                'options' => [
                    'route'    => '/admin',
                    'defaults' => [
                        'controller' => 'User-Admin',
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers'  => [
        'factories' => [
            'User-Admin' => 'User\Controller\Admin\UserAdminControllerFactory',
        ],
    ],
    'doctrine'     => [
        'driver'  => [
            // overriding zfc-user-doctrine-orm's config
            'zfcuser_entity' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity',
            ],
            'orm_default'    => [
                'drivers' => [
                    'User\Entity' => 'zfcuser_entity',
                ],
            ],
        ],
        'fixture' => [
            __NAMESPACE__ . '_fixture' => __DIR__ . '/../src/' . __NAMESPACE__ . '/Fixture',
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'user'     => __DIR__ . '/../view',
            'zfc-user' => __DIR__ . '/../view',
        ],
    ],
    'zfcuser'      => [
        // telling ZfcUser to use our own class
        'user_entity_class'       => 'User\Entity\User',
        // telling ZfcUserDoctrineORM to skip the entities it defines
        'enable_default_entities' => false,
    ],
    'translator'   => [
        'translation_file_patterns' => [
            [
                'type'     => 'phpArray',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.php',
            ],
        ],
    ],
    'navigation'   => [
        'default' => [
            'User-Admin' => [
                'type'       => 'mvc',
                'label'      => 'USER_ADMIN',
                'route'      => 'admin',
                'icon'       => 'fa-user fa-fw',
                'controller' => 'User-Admin',
                'action'     => 'index',
                'order'      => '10',
                'resource'   => 'User-Admin',
                'privilege'  => 'index',
                'pages'      => [
                    'index' => [
                        'type'       => 'mvc',
                        'label'      => 'USER_ADMIN',
                        'route'      => 'admin',
                        'controller' => 'User-Admin',
                        'action'     => 'index',
                        'resource'   => 'User-Admin',
                        'privilege'  => 'index',
                    ],
                ],
            ],
        ],
    ],
    'bjyauthorize' => [
        'unauthorized_strategy' => 'BjyAuthorize\View\RedirectionStrategy',
        // Using the authentication identity provider, which basically reads the roles from the auth service's identity
        'identity_provider'     => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',
        'role_providers'        => [
            // using an object repository (entity repository) to load all roles into our ACL
            'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' => [
                'object_manager'    => 'doctrine.entitymanager.orm_default',
                'role_entity_class' => 'User\Entity\Role',
            ],
        ],
        // resource providers provide a list of resources that will be tracked
        /* rules can be specified here with the format:
         * array(roles (array), resource, [privilege (array|string), assertion])
         * assertions will be loaded using the service manager and must implement
         * Zend\Acl\Assertion\AssertionInterface.
         * *if you use assertions, define them using the service manager!*
         */
        'rule_providers'        => [
            'BjyAuthorize\Provider\Rule\Config' => [
                'allow' => [
                    // allow guests and users (and admins, through inheritance)
                    // the "wear" privilege on the resource "pants",
                    [['Administrator'], ['User-Admin']],
                    [['Administrator', 'User'], 'DoctrineORMModule\\Yuml\\YumlController'],
                ],
                // Don't mix allow/deny rules if you are using role inheritance.
                // There are some weird bugs.
                'deny'  => [
                    [['Guest'], 'DoctrineORMModule\\Yuml\\YumlController'],
                ],
            ],
        ],
        'guards'                => [
            /* If this guard is specified here (i.e. it is enabled), it will block
             * access to all routes unless they are specified here.
             */
            'BjyAuthorize\Guard\Route' => [
                [
                    'route' => 'home',
                    'roles' => ['User'],
                ],
                [
                    'route' => 'zfcuser',
                    'roles' => ['User'],
                ],
                [
                    'route' => 'zfcuser/logout',
                    'roles' => ['User'],
                ],
                [
                    'route' => 'zfcuser/login',
                    'roles' => ['Guest'],
                ],
                [
                    'route' => 'zfcuser/register',
                    'roles' => ['Administrator'],
                ],
                [
                    'route' => 'zfcuser/changepassword',
                    'roles' => ['User'],
                ],
                [
                    'route' => 'zfcuser/changeemail',
                    'roles' => ['User'],
                ],
                [
                    'route' => 'doctrine_orm_module_yuml',
                    'roles' => ['User', 'Administrator'],
                ],
                [
                    'route' => 'admin',
                    'roles' => [
                        'Administrator',
                    ],
                ],
            ],
        ],
        // resource providers provide a list of resources that will be tracked
        // in the ACL. like roles, they can be hierarchical
        'resource_providers'    => [
            'BjyAuthorize\Provider\Resource\Config' => [
                'User-Admin'                            => ['index'],
                'DoctrineORMModule\Yuml\YumlController' => ['index'],
            ],
        ],
    ],

];