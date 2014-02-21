<?php
defined('_REXEC') or die('Restricted Access');

ob_start();
if(isset($_GET['getMeasurement'])) {
	$item = Item::getById($_GET['item_id']);
	print $item->m_code;
}


$html = ob_get_clean();
print $html;
?>
	