<?php
defined('_REXEC') or die('Restricted Access');

$item_list = Item::getAllList();

ob_start();

if(isset($_GET['option_data'])) {
	foreach($item_list as $item_value) {
		print '<option value="' . $item_value->itemId . '">' . $item_value->name . '</option>';
	}
}
else {
	print '<table>';
	print '<tr class="heading"><td>Item Code</td>';
	print '<td>Item Name</td>';
	print '<td>Measurement Unit</td>';
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
		print '<td>' . $item_value->reorder_lvl . ' ' . $item_value->m_code. '</td>';
		print '</tr>';
	}

	print '</table>';
}

$html = ob_get_clean();
print $html;
?>
	