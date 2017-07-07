<?php
use PHPUnit\Framework\TestCase;

class IntegrationTestCase extends TestCase {
    
    
    protected $dbConfig;
    protected $pdo;
    
    public function setUp(): void
    {
        $this->setUpTestDatabase();
    }
    
    public function tearDown(): void
    {
        $this->dropDatabase();
    }
    
    private function setUpTestDatabase()
    {
        $host = '127.0.0.1';
        $user = 'root';
        $port = 3306;
        $password = '1234';
        $dbName = 'inttest_update_' . time();
        $charset= 'utf8';
        
        $pdo = new PDO("mysql:host=$host;port=$port;charset=$charset", $user, $password);
        
        $pdo->exec("CREATE DATABASE `$dbName`;");
        
        $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=$charset", $user, $password);
        
        $sql = file_get_contents('./sql/00_init.sql');
        $pdo->exec($sql);
        
        $this->pdo = $pdo;
        $this->dbConfig = [
            'host' => $host,
            'dbName' => $dbName,
            'user' => $user,
            'password' => $password,
            'charset' => $charset
        ];
    }
    
    private function dropDatabase()
    {
        $dbConfig = $this->dbConfig;
        $host = $dbConfig['host'];
        $user = $dbConfig['user'];
        $password = $dbConfig['password'];
        $charset= $dbConfig['charset'];
        $dbName = $dbConfig['dbName'];
        
        $pdo = new PDO("mysql:host=$host;charset=$charset", $user, $password);
        
        $pdo->exec("DROP DATABASE `$dbName`;");
    }
}