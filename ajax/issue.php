<?php
defined('_REXEC') or die('Restricted Access');

$mode = $_GET['mode'];

if($mode=="add") {
	$issue_code = $_POST['issue_code'];
	$issue_date = date('y/m/d');
	$dept_code = $_POST['dept_name'];
	$item_code = $_POST['item_name'];
	$item_qty = $_POST['quantity'];	
	
	$i_item = new IssueItem();
	$i_item->issue_code = $issue_code;
	$i_item->issue_date = $issue_date;
	$i_item->dept_code = $dept_code;
	$i_item->item_code = $item_code;
	$i_item->item_qty = $item_qty;
	
	if($i_item->save()) {
		print '1';
	}
}
else if($mode=="list") {
	$i_item = IssueItem::getById($_GET['issue_code']);
	
	ob_start();
	
	print '<table>';
	print '<tr class="heading"><td>Item Code</td><td>Item Name</td>';
	print '<td>Scale</td><td>Quantity</td><td>Actions</td></tr>';
	
	$bgcolor = '#EFEFEF';
	$switch = 1;

	foreach($i_item as $i_value) {
		if($switch==1) {
			$bgcolor = '#DFDFDF';
			$switch = 0;
		} else {
			$bgcolor = '#EFEFEF';
			$switch = 1;
		}
		print "<tr style='background:$bgcolor'><td>" . $i_value->item_code . '</td>';
		$iteminfo = Item::getById($i_value->item_code);
		print '<td>' . $iteminfo->name . '</td>';
		print '<td>'. $iteminfo->m_code .'</td>';
		print '<td>' . $i_value->item_qty . '</td>';
		$js_code = 'deleteItem("'. $_GET['issue_code'] . '","' . $i_value->item_code . '");return false;';
		print '<td><a href="#" onClick="deleteItem(\'' .$_GET['issue_code'] . '\',\'' . $i_value->item_code . '\');return false;">Delete</a></td></tr>';
	}
	
	$html = ob_get_clean();
	print $html;
}
else if($mode=="delete") {
	$issue_code = $_GET['issue_code'];
	$item_code = $_GET['item_code'];
	
	IssueItem::deleteItem($issue_code,$item_code);
	
}


?>
	