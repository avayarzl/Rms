<?php
defined('_REXEC') or die('Restricted Access');

$dish = Dish::getById($_GET['dish_code']);
$dish_master = Dish::getByIdDishMaster($_GET['dish_code']);
$total_cost=0;

	ob_start();

?>	

<TABLE width="70%">
  <TR> 
    <TD WIDTH="42%">Dish Name: <strong><?php echo $dish_master->dish_name; ?></strong></TD>
    <TD WIDTH="58%">No. of Servings: <?php echo $dish_master->dish_serving; ?></TD>
  </TR>
  <TR> 
    <TD>Dish Code: <?php echo $dish_master->dish_code; ?></TD>
    <TD>Department Name: <?php
		$d = Department::getById($dish_master->dept_code);
		echo $d->name;
	 ?></TD>
  </TR>
  <TR> 
    <TD COLSPAN="2">
	<?php	
	print '<table>';
	print '<tr class="heading"><td>Item Code</td><td>Item Name</td>';
	print '<td>Scale</td><td>Quantity</td><td>Cost</td></tr>';
	
	$bgcolor = '#EFEFEF';
	$switch = 1;
	
	foreach($dish as $d_value) {
			if($switch==1) {
			$bgcolor = '#DFDFDF';
			$switch = 0;
		} else {
			$bgcolor = '#EFEFEF';
			$switch = 1;
		}
		$item = Item::getById($d_value->item_code);
		print "<tr style='background:$bgcolor'><td>" . $d_value->item_code . '</td>';
		print '<td>' . $item->name . '</td>';
		print '<td>'. $item->m_code . '</td>';
		print '<td>' . $d_value->quantity . '</td>';
		print '<td>' . $d_value->cost . '</td></tr>';
		$total_cost += $d_value->cost; 
	}
	print '</table>';
	?>
	</TD>
  </TR>
  <TR> 
    <TD>Total Cost Price: <STRONG><?php echo $total_cost; ?> </STRONG></TD>
    <TD>Estimate Sell Price: <STRONG><?php echo $dish_master->sale_price ?></STRONG></TD>
  </TR>
</TABLE>
	
<?php
	
	$html = ob_get_clean();
	print $html;

?>
	