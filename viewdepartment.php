<?php
require_once('global.php');	
ob_start();
require_once(BASE_PATH . DS. 'ajax' .DS.'dept_list.php');

$html = ob_get_clean();

$GLOBALS['TEMPLATE']['content'] .= '<h3>Viewing Department Records</h3>';
$GLOBALS['TEMPLATE']['content'] .= $html;

require_once(TEMPLATE_PATH . 'page.php');
?>

 