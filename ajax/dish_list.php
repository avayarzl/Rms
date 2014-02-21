<?php
defined('_REXEC') or die('Restricted Access');

$dish_list = Dish::getDishList();

ob_start();


	foreach($dish_list as $dish_value) {
		print '<option value="' . $dish_value->dish_code . '">' . $dish_value->dish_name . '</option>';
	}


$html = ob_get_clean();
print $html;
?>
	