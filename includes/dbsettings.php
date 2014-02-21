<?php

//no direct access
defined('_REXEC') or die('Restricted Access');
	
if(!$db = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)) {
	die('ERROR: Unable to connect to the database server.');	
}
if(!mysql_select_db(DB_DATABASE, $db)) {
	mysql_close($db);
	die('ERROR: Unable to select the database.');
}

define('DB',$db);
	
?>