<?php
	define('RESTRICTED', 1);
	
	require_once 'core/functions.php';
	require_once 'config.php';
	
	$bootstrap = new Bootstrap();

	$bootstrap->exception($exceptions);
	$bootstrap->init();