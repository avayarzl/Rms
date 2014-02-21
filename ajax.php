<?php
/*
	@author Prasham
	
*/




$filename = isset($_GET['f']) ? $_GET['f'] : (isset($_POST['f']) ? $_POST['f'] : 'nofile');

// PARENT FLAG
define('_REXEC', 1);

// ByPass User Authethication process if the request is the login ajax
if($filename == 'login')
	define('LOGIN_PROCESS',1);

require_once('global.php');

$mode = isset($_POST['mode']) ? $_POST['mode'] : 'mode';

include_once(BASE_PATH . DS . 'ajax' . DS .  $filename . '.php');	

?>
