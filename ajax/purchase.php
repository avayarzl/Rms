<?php
defined('_REXEC') or die('Restricted Access');

$mode = $_GET['mode'];

if($mode=="add") {
	$pur_code = $_POST['pur_code'];
	$pur_date = date('y/m/d');
	$item_code = $_POST['item_name'];
	$quantity = $_POST['quantity'];
	$rate = $_POST['rate'];
	
	$p_item = new PurchaseItem();
	$p_item->pur_code = $pur_code;
	$p_item->pur_date = $pur_date;
	$p_item->item_code = $item_code;
	$p_item->item_qty = $quantity;
	$p_item->item_rate = $rate;
	
	if($p_item->save()) {
		print '1';
	}
}
else if($mode=="list") {
	$p_item = PurchaseItem::getById($_GET['pur_code']);
	
	ob_start();
	
	print '<table>';
	print '<tr class="heading"><td>Item Code</td><td>Item Name</td>';
	print '<td>Scale</td><td>Quantity</td><td>Rate</td><td>Total</td><td>Action</td></tr>';
	
	$total = 0;
	$bgcolor = '#EFEFEF';
	$switch = 1;
	foreach($p_item as $p_value) {
		if($switch==1) {
			$bgcolor = '#DFDFDF';
			$switch = 0;
		} else {
			$bgcolor = '#EFEFEF';
			$switch = 1;
		}
		print "<tr style='background:$bgcolor'><td>" . $p_value->item_code . '</td>';
		$iteminfo = Item::getById($p_value->item_code);
		print '<td>' . $iteminfo->name . '</td>';
		print '<td>' . $iteminfo->m_code . '</td>';
		print '<td>' . $p_value->item_qty . '</td>';
		print '<td>' . $p_value->item_rate . '</td>';
		print '<td>' . $p_value->item_qty * $p_value->item_rate . '</td>';
		$total += ($p_value->item_qty * $p_value->item_rate);
		print '<td><a href="#" onClick="deleteItem(\'' .$_GET['pur_code'] . '\',\'' . $p_value->item_code . '\');return false;">Delete</a></td></tr>';
	}
	
	print "<p>Total Cost: $total</p>";
	$html = ob_get_clean();
	print $html;
}
else if($mode=="delete") {
	$purchase_code = $_GET['pur_code'];
	$item_code = $_GET['item_code'];
	
	PurchaseItem::deleteItem($purchase_code,$item_code);
	
}


?>
	