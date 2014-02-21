<?php
require_once('global.php');	

ob_start();
$date = $_POST['date'];
$dept_code = $_POST['dept_code'];
print '	<H3>Dish Consumption Report of Date ' . $date . '</H3>';
print '<DIV ID="consumption_report">';
if(DishConsumption::check($date,$dept_code)) {
			$d = DishConsumption::getByDate($date,$dept_code);
			
			print '<table>';
			print '<tr class="heading">';
			print '<td>S.No.</td><td>Dish</td><td>Prepared</td><td>Waste</td><td>Wastage Description</td>';
			print '</tr>';
			$sno = 1;
			$bgcolor = '#EFEFEF';
			$switch = 1;
			foreach($d as $d_value) {
					if($switch==1) {
						$bgcolor = '#DFDFDF';
						$switch = 0;
					} else {
						$bgcolor = '#EFEFEF';
						$switch = 1;
					}
				print "<tr style='background:$bgcolor'>";
				print '<td>' . $sno . '</td>';
				$dishinfo = Dish::getDishInfo($d_value->dish_code);
				print '<td>' . $dishinfo->name . '</td>';
				print '<td>' . $d_value->prepared . '</td>';
				print '<td>' . $d_value->wastage . '</td>';
				print '<td>' . $d_value->wastage_description . '</td>';
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

 