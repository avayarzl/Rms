<?php
require_once('global.php');	
ob_start();
	$item_list = Item::getAllList();
	print '<table>';
	print '<tr class="heading"><td>Item Code</td>';
	print '<td>Item Name</td>';
	print '<td>Measurement Unit</td>';
	print '<td>In-Stock</td>';
	print '<td>Status</td>';
	print '<td>Re-order Level</td></tr>';
	
	$bgcolor = '#EFEFEF';
	$switch = 1;

	foreach($item_list as $item_value) {
		if($switch==1) {
			$bgcolor = '#DFDFDF';
			$switch = 0;
		} else {
			$bgcolor = '#EFEFEF';
			$switch = 1;
		}
		print "<tr style='background:$bgcolor'><td>" . $item_value->itemId . '</td>';
		print '<td>' . $item_value->name . '</td>';
		print '<td>' . $item_value->m_code . '</td>';
		print '<td>' . $item_value->stock_qty . '</td>';
		if($item_value->stock_qty > $item_value->reorder_lvl) {
			$stock = "OK";
		}
		else {
			$stock = "<span style='color:red'>LOW</span>";
		}
		print '<td>' . $stock . '</td>';
		print '<td>' . $item_value->reorder_lvl . '</td>';
		print '</tr>';
	}

	print '</table>';

$html = ob_get_clean();

$GLOBALS['TEMPLATE']['content'] .= '<h3>Viewing Items Record</h3>';
$GLOBALS['TEMPLATE']['content'] .= $html;

require_once(TEMPLATE_PATH . 'page.php');
?>

 
 