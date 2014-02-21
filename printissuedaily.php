<?php
require_once('global.php');	

ob_start();
$date = $_POST['date'];
print '	<H3>Issue Report of Date ' . $date . '</H3>';
print '<DIV ID="issue_report">';

		if(IssueItem::check($date)) {
			$ii = IssueItem::getListByDate($date);
			
			print '<table>';
			print '<tr class="heading">';
			print '<td>S.No.</td><td>Issue Code</td><td>Department</td><td>Item Name</td><td>Quantity</td>';
			print '</tr>';
			$bgcolor = '#EFEFEF';
			$switch = 1;
			$sno = 1;
			foreach($ii as $value) {
				if($switch==1) {
					$bgcolor = '#DFDFDF';
					$switch = 0;
				} else {
					$bgcolor = '#EFEFEF';
					$switch = 1;
				}
				print "<tr style='background:$bgcolor'>";
				print '<td>' . $sno . '</td>';
				print '<td>' . $value->issue_code . '</td>';
				$deptinfo = Department::getById($value->dept_code);
				$iteminfo = Item::getById($value->item_code);
				print '<td>' . $deptinfo->name . '</td>';
				print '<td>' . $iteminfo->name . '</td>';
				print '<td>' . $value->item_qty  . '</td>';
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

 