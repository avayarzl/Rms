<?php
require_once('global.php');	
$GLOBALS['TEMPLATE']['content'] .= '<h3>Add New Department</h3>';
ob_start();
?>
<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <TABLE>
 <TR> 
      <TD> <LABEL>Department Code</LABEL></TD>
      <TD> <?php
	  	$newid = Department::getNewId();
		echo $newid;
	  ?> </TD>
    </TR>
    <TR> 
      <TD> <LABEL>Department Name</LABEL></TD>
      <TD> <INPUT TYPE="text" NAME="dept_name" SIZE="20" /> </TD>
    </TR>
    
    <TR> 
      <TD> <LABEL>Department Head</LABEL></TD>
      <TD><INPUT TYPE="text" NAME="dept_head" SIZE="20" /></TD>
    </TR>
    <TR ALIGN="CENTER"> 
      <TD COLSPAN=2> 
        <INPUT TYPE="SUBMIT" NAME="submit" VALUE="Add Department"> <INPUT NAME="reset" TYPE="RESET" ID="reset" VALUE="Clear">
      </TD>
    </TR>
  </TABLE>
</FORM>

<?php
$form = ob_get_clean();

/*ob_start();
print '<div id="dept_list">';
$_GET['option_data'] = true;
require_once(BASE_PATH . DS. 'ajax' .DS.'dept_list.php');
print '</div>';
print '<a href="#" onClick="getDeptList();return false;">UPDATE LIST</a>';

$html_dept = ob_get_clean();

/*$GLOBALS['TEMPLATE']['extra_head'] .= '<SCRIPT src="includes/js/aj_dept.js" type="text/javascript"></SCRIPT>';*/

$html_dept = '<p><a href="viewdepartment.php">View the List of Department</a></p>';
if(!isset($_POST['submit'])) {
	$GLOBALS['TEMPLATE']['content'] .= $form;
	$GLOBALS['TEMPLATE']['content'] .= $html_dept;
}
else {
	$dept_name = new Validator('Department Name', $_POST['dept_name'],'EMPTY|STRING');
	$dept_head = new Validator('Department Head',$_POST['dept_head'],'EMPTY|STRING');
	if(Validator::isError()) { 
		$html = "<div id='error'>The following errors occured.Press the browser back button to fix them.";
		ob_start();
		 echo Validator::displayErrors();
		$html1 = ob_get_clean();
		$html .=  $html1 . '</div>';
		$GLOBALS['TEMPLATE']['content'] .= $html;
	}
	else {
	$dept = new Department();
	$dept->name = $dept_name->getValue();
	$dept->head = $dept_head->getValue();
	if($dept->save()) {
		$GLOBALS['TEMPLATE']['content'] .= '<p>The New Department Record was successfully inserted.</p>';
		$GLOBALS['TEMPLATE']['content'] .= $html_dept;
	}
	else {
		$html = '<p>There was some error while inserting the records.</p>';
		$html .= 'MySQL ERROR: ' . mysql_error(DB);
		$html .= 'MySQL ErrorNo: ' . mysql_errno(DB);
		$GLOBALS['TEMPLATE']['content'] = $html;
	}
	}
}

require_once(TEMPLATE_PATH . 'page.php');
?>

 