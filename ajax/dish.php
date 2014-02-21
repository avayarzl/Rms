<?php
defined('_REXEC') or die('Restricted Access');

$mode = $_GET['mode'];

if($mode=="add") {
	$dish_code = $_POST['dish_code'];
	$dish_name =$_POST['dish_name'];
	$dish_serving = $_POST['servings'];
	$item_code = $_POST['item_name'];
	$item_qty = $_POST['quantity'];	
	$dept_code = $_POST['dept_name'];
	$cost = $_POST['cost'];
	$sale_price = $_POST['sell_price'];
	
	
	$dish = new Dish();
	$dish->dish_code = $dish_code;
	$dish->dish_name = $dish_name;
	$dish->dish_serving = $dish_serving;
	$dish->item_code = $item_code;
	$dish->quantity = $item_qty;
	$dish->dept_code = $dept_code;
	$dish->cost = $cost;
	$dish->sale_price = $sale_price;
	
	if($dish->save()) {
		print '1';
	}
}
else if($mode=="list") {
	$dish = Dish::getById($_GET['dish_code']);
	$total_cost=0;
	
	ob_start();
	
	print '<table>';
	print '<tr class="heading"><td>Item Name</td><td>Item code</td>';
	print '<td>Scale</td><td>Quantity</td><td>Cost</td><td>Actions</td></tr>';
	foreach($dish as $d_value) {
		$iteminfo = Item::getById($d_value->item_code);
		print '<tr><td>' . $iteminfo->name . '</td>';
		print '<td>' . $d_value->item_code . '</td>';
		print '<td>'.$iteminfo->m_code . '</td>';
		print '<td>' . $d_value->quantity . '</td>';
		print '<td>' . $d_value->cost . '</td>';
		print '<td><a href="adddish.php" onClick="deleteIngredient(' . $d_value->dish_code . ',' . $d_value->item_code .');return false;">DELETE</a></td></tr>';
		$total_cost += $d_value->cost; 
	}
	
	print 'Total Cost Price <INPUT NAME="total_cost" TYPE="text" value="' . $total_cost . '">';
	$html = ob_get_clean();
	print $html;
}
else if($mode=="delete") {
	$dish_code = $_GET['dish_code'];
	$item_code = $_GET['item_code'];
	
	if(Dish::deleteIngredient($dish_code,$item_code)) {
		print '1';
	}
}


?>
	