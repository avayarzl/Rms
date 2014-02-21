<?php
require_once('global.php');	
ob_start();
require_once(BASE_PATH . DS. 'ajax' .DS.'measurement_list.php');

$html = ob_get_clean();

$GLOBALS['TEMPLATE']['content'] .= '<h3>Viewing Measurements Record</h3>';
$GLOBALS['TEMPLATE']['content'] .= $html;

require_once(TEMPLATE_PATH . 'page.php');
?>

 