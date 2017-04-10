<?php
namespace request;

use request\RequestHandler;

class RequestHandlerRegistry {
	private $requestHandlers = [];
	
	public function register(RequestHandler $requestHandler) {
		$urlPath = $requestHandler->getUrlPath();
		$this->requestHandlers[$urlPath] = $requestHandler;
	}
	
	public function findRequestHandlerForCurrentRequest() {
		$url = parse_url($_SERVER['REQUEST_URI']);
		$path = $url['path'];
		if (isset($this->requestHandlers[$path])) {			
			$requestHandler = $this->requestHandlers[$path];
			if ($_SERVER['REQUEST_METHOD'] == $requestHandler->getRequestMethod()) {
				return $requestHandler;
			}
		}
		return null;
	}
}
