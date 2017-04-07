<?php
namespace request;

use request\RequestHandler;
use request\AddLogRequestHelper;
use repository\EngineLogRepository;
use model\EngineLogRecord;
use response\ReleaseResponse;

class AddEngineLogRequestHandler extends RequestHandler {
	
	private $engineLog;
	private $logRequestHelper;
	
	public function __construct() {
		$this->engineLog = new EngineLogRepository();
		$this->logRequestHelper = new AddLogRequestHelper();
	}
	
	public function getUrlPath() {
		return '/ivy/pro/UpdateService/UpdateService/141746D7E212F6D2/server.ivp';
	}
	
	public function execute() {
		$record = $this->createEngineLogRecord();
		$this->engineLog->write($record);		
		
		$releaseResponse = new ReleaseResponse($record->getEngine()->getVersion());
		$releaseResponse->render();
	}
	
	private function createEngineLogRecord() {
		$timestamp = time();
		$java = $this->logRequestHelper->createJava();
		$licence = $this->logRequestHelper->createLicence();
		$memory = $this->logRequestHelper->createMemory();
		$network = $this->logRequestHelper->createNetwork();
		$operatingSystem = $this->logRequestHelper->createOperatingSystem();
		$systemDatabase = $this->logRequestHelper->createSystemDatabase();
		$engine = $this->logRequestHelper->createEngine();
		
		return new EngineLogRecord($timestamp, $java, $licence, $memory, $network, $operatingSystem, $engine, $systemDatabase);
	}

}
