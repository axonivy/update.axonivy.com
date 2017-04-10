<?php
namespace request;

use model\DesignerLogRecord;
use repository\DesignerLogRepository;
use request\RequestHandler;
use request\AddLogRequestHelper;
use response\ReleaseResponse;

class AddDesignerLogRequestHandler extends RequestHandler {
	
	private $designerLogRepository;
	private $logRequestHelper;
	
	public function __construct() {
		$this->designerLog = new DesignerLogRepository();
		$this->logRequestHelper = new AddLogRequestHelper();
	}
	
	public function getRequestMethod() {
		return 'POST';
	}
	
	public function getUrlPath() {
		return '/ivy/pro/UpdateService/UpdateService/141746D7E212F6D2/designer.ivp';		
	}
	
	public function execute() {
		$record = $this->createDesignerLogRecord();
		$this->designerLog->write($record);
		
		$releaseResponse = new ReleaseResponse($record->getDesigner()->getVersion());
		$releaseResponse->render();
	}
	
	private function createDesignerLogRecord() {
		$timestamp = time();
		$java = $this->logRequestHelper->createJava();
		$designer = $this->logRequestHelper->createDesigner();
		$memory = $this->logRequestHelper->createMemory();
		$network = $this->logRequestHelper->createNetwork();
		$operatingSystem = $this->logRequestHelper->createOperatingSystem();
		
		return new DesignerLogRecord($timestamp, $java, $designer, $memory, $network, $operatingSystem);
	}

}
