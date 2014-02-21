<?php
require_once("global.php");

$html = '<p><a href="logoff1.php">Click here</a> to log off the system.</p>';
$GLOBALS['TEMPLATE']['content'] .= $html;

require_once(TEMPLATE_PATH . 'page.php');

?>
