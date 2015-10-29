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
        
    ),
    
);