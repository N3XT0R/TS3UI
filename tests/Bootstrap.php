<?php
namespace tests;

use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;

error_reporting(E_ALL | E_STRICT);
chdir(dirname(__DIR__));

define('SITE_PATH', dirname(dirname(__FILE__)));

/**
 * @codeCoverageIgnore
 */
class Bootstrap {

    protected static $serviceManager;

    public static function init() {

        include SITE_PATH . '/vendor/autoload.php';

        $config = include SITE_PATH . '/config/application.config.php';
        self::loadModules($config['modules']);
        
        static::$serviceManager = new ServiceManager(new ServiceManagerConfig());
        static::$serviceManager->setService('ApplicationConfig', $config);
        $test= static::$serviceManager->get('ModuleManager')->loadModules();
    }

    public static function getServiceManager() {
        return static::$serviceManager;
    }
    
    private static function loadModules(array $modules) {
        foreach ($modules as $moduleName) {
            include SITE_PATH . "/module/$moduleName/Module.php";
        }
    }

}
Bootstrap::init();