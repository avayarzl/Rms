<?php
require_once("global.php");

$html = '<p><a href="logoff2.php">Click here</a> to log off the system and log in as a new user.</p>';
$GLOBALS['TEMPLATE']['content'] .= $html;

require_once(TEMPLATE_PATH . 'page.php');

?>
