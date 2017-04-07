<?php
spl_autoload_register(function($class) {
	$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
	
	if ($class == 'config\Config') {
		$file = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
		if (file_exists($file)) {
			$filename = $file;
		}
	}
	
	require_once($filename);
});
