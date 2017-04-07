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
			return $this->requestHandlers[$path];
		} else {
			return null;
		}
	}
}
