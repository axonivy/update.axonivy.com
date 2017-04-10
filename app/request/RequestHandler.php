<?php
namespace request;

abstract class RequestHandler {
	abstract function getUrlPath();
	abstract function getRequestMethod();
	abstract function execute();
}
