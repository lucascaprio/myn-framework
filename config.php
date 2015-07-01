<?php if(!defined('RESTRICTED'))exit('No direct script access.');

	// Debug configuration
	debug_config(true);


	// Enable Garbage Collector
	gc_enable();


	// Define date default timezone
	date_default_timezone_set('Brazil/East');


	// Routes Exception
	$exceptions = array(
		'admin'
	);

	
	// Database configuration
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', 'root');
	define('DB_NAME', 'your_database');
	

	// Url configuration
	define('URL_ADMIN',  URL . 'admin/');
	define('URL_CSS',    URL . 'app/assets/css/');
	define('URL_JS',     URL . 'app/assets/js/');
	define('URL_IMG',    URL . 'app/assets/img/');
	define('URL_UPLOAD', URL . 'uploads/');


	// Password salt
	define('PW_SALT', 'TheNameOfYourProject');