<?php
require_once('global.php');	

ob_start();
$date = $_POST['date'];
print '	<H3>Sales Report of Date ' . $date . '</H3>';
print '<DIV ID="sales_report">';

		if(PurchaseItem::check($date)) {
			$pi = PurchaseItem::getListByDate($date);
			
			print '<table>';
			print '<tr class="heading">';
			print '<td>S.No.</td><td>Purchase Code</td><td>Item Name</td><td>Quantity</td><td>Rate</td>';
			print '<td>Total</td></tr>';
			$bgcolor = '#EFEFEF';
			$switch = 1;
			$sno = 1;
			foreach($pi as $value) {
				if($switch==1) {
					$bgcolor = '#DFDFDF';
					$switch = 0;
				} else {
					$bgcolor = '#EFEFEF';
					$switch = 1;
				}
				print "<tr style='background:$bgcolor'>";
				print '<td>' . $sno . '</td>';
				print '<td>' . $value->pur_code . '</td>';
				$iteminfo = Item::getById($value->item_code);
				print '<td>' . $iteminfo->name . '</td>';
				print '<td>' . $value->item_qty . '</td>';
				print '<td>' . $value->item_rate . '</td>';
				print '<td>' . $value->item_qty * $value->item_rate . '</td>';
				print '</tr>';
				$sno++;
			}
			print '</table>';

			} 


print '</DIV>';

$form = ob_get_clean();

$GLOBALS['TEMPLATE']['content'] .= $form;

require_once(TEMPLATE_PATH . 'print.php');
?>

 