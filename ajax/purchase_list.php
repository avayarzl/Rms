<?php
defined('_REXEC') or die('Restricted Access');

$list = PurchaseItem::getAllList();

ob_start();


	print '<table>';
	print '<tr class="heading"><td>S.No.</td>';
	print '<td>Purchase Code</td>';
	print '<td>Purchase Date</td>';
	print '<td>Item Name</td>';
	print '<td>Quantity</td>';
	print '<td>Rate</td></tr>';

	$bgcolor = '#EFEFEF';
	$switch = 1;
	$counter = 1;
	
	foreach($list as $value) {
		if($switch==1) {
			$bgcolor = '#DFDFDF';
			$switch = 0;
		} else {
			$bgcolor = '#EFEFEF';
			$switch = 1;
		}
			
		
		print "<tr style='background:$bgcolor'><td>" . $counter . '</td>';
		print '<td>' . $value->pur_code . '</td>';
		print '<td>' . $value->pur_date . '</td>';
		$iteminfo = Item::getById($value->item_code);
		print '<td>' . $iteminfo->name . '</td>';
		print '<td>' . $value->item_qty . '</td>';
		print '<td>' . $value->item_rate . '</td>';
		print '</tr>';
	}

	print '</table>';



$html = ob_get_clean();
print $html;
?>
	