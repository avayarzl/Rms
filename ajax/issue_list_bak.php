<?php
defined('_REXEC') or die('Restricted Access');

$issue_list = IssueItem::getList($date);

ob_start();

print '<table>';
print '<tr class="heading"><td>Item Name</td>';
print '<td>Item Code</td>';
print '<td>Measurement Unit</td>';
print '<td>Quantity</td>';
print '<td>Actions</td></tr>';

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
	print '<td>' . $item_value->reorder_lvl . '</td>';
}

print '</table>';


$html = ob_get_clean();
print $html;
?>
	