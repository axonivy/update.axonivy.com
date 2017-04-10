<?php
namespace request;

use Exception;
use request\RequestHandler;
use repository\DesignerLogRepository;
use repository\EngineLogRepository;

class LogReaderRequestHandler extends RequestHandler {
	
	private $designerLogRepo;
	private $engineLogRepo;
	
	public function __construct() {
		$this->designerLogRepo = new DesignerLogRepository();
		$this->engineLogRepo = new EngineLogRepository();
	}
	
	public function getRequestMethod() {
		return 'GET';
	}
	
	public function getUrlPath() {
		return '/api/log';
	}
	
	public function execute() {
		$type = $_GET['type'];
		$idFrom = $_GET['idFrom'];
		$count = $_GET['count'];
		
		$logRecords;
		if ($type == 'designer') {
			$logRecords = $this->designerLogRepo->find($idFrom, $count);
		} elseif ($type == 'engine') {
			$logRecords = $this->engineLogRepo->find($idFrom, $count);
		} else {
			throw new Exception('not a valid type');
		}
		echo json_encode($logRecords);
	}	
}
