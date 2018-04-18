<?php
namespace axonivy\update;

use PDO;
use Slim\App;
use Slim\Container;
use Slim\Middleware\HttpBasicAuthentication;
use axonivy\update\controller\CallingHomeController;
use axonivy\update\controller\LogController;
use axonivy\update\repository\DesignerLogRepository;
use axonivy\update\repository\EngineLogRepository;
use axonivy\update\repository\ReleaseInfoRepository;
use axonivy\update\controller\HomePageController;

class Application
{

    public function run()
    {
        $config = __DIR__ . '/../../../../config/update.axonivy.com.php';
        if (!file_exists($config))
        {
            $config = '../config/config.php'; 
        }
        $configuration = require($config);
        return $this->runWithConfiguration($configuration);
    }

    public function runWithConfiguration($configuration)
    {
        $container = self::createContainer($configuration);
        
        $app = new App($container);
        
        $app->add($container->auth);

        $app->post('/ivy/pro/UpdateService/UpdateService/141746D7E212F6D2/designer.ivp', CallingHomeController::class . ':designer');
        $app->post('/ivy/pro/UpdateService/UpdateService/141746D7E212F6D2/server.ivp', CallingHomeController::class . ':engine');
        $app->get('/api/log', LogController::class . ':read');
        $app->get('/', HomePageController::class);
        
        return $app->run();
    }

    public static function createContainer($configuration): Container
    {
        $container = new Container($configuration);

        $container['db'] = function ($c) {
            $db = $c['settings']['db'];
            
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
        };

        $container['auth'] = function ($c) {
            $config = $c['settings']['api'];
            return new HttpBasicAuthentication([
                'path' => '/api',
                'realm' => 'Protected',
                'users' => [
                    $config['username'] => $config['password']
                ]
            ]);
        };

        $container[CallingHomeController::class] = function ($c) {
            $designerLogRepo = new DesignerLogRepository($c->db);
            $engineLogRepo = new EngineLogRepository($c->db);
            $releaseInfoRepo = new ReleaseInfoRepository($c['settings']['releaseDirectory']);
            return new CallingHomeController($designerLogRepo, $engineLogRepo, $releaseInfoRepo);
        };
        $container[LogController::class] = function ($c) {
            $designerLogRepo = new DesignerLogRepository($c->db);
            $engineLogRepo = new EngineLogRepository($c->db);
            return new LogController($designerLogRepo, $engineLogRepo);
        };
        
        return $container;
    }
}
