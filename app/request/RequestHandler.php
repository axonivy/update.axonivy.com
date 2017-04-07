<?php
namespace request;

abstract class RequestHandler {
	abstract function getUrlPath();
	abstract function execute();
}
