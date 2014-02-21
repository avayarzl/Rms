<?php
defined('_REXEC') or die('Restricted Access');

$mode = $_GET['mode'];
$cat = $_GET['cat'];

if($mode=="add") {
		if($cat == "item") {
			$dept_code = $_POST['dept_name'];
			$item_code = $_POST['item_name'];
			$consumption = $_POST['consumption'];
			$date = date('y/m/d');
			$wastage = $_POST['wastage'];
			$wastage_description = $_POST['wastage_description'];
			
			$item_con = new ItemConsumption();
			$item_con->dept_code = $dept_code;
			$item_con->item_code = $item_code;
			$item_con->consumption = $consumption;
			$item_con->date = date('y/m/d');;
			$item_con->wastage = $wastage;
			$item_con->wastage_description = $wastage_description;
			if($item_con->save()) 
				print '1';
			else 
				print 'error';
		}
		else if($cat =="dish") {
			$dept_code = $_POST['dept_name'];
			$dish_code = $_POST['dish_name'];
			$prepared = $_POST['prepared'];
			$date = date('y/m/d');
			$wastage = $_POST['wastage'];
			$wastage_description = $_POST['wastage_description'];
			
			$dish_con = new DishConsumption();
			$dish_con->dept_code = $dept_code;
			$dish_con->dish_code = $dish_code;
			$dish_con->prepared = $prepared;
			$dish_con->date = $date;
			$dish_con->wastage = $wastage;
			$dish_con->wastage_description = $wastage_description;
			if($dish_con->save()) 
				print '1';
		}

}
else if($mode=="list") {
	$dept_code = $_GET['dept'];
	if($cat=="item") {
		$arr = ItemConsumption::getByDate(-1, $dept_code);
		
		ob_start();

		
		print '<table>';
		print '<tr><td>Item Name</td><td>Item Code</td>';
		print '<td>Consumption</td><td>Wastage</td>';
		print '<td>Wasage Description</td></tr>';
		
		foreach($arr as $value) {
			print '<tr>';
			$iteminfo = Item::getById($value->item_code);
			print '<td>' .$iteminfo->name . '</td>';
			print '<td>' . $value->item_code. '</td>';
			print '<td>' .$value->consumption . '</td>';
			print '<td>' .$value->wastage . '</td>';
			print '<td>' .$value->wastage_description . '</td>';		
			print '</tr>';
		}
		print '</table>';
	}
	else if($cat=="dish") {
		$arr = DishConsumption::getByDate(-1,$dept_code);
		
		ob_start();
		
		print '<table>';
		print '<tr><td>Dish Name</td><td>Dish Code</td>';
		print '<td>Prepared</td><td>Wastage</td>';
		print '<td>Wasage Description</td></tr>';
		
		foreach($arr as $value) {
			print '<tr>';
			$dishinfo = Dish::getById($value->dish_code);
			print '<td>' .$dishinfo->name . '</td>';
			print '<td>' .$value->dish_code . '</td>';
			print '<td>' .$value->prepared . '</td>';
			print '<td>' .$value->wastage . '</td>';
			print '<td>' .$value->wastage_description . '</td>';	
			print '</tr>';
		}
		print '</table>';
	}

	$html = ob_get_clean();
	print $html;
}
else if($mode=="delete") {
	if($cat=="item") {
		
	}
	else if($cat=="dish") {
		
	}
	$dish_code = $_GET['dish_code'];
	$item_code = $_GET['item_code'];
	

}


?>
	