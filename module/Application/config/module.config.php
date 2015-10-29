<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Dashboard',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            /*'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/dashboard',
                    'defaults' => array(
                        'controller'    => 'Dashboard',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                )
            ),*/
        ),
    ),
    'controllers' => array(
       'invokables' => array(
            'Dashboard' => 'Application\Controller\IndexController',
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            //'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        'delegators' => array(
            'MvcTranslator' => array(
                'Application\Delegator\TranslatorDelegator',
            ),
        ),
    ),
    'translator' => array(
        'locale' => 'en_EN',
        'translation_file_patterns' => array(
            array(
                'type'     => 'phpArray',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.php',
            ),
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            //'layout/login'            => __DIR__ . '/../view/layout/login.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'navigation/vertical'     => __DIR__ . '/../view/navigation/verticalnav.phtml'
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables'=> array(
            'pageTitle'    => 'Application\View\Helper\PageTitle',
        ),
    ),
    /*
    'acl' => array(
        'Admin' => array(
            'Dashboard' => array(
                'allow' => null,
            ),
        ),
        'SuperAdmin' => array(
            'Dashboard' => array(
                'allow' => null,
            ),
        ),
    ),*/
    'navigation'    => array(
        'default'   => array(
           "application" => array(
               'label' => 'APPLICATION_DASHBOARD',
               'route' => 'home',
               'controller' => 'Dashboard',
               'action' => 'index',
               'icon' => 'fa fa-dashboard fa-fw',
           ),
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
