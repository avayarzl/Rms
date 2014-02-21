<?php
require_once('global.php');	
$GLOBALS['TEMPLATE']['content'] .= '<h3>Modify Measurement Record</h3>';
if(isset($_POST['mId'])) 
	$m_id = $_POST['mId'];
else if(isset($_GET['mId'])) 
	$m_id = $_GET['mId'];
else 
	$m_id = 0;
	
if($m_id != 0)
	$m = Measurement::getById($m_id);

ob_start();
?>
<FORM METHOD="get" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<P>Select Measurement Code: <SELECT NAME="mId"> <?php 
$_GET['option_data'] = true;
require_once('ajax'.DS.'measurement_list.php');
?></SELECT> <INPUT TYPE="submit" NAME="empSubmit" VALUE="Go"></P>
</FORM>
<?php 
if($m_id != 0) {
?>
<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <TABLE>
    <TR> 
      <TD WIDTH="89"> <LABEL>Code</LABEL> </TD>
      <TD WIDTH="149"> <INPUT TYPE="text" ID="code" NAME="code" SIZE="20" VALUE="<?php echo $m->code; ?>"> </TD>
    </TR>
    <TR> 
      <TD> <LABEL>Description</LABEL> </TD>
      <TD> <INPUT TYPE="text" ID="description" NAME="description" SIZE="20" VALUE="<?php echo $m->description; ?>"> </TD>
    </TR>
    <TR> 
      <TD COLSPAN=2 ALIGN=center>
      	<INPUT TYPE="hidden" NAME="mId" VALUE="<?php echo $m->measurementId; ?>">
	   <INPUT TYPE="submit" NAME="submit" VALUE="Update">
        <INPUT NAME="delete" TYPE="SUBMIT" ID="reset" VALUE="Delete Record"> 
	
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
	$code = new Validator('Measurement Code',$_POST['code'],'EMPTY|INTEGER');
	$description = new Validator('Description',$_POST['description'],'EMPTY|STRING');
	
	if(Validator::isError()) { 
		$html = "<div id='error'>The following errors occured.Press the browser BACK button to fix them.";
		ob_start();
		 echo Validator::displayErrors();
		$html1 = ob_get_clean();
		$html .= $html1 . '</div>';
		$GLOBALS['TEMPLATE']['content'] .= $html;
	}
	else {
	$m->code = $code->getValue();
	$m->description = $description->getValue();
	if(!isset($_POST['delete'])) {
		if($m->save()) {	
			$GLOBALS['TEMPLATE']['content'] .= '<p>The New Measurement Record was successfully inserted.</p>';
		}
		else {
			$html = '<p>There was some error while inserting the records.</p>';
			$html .= 'MySQL ERROR: ' . mysql_error(DB);
			$html .= 'MySQL ErrorNo: ' . mysql_errno(DB);
			$GLOBALS['TEMPLATE']['content'] = $html;
		}
	} else {
		if(Measurement::deleteById($m_id)) {
			$html = "<p>The Measurement Record was deleted.</p>";
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
}

require_once(TEMPLATE_PATH . 'page.php');
?>

 