<?php if(!defined('RESTRICTED'))exit('No direct script access.');

	// Debug configuration
	function debug_config( $status )
	{
		if( $status ) {
			ini_set('display_errors', 1);
			error_reporting(E_ALL);
		}
		else {
			error_reporting(0);
		}
	}

	function debug( $var )
	{
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
		exit;
	}

	function defineUrl()
	{
		$protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
		$host     = $_SERVER['HTTP_HOST'];
		$folder   = dirname($_SERVER['PHP_SELF']);

		if( $folder !== '/' ) $folder .= '/';

		define('URL', $protocol . $host . $folder);
	}

	// Auto load configuration
	function __autoload( $class_name )
	{
		$directories = array(
			'core',
			'app/controllers',
			'app/models',
			'app/classes'
		);

		foreach( $directories as $dir ) {
			if( read_require($dir, $class_name) )
				return;
		}
	}

	function read_require( $dir, $class_name )
	{
		$files = array_diff(scandir($dir), array('.','..'));
    	foreach( $files as $file )
    	{
    		if( is_dir($dir .'/'. $file) ) {
    			read_require($dir .'/'. $file, $class_name);
    		}
    		else if( file_exists($dir .'/'. $class_name .'.php') ) {
    			require_once $dir .'/'. $class_name .'.php';
    			return true;
    		}
    	}
    	return false;
	}

	// Executing some functions
	defineUrl();