<?php
return array(
    'bjyauthorize' => array(
        // set the 'guest' role as default (must be defined in a role provider)
        'default_role' => 'guest',
        /* this module uses a meta-role that inherits from any roles that should
         * be applied to the active user. the identity provider tells us which
         * roles the "identity role" should inherit from.
         *
         * for ZfcUser, this will be your default identity provider
         */
        'identity_provider' => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',
        /* role providers simply provide a list of roles that should be inserted
         * into the Zend\Acl instance. the module comes with two providers, one
         * to specify roles in a config file and one to load roles using a
         * Zend\Db adapter.
         */
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
                'administrator' => array(),
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
                    
                    array(array('administrator'), 'administrator'),
                    array(array('guest'), 'DoctrineORMModule\\Yuml\\YumlController'),
                ),
                // Don't mix allow/deny rules if you are using role inheritance.
                // There are some weird bugs.
                'deny' => array(
                    // ...
                ),
            ),
        ),
        /* Currently, only controller and route guards exist
         */
        'guards' => array(
            /* If this guard is specified here (i.e. it is enabled), it will block
             * access to all routes unless they are specified here.
             */
            'BjyAuthorize\Guard\Route' => array(
                array(
                    'route' => 'home',
                    'roles' => array('user'),
                ),
                array(
                    'route' => 'zfcuser',     
                    'roles' => array('user')
                ),
                array(
                    'route' => 'zfcuser/logout',    
                    'roles' => array('user')
                ),
                array(
                    'route' => 'zfcuser/login',    
                    'roles' => array('guest')
                ),
                array(
                    'route' => 'zfcuser/register',   
                    'roles' => array('administrator')
                ),
                array(
                    'route' => 'zfcuser/changepassword',  
                    'roles' => array('user')
                ),
                array(
                    'route' => 'zfcuser/changeemail',  
                    'roles' => array('user')
                ),
                array(
                    'route' => 'doctrine_orm_module_yuml',
                    'roles' => array('user', 'guest')
                ),
            ),
            
        ),
    ),
);