<?php
namespace tests;

use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;
use Zend\Loader\AutoloaderFactory;

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
        static::initAutoloader();
        
        static::$serviceManager = new ServiceManager(new ServiceManagerConfig());
        static::$serviceManager->setService('ApplicationConfig', $config);
        static::$serviceManager->get('ModuleManager')->loadModules();
    }

    /**
     * 
     * @return \Zend\ServiceManager\ServiceManager
     */
    public static function getServiceManager() {
        return static::$serviceManager;
    }
    
    private static function loadModules(array $modules) {
        foreach ($modules as $moduleName) {
            $fileName = SITE_PATH . "/module/$moduleName/Module.php";
            if(\file_exists($fileName)){
                include $fileName;
            }
        }
    }
    
    protected static function initAutoloader()
    {
        $vendorPath = static::findParentPath('vendor');

        if (is_readable($vendorPath . '/autoload.php')) {
            $loader = include $vendorPath . '/autoload.php';
        } else {
            $zf2Path = getenv('ZF2_PATH') ?: (defined('ZF2_PATH') ? ZF2_PATH : (is_dir($vendorPath . '/ZF2/library') ? $vendorPath . '/ZF2/library' : false));

            if (!$zf2Path) {
                throw new RuntimeException('Unable to load ZF2. Run `php composer.phar install` or define a ZF2_PATH environment variable.');
            }

            include $zf2Path . '/Zend/Loader/AutoloaderFactory.php';

        }

        AutoloaderFactory::factory(array(
            'Zend\Loader\StandardAutoloader' => array(
                'autoregister_zf' => true,
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/' . __NAMESPACE__,
                ),
            ),
        ));
    }
    
    protected static function findParentPath($path)
    {
        $dir = __DIR__;
        $previousDir = '.';
        while (!is_dir($dir . '/' . $path)) {
            $dir = dirname($dir);
            if ($previousDir === $dir) return false;
            $previousDir = $dir;
        }
        return $dir . '/' . $path;
    }

}
Bootstrap::init();

