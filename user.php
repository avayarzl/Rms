<?php
require_once('global.php');	
ob_start();
require_once(BASE_PATH . DS. 'ajax' .DS.'user_list.php');

$html = ob_get_clean();

$GLOBALS['TEMPLATE']['content'] .= '<h3>User Records</h3>';
$GLOBALS['TEMPLATE']['content'] .= '<p>List of the users account created in the system</p>';
$GLOBALS['TEMPLATE']['content'] .= $html;

require_once(TEMPLATE_PATH . 'page.php');
?>

 