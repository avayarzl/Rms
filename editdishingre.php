<?php
require_once('global.php');	

if(isset($_POST['dishId'])) 
	$dish_id = $_POST['dishId'];
else if(isset($_GET['dishId'])) 
	$dish_id = $_GET['dishId'];
else 
	$dish_id = 0;
	
if(isset($_GET['mode'])) 
	$mode = $_GET['mode'];
else 
	$mode = "";
	
if(isset($_GET['item']))
	$itemCode = $_GET['item'];

if($dish_id!=0) {
	$dish = Dish::getDishInfo($dish_id);
	$GLOBALS['TEMPLATE']['content'] .= "<h3>Modfiy Dish Record (Ingredient) of {$dish->dish_name} </h3>";
}



$html = '';
ob_start();
 
if($dish_id != 0 or isset($_POST['modifypage'])) {
	$dish = Dish::getDishInfo($dish_id);
	$dishdetail = Dish::getById($dish_id);

	if($mode=="delete") {
		if(Dish::deleteIngredient($dish_id,$itemCode)) {
			$html .= '<p>The dish Ingredient Item deleted.</p>';
		} else {
			$html .= '<p>Couldnot delete the dish ingredient item</p>';
		}
	} else if($mode=="modify") {
		$iteminfo = Item::getById($itemCode);
		$dishinfo = Dish::getDishItem($dish_id, $itemCode);
		print '<form method=post action="editdishingre.php">';
		print '<table>';
		print '<tr class="heading"><td>Item Name</td><td>' . $iteminfo->name . '</td></tr>';
		print '<tr><td>Quantity</td><td><input type="text" name="quantity" value="' . $dishinfo->quantity . '" size=10></td></tr>';
		print '<tr><td>Cost</td><td><input type="text" name="cost" value="' . $dishinfo->cost . '" size=10></td></tr>';
		print '<tr><td align=center colspan=2><input type="hidden" name="modifypage" value="true">';
		print '<input type="hidden" name="dishId" value="'. $dishinfo->dish_code . '">';
		print '<input type="hidden" name="item_code" value="'. $itemCode . '">';
		print '<input type="submit" value="Modify" name="submit"></td></tr>';
		print '</table>';
		print '</form>';		
	} 
	
	if(isset($_POST['modifypage'])) {
		$item_code = $_POST['item_code'];
		$dish_code = $dish_id;
		$quantity = new Validator("Quantity",$_POST['quantity']);
		$cost = new Validator("Cost",$_POST['cost']);
		
		$d = new Dish();
		$d->dish_code = $dish_code;
		$d->item_code = $item_code;
		$d->quantity = $quantity->getValue();
		$d->cost = $cost->getValue();
	
		if($d->updateIngredient($dish_code, $item_code)) {
			$html .= "<p>The item ingredient was modified.</p>";
		} else {
			$html .= "<P>Couldnt update the record.</p>";
		}
	
	} 
	else {
	
	$dish = Dish::getById($dish_id);
	$total_cost=0;

	print '<table>';
	print '<tr class="heading"><td>Item Name</td><td>Item code</td>';
	print '<td>Scale</td><td>Quantity</td><td>Cost</td><td>Actions</td></tr>';
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
		$iteminfo = Item::getById($d_value->item_code);
		print "<tr style='background:$bgcolor'><td>" . $iteminfo->name . '</td>';
		print '<td>' . $d_value->item_code . '</td>';
		print '<td>'.$iteminfo->m_code . '</td>';
		print '<td>' . $d_value->quantity . '</td>';
		print '<td>' . $d_value->cost . '</td>';
		print "<td><a href=\"editdishingre.php?mode=modify&item={$d_value->item_code}&dishId={$d_value->dish_code}\">Modify</a> | <a href=\"editdishingre.php?mode=delete&item={$d_value->item_code}&dishId={$d_value->dish_code}\">Delete</a></td></tr>";
		$total_cost += $d_value->cost;
	}
	
	print "Total Cost Price:  $total_cost ";
	}
}
else {
	print '<p>No Dish Item was selected. Please go to the Dish Modfiy Page from the menu.</p>';
}	

$form = ob_get_clean();
$GLOBALS['TEMPLATE']['content'] .= $form; 

require_once(TEMPLATE_PATH . 'page.php');
?>

 