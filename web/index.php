<?php
require_once('../app/autoload.php');

// Available request handlers
$requestHandlers = [
	new request\AddDesignerLogRequestHandler(),
	new request\AddEngineLogRequestHandler(),
	new request\LogReaderRequestHandler()
];

// Register all request handlers
$requestHandlerRegistry = new request\RequestHandlerRegistry();
foreach ($requestHandlers as $requestHandler) {
	$requestHandlerRegistry->register($requestHandler);
}

// Execute request handler
$requestHandler = $requestHandlerRegistry->findRequestHandlerForCurrentRequest();
if ($requestHandler == null) {
	die('no request handler for this request available');
}
$requestHandler->execute();
