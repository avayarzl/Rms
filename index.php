<?php
session_start();



define('_REXEC',1);

require_once('config.php');

$menuoff = true;

$GLOBALS['TEMPLATE']['content'] .= '<h3>Hamro Restaurent MGMT SYS</h3>';
$GLOBALS['TEMPLATE']['content'] .= '<p><a href="login.php">Click Here</a> to log into the system</p>';                                          
require_once(TEMPLATE_PATH . 'page.php');
?>

 