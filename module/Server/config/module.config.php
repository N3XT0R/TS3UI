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
                            'route' => '/[:action][/:id]',
                            'constraints' => array(
                                'action' => '[a-zA-Z]+',
                                'id'     => '[0-9]+',
                            ),
                        ),
                    ),
                    'virtual' => array(
                        'type' => 'segment',
                        'options' => array(
                             'route'    => '/virtualserver/:id',
                             'defaults' => array(
                                'controller' => 'VirtualServer',
                                'action'     => 'index',
                            ),
                            'constraints' => array(
                                'id'     => '[0-9]+',
                            ),
                        ),   
                        'may_terminate' => true,
                        'child_routes' => array(
                            'action' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '/[:action][/:virtualId]',
                                    'constraints' => array(
                                        'action'        => '[a-zA-Z]+',
                                        'virtualId'     => '[0-9]+',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Server'                => 'Server\Controller\ServerControllerFactory',
            'VirtualServer'         => 'Server\Controller\VirtualServerControllerFactory',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            //Mapper
            'Server\Mapper\Server'                  => 'Server\Mapper\ServerMapperFactory',
            //Service
            'Server\Service\Server'                 => 'Server\Service\ServerServiceFactory',
            'Server\Service\VirtualServer'          => 'Server\Service\VirtualServerServiceFactory',
            //Form
            'Server\Form\ServerCreate'              => 'Server\Form\ServerCreateFormFactory',
            'Server\Form\VirtualServerEdit'         => 'Server\Form\VirtualServerEditFormFactory',
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
                'icon'          => 'fa-server fa-fw',
                'controller'    => 'Server',
                'action'        => 'index',
                'order'         => '10',
                'resource'      => 'Server',
                'privilege'     => 'index',
                'pages'         => array(
                    'index'     => array(
                        'type'          => 'mvc',
                        'label'         => 'SERVER_SUB_LIST',
                        'route'         => 'server/action',
                        'controller'    => 'Server',
                        'action'        => 'index',
                        'resource'      => 'Server',
                        'privilege'     => 'index',
                        'pages'         => array(
                            'virtualserverlist' => array(
                                'type'          => 'mvc',
                                'label'         => 'SERVER_VIRTUAL',
                                'route'         => 'server/action',
                                'controller'    => 'Server',
                                'action'        => 'virtualServerList',
                                'resource'      => 'Server',
                                'privilege'     => 'virtualServerList',
                                'useRouteMatch' => true,
                                'pages'         => array(
                                    'channelList' => array(
                                        'id'                => 'channelList',
                                        'type'              => 'mvc',
                                        'label'             => 'SERVER_VIRTUAL_CHANNEL',
                                        'route'             => 'server/virtual/action',
                                        'controller'        => 'VirtualServer',
                                        'action'            => 'channelList',
                                        'resource'          => 'VirtualServer',
                                        'privilege'         => 'channelList',
                                        'useRouteMatch'     => true,
                                        //'visisble'          => false,
                                    ),
                                    'editVirtualServer' => array(
                                        'id'                => 'editVirtualServer',
                                        'type'              => 'mvc',
                                        'label'             => 'SERVER_VIRTUAL_EDIT',
                                        'route'             => 'server/virtual/action',
                                        'controller'        => 'VirtualServer',
                                        'action'            => 'edit',
                                        'resource'          => 'VirtualServer',
                                        'privilege'         => 'edit',
                                        'useRouteMatch'     => true,
                                    ),
                                ),
                            ),
                        ),
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
    'bjyauthorize' => array(
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
                    array(array('Administrator', 'User'), ['Server', 'VirtualServer']),
                   
                ),
                // Don't mix allow/deny rules if you are using role inheritance.
                // There are some weird bugs.
                'deny' => array(
                    array(array('Guest'), 'Server'),
                ),
            ),
        ),
         'guards' => array(
            /* If this guard is specified here (i.e. it is enabled), it will block
             * access to all routes unless they are specified here.
             */
            'BjyAuthorize\Guard\Route' => array(
                array(
                    'route' => 'server/action',
                    'roles' => array('User', 'Administrator'),
                ),
                array(
                    'route' => 'server/virtual/action',
                    'roles' => array('User', 'Administrator'),
                ),
                array(
                    'route' => 'Assetmanager-warmup',
                    'roles' => array('User', 'Administrator', 'Guest', null),
                ),
            ),
        ),
        // resource providers provide a list of resources that will be tracked
        // in the ACL. like roles, they can be hierarchical
        'resource_providers' => array(
            'BjyAuthorize\Provider\Resource\Config' => array(
                'Server'            => array('index', 'create', 'virtualServerList'),
                'VirtualServer'     => array('index'),
            ),
        ),
    ),
);