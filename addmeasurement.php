<?php
require_once('global.php');	
$GLOBALS['TEMPLATE']['content'] .= '<h3>Add New Measurement Unit</h3>';
ob_start();
?>
<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <TABLE>
    <TR> 
      <TD> <LABEL>Code</LABEL> </TD>
      <TD> <INPUT TYPE="text" ID="code" NAME="code" SIZE="20" > </TD>
    </TR>
    <TR> 
      <TD> <LABEL>Description</LABEL> </TD>
      <TD> <INPUT TYPE="text" ID="description" NAME="description" SIZE="20"> </TD>
    </TR>
    <TR> 
      <TD COLSPAN=2> <INPUT TYPE="submit" NAME="submit" VALUE="Save Measurement">
        <INPUT NAME="reset" TYPE="RESET" ID="reset" VALUE="Clear"> </TD>
    </TR>
  </TABLE>
</FORM>

<?php

$form = ob_get_clean();


if(!isset($_POST['submit'])) {
	$GLOBALS['TEMPLATE']['content'] .= $form;
}
else {
	$codev = new Validator('Measurement Code',$_POST['code'],'EMPTY|INTEGER');
	$descriptionv = new Validator('Description',$_POST['description'],'EMPTY|STRING');
	
	if(Validator::isError()) { 
		$html = "<div id='error'>The following errors occured.Press the browser BACK button to fix them.";
		ob_start();
		 echo Validator::displayErrors();
		$html1 = ob_get_clean();
		$html .= $html1 . '</div>';
		$GLOBALS['TEMPLATE']['content'] .= $html;
	}
	else {
	$code = $codev->getValue();
	$description = $descriptionv->getValue();
		
	$query = "SELECT * from measurement_tbl WHERE m_code='$code'";
	$result = mysql_query($query);
	if(mysql_num_rows($result)>0) {
		$GLOBALS['TEMPLATE']['content'] .= '<p>The measurement code already exists.</p>';
	} else {
	$m = new Measurement();
	$m->code = $code;
	$m->description = $description;
	if($m->save()) {
		$GLOBALS['TEMPLATE']['content'] .= '<p>The New Measurement Record was successfully inserted.</p>';
	}
	else {
		$html = '<p>There was some error while inserting the records.</p>';
		$html .= 'MySQL ERROR: ' . mysql_error(DB);
		$html .= 'MySQL ErrorNo: ' . mysql_errno(DB);
		$GLOBALS['TEMPLATE']['content'] .= $html;
	}
	}
	}
		
}

require_once(TEMPLATE_PATH . 'page.php');
?>

 