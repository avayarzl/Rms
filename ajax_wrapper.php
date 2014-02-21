<?php
//if(isset($_GET['ajax_inc'])) {
	require_once('global.php'); 
//}

//defined('_REXEC') or die('Restricted Access');

require_once(BASE_PATH.DS.'ajax'.DS . $_GET['aj_file'] . '.php');
?>
	