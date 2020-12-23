<?php
namespace axonivy\update;

use PDO;
use Slim\App;
use DI\Container;
use axonivy\update\controller\CallingHomeController;
use axonivy\update\repository\DesignerLogRepository;
use axonivy\update\repository\EngineLogRepository;
use axonivy\update\repository\ReleaseInfoRepository;
use axonivy\update\controller\HomePageController;
use Slim\Factory\AppFactory;

class Application
{
    public function run()
    {
        $config = __DIR__ . '/../../../../config/update.axonivy.com.php';
        if (!file_exists($config))
        {
            $config = '../config/config.php'; 
        }
        $app = $this->createApp(require($config));        
        return $app->run();
    }

    public function createApp($config): App
    {
        $container = self::createContainer($config);
        $app = AppFactory::createFromContainer($container);
        
        $app->post('/ivy/pro/UpdateService/UpdateService/141746D7E212F6D2/designer.ivp', CallingHomeController::class . ':designer');
        $app->post('/ivy/pro/UpdateService/UpdateService/141746D7E212F6D2/server.ivp', CallingHomeController::class . ':engine');
        $app->get('/', HomePageController::class);
        
        return $app;
    }

    private static function createContainer($config): Container
    {
        $container = new Container();
        $container->set('db', function (Container $container) use ($config) {
            $db = $config['settings']['db'];
            
            $host = $db['host'];
            $dbName = $db['dbName'];
            $user = $db['user'];
            $pass = $db['password'];
            $charset = $db['charset'];
            
            $dsn = "mysql:host=$host;dbname=$dbName;charset=$charset";
            $opt = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
            return new PDO($dsn, $user, $pass, $opt);
        });

        $container->set(CallingHomeController::class, function (Container $container) use ($config) {
            $db = $container->get('db');
            $designerLogRepo = new DesignerLogRepository($db);
            $engineLogRepo = new EngineLogRepository($db);
            $releaseInfoRepo = new ReleaseInfoRepository($config['settings']['developerAPI']);
            return new CallingHomeController($designerLogRepo, $engineLogRepo, $releaseInfoRepo);
        });

        return $container;
    }
}
