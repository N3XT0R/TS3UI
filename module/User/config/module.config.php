<?php
Namespace User;

return array(
    'router' => array(
        'routes' => array(
            'zfcuser' => array(
                'edit' => array(
                    'type' => 'Literal',
                    'options' => array(
                        'route' => '/edit',
                        'defaults' => array(
                            'controller' => 'user',
                            'action'     => 'edit',
                        ),
                    ),
                ),
            ),
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            // overriding zfc-user-doctrine-orm's config
            'zfcuser_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => __DIR__ . '/../src/'.__NAMESPACE__.'/Entity',
            ),
            'orm_default' => array(
                'drivers' => array(
                    'User\Entity' => 'zfcuser_entity',
                ),
            ),
        ),
        'fixture' => array(
            __NAMESPACE__.'_fixture' => __DIR__.'/../src/'.__NAMESPACE__.'/Fixture',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'zfc-user' => __DIR__ . '/../view',
        ),
    ),
    'zfcuser' => array(
        // telling ZfcUser to use our own class
        'user_entity_class'       => 'User\Entity\User',
        // telling ZfcUserDoctrineORM to skip the entities it defines
        'enable_default_entities' => false,
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
    'bjyauthorize' => array(
        'unauthorized_strategy' => 'BjyAuthorize\View\RedirectionStrategy',
        // Using the authentication identity provider, which basically reads the roles from the auth service's identity
        'identity_provider'     => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',
        'role_providers'        => array(
            // using an object repository (entity repository) to load all roles into our ACL
            'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' => array(
                'object_manager'    => 'doctrine.entitymanager.orm_default',
                'role_entity_class' => 'User\Entity\Role',
            ),
        ),
        // resource providers provide a list of resources that will be tracked
        // in the ACL. like roles, they can be hierarchical
        'resource_providers' => array(
            'BjyAuthorize\Provider\Resource\Config' => array(
                'Administrator' => array(),
                'zfcuser'       => array('login'),
                'DoctrineORMModule\\Yuml\\YumlController' => array('index'),
                //'pants' => array(),
            ),
        ),
        /* rules can be specified here with the format:
         * array(roles (array), resource, [privilege (array|string), assertion])
         * assertions will be loaded using the service manager and must implement
         * Zend\Acl\Assertion\AssertionInterface.
         * *if you use assertions, define them using the service manager!*
         */
        'rule_providers' => array(
            'BjyAuthorize\Provider\Rule\Config' => array(
                'allow' => array(
                    // allow guests and users (and admins, through inheritance)
                    // the "wear" privilege on the resource "pants",
                    array(array('Guest'), 'DoctrineORMModule\\Yuml\\YumlController'),
                ),
                // Don't mix allow/deny rules if you are using role inheritance.
                // There are some weird bugs.
                'deny' => array(
                    array(array('Guest'), 'DoctrineORMModule\\Yuml\\YumlController'),
                ),
            ),
        ),
        'guards' => array(
            /* If this guard is specified here (i.e. it is enabled), it will block
             * access to all routes unless they are specified here.
             */
            'BjyAuthorize\Guard\Route' => array(
                array(
                    'route' => 'home',
                    'roles' => array('User'),
                ),
                array(
                    'route' => 'zfcuser',     
                    'roles' => array('User')
                ),
                array(
                    'route' => 'zfcuser/logout',    
                    'roles' => array('User')
                ),
                array(
                    'route' => 'zfcuser/login',    
                    'roles' => array('Guest')
                ),
                array(
                    'route' => 'zfcuser/register',   
                    'roles' => array('Administrator')
                ),
                array(
                    'route' => 'zfcuser/changepassword',  
                    'roles' => array('User')
                ),
                array(
                    'route' => 'zfcuser/changeemail',  
                    'roles' => array('User')
                ),
                array(
                    'route' => 'doctrine_orm_module_yuml',
                    'roles' => array('User', 'Guest')
                ),
            ),
        ),
    ),
    
);