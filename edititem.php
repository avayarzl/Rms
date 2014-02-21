<?php
require_once('global.php');	

$GLOBALS['TEMPLATE']['content'] .= '<h3>Modify Item Record</h3>';
if(isset($_POST['itemId'])) 
	$item_id = $_POST['itemId'];
else if(isset($_GET['itemId'])) 
	$item_id = $_GET['itemId'];
else 
	$item_id = 0;
	
if($item_id != 0)
	$item = Item::getById($item_id);


ob_start();
?>
<FORM METHOD="get" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<P>Select Item Name: <SELECT NAME="itemId"> <?php 
$_GET['option_data'] = true;
require_once('ajax'.DS.'item_list.php');
?></SELECT> <INPUT TYPE="submit" NAME="iSubmit" VALUE="Go"></P>
</FORM>
<?php 
if($item_id != 0) {
?>
<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <TABLE>
    <TR> 
      <TD> <LABEL>Item Code</LABEL></TD>
      <TD> <INPUT TYPE="text" SIZE="20" VALUE="<?php echo $item->itemId ?>" DISABLED="DISABLED" />
	  <INPUT TYPE="hidden" NAME="item_code" VALUE="<?php echo $item->itemId ?>"></TD>
    </TR>
    <TR> 
      <TD> <LABEL>Item Name</LABEL> </TD>
      <TD> <INPUT TYPE="text" ID="item_name" NAME="item_name" SIZE="20" VALUE="<?php echo $item->name ?>"> </TD>
    </TR>
    <TR> 
      <TD> <LABEL>Measurement Code</LABEL></TD>
      <TD><SELECT NAME="m_code" ID="m_code">
	  <?php
			$_GET['option_data'] = true;
			require_once('ajax'.DS.'measurement_list.php');
		?>
        </SELECT></TD>
    </TR>
    <TR> 
      <TD> <LABEL>Reorder Level</LABEL> </TD>
      <TD><INPUT NAME="reorder_lvl" TYPE="text" ID="reorder_lvl" SIZE="20" VALUE="<?php echo $item->reorder_lvl ?>"></TD>
    </TR>
    <TR ALIGN="CENTER"> 
      <TD COLSPAN=2> 
        <INPUT TYPE="SUBMIT" NAME="submit" VALUE="Update"> 
        <INPUT NAME="delete" TYPE="SUBMIT" ID="reset" VALUE="Delete Record"> 
        <INPUT TYPE="hidden" NAME="itemId" VALUE="<?php echo $item->itemId; ?>"> 
      </TD>
    </TR>
  </TABLE>
</FORM>

<?php
}
$form = ob_get_clean();


if(!isset($_POST['submit']) and !isset($_POST['delete'])) {
	$GLOBALS['TEMPLATE']['content'] .= $form;
}
else {
	
	if(!isset($_POST['delete'])) {
		
		$item_code = $_POST['item_code'];
	$item_name = new Validator("Item Name",$_POST['item_name']);
	$m_code = new Validator("Measurement Code",$_POST['m_code']);
	$reorder_lvl = new Validator("Reorder Level",$_POST['reorder_lvl']);

	if(Validator::isError()) { 
		$html = "<div id='error'>The following errors occured.Press the browser BACK button to fix them.";
		ob_start();
		 echo Validator::displayErrors();
		$html1 = ob_get_clean();
		$html .= $html1 . '</div>';
		$GLOBALS['TEMPLATE']['content'] .= $html;
	}
	else {
	$item->itemId = $item_code;
	$item->name = $item_name->getValue();
	$item->m_code = $m_code->getValue();
	$item->reorder_lvl = $reorder_lvl->getValue();
	if($item->save()) {
			$GLOBALS['TEMPLATE']['content'] .= '<p>The Item Record was successfully updated.</p>';
		}
		else {
			$html = '<p>There was some error while inserting the records.</p>';
			$html .= 'MySQL ERROR: ' . mysql_error(DB);
			$html .= 'MySQL ErrorNo: ' . mysql_errno(DB);
			$GLOBALS['TEMPLATE']['content'] = $html;
		}
	}	
	
	
		
	} else {
		if(Item::deleteById($item_id)) {
			$html = "<p>The Item Record was deleted.</p>";
			$GLOBALS['TEMPLATE']['content'] .= $html;
		}
		else {
			$html = '<p>There was some error while inserting the records.</p>';
			$html .= 'MySQL ERROR: ' . mysql_error(DB);
			$html .= 'MySQL ErrorNo: ' . mysql_errno(DB);
			$GLOBALS['TEMPLATE']['content'] .= $html;
		}
	}	
	
	
	
}

require_once(TEMPLATE_PATH . 'page.php');
?>

 