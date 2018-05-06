<?php

/*
 * -------------------------------------------------------------------
 *  My Config Private
 * -------------------------------------------------------------------
 */
date_default_timezone_set('Asia/Ho_Chi_Minh');

define('FOLDER', '/BPCMS/');
define('ADMINCP', 'admin');
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on'){
	define('PATH_URL', 'https://'.$_SERVER['HTTP_HOST'].FOLDER);
	define('PATH_URL_ADMIN', 'https://'.$_SERVER['HTTP_HOST'].FOLDER.ADMINCP.'/');
}else{
	define('PATH_URL', 'http://'.$_SERVER['HTTP_HOST'].FOLDER);
	define('PATH_URL_ADMIN', 'http://'.$_SERVER['HTTP_HOST'].FOLDER.ADMINCP.'/');
}

define('PREFIX', 'pix_');
define('DB_USER', 'root');//root
define('DB_PASS', '');
define('DB_NAME', 'BPCMS');

define('IS_LOCALHOST', true);

define('DEBUG_LOG', true);
define('DEBUG_LOG_LAST_COMMAND', false);