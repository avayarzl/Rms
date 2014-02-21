<?php
require_once('global.php');	
$GLOBALS['TEMPLATE']['content'] .= '<h3>Add New Item</h3>';
ob_start();
?>
<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <TABLE>
    <TR> 
      <TD> <LABEL>Item Code</LABEL></TD>
      <TD><?php 
	  	$new_id = Item::getNewId();
	  	echo $new_id;
		?> </TD>
    </TR>
    <TR> 
      <TD> <LABEL>Item Name</LABEL> </TD>
      <TD> <INPUT TYPE="text" ID="item_name" NAME="item_name" SIZE="20"> </TD>
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
      <TD><INPUT NAME="reorder_lvl" TYPE="text" ID="reorder_lvl" SIZE="20"></TD>
    </TR>
    <TR> 
      <TD COLSPAN=2 ALIGN=center> <INPUT TYPE="SUBMIT" NAME="submit" VALUE="Save"> <INPUT NAME="reset" TYPE="RESET" ID="reset" VALUE="Clear"> 
      </TD>
    </TR>
  </TABLE>
</FORM>

<?php

$form = ob_get_clean();


if(!isset($_POST['submit'])) {
	$GLOBALS['TEMPLATE']['content'] .= $form;
}
else {
	$item_name = new Validator('Item Name',$_POST['item_name']);
	$m_code = new Validator('Measurement Code',$_POST['m_code']);
	$reorder_lvl = new Validator('Reorder Level',$_POST['reorder_lvl'],'EMPTY|FLOAT');
	
	if(Validator::isError()) { 
		$html = "<div id='error'>The following errors occured.Press the browser back button to fix them.";
		ob_start();
		 echo Validator::displayErrors();
		$html1 = ob_get_clean();
		$html .=  $html1 . '</div>';
		$GLOBALS['TEMPLATE']['content'] .= $html;
	}
	else {
	$item = new Item();
	$item->name = $item_name->getValue();
	$item->m_code = $m_code->getValue();
	$item->reorder_lvl = $reorder_lvl->getValue();
	if($item->save()) {
		$GLOBALS['TEMPLATE']['content'] .= '<p>The New Item was successfully inserted.</p>';
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

 