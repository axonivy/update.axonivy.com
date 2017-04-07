<?php
namespace repository;

use \PDO;
use config\Config;

abstract class Repository {
	protected $pdo;
	
	public function __construct() {
		$host = Config::DB_HOST;
		$db   = Config::DB_NAME;
		$user = Config::DB_USER;
		$pass = Config::DB_PASSWORD;
		$charset = Config::DB_CHARSET;

		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		$opt = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];
		$this->pdo = new PDO($dsn, $user, $pass, $opt);
	}
}