<?php
require_once('global.php');	
$GLOBALS['TEMPLATE']['content'] .= '<h3>Modify Department Record</h3>';
if(isset($_POST['deptId'])) 
	$dept_id = $_POST['deptId'];
else if(isset($_GET['deptId'])) 
	$dept_id = $_GET['deptId'];
else 
	$dept_id = 0;
	
if($dept_id != 0)
	$dept = Department::getById($dept_id);

ob_start();
?>
<FORM METHOD="get" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<P>Select Department Name: <SELECT NAME="deptId"> <?php 
$_GET['option_data'] = true;
require_once('ajax'.DS.'dept_list.php');
?></SELECT> <INPUT TYPE="submit" NAME="dSubmit" VALUE="Go"></P>
</FORM>
<?php 
if($dept_id != 0) {
?>
<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <TABLE>
 
    <TR> 
      <TD> <LABEL>Department Name</LABEL></TD>
      <TD> <INPUT TYPE="text" NAME="dept_name" SIZE="20" VALUE="<?php echo $dept->name ?>"/> </TD>
    </TR>
    <TR> 
      <TD> <LABEL>Department Code</LABEL></TD>
      <TD> <INPUT TYPE="text" NAME="dept_code" SIZE="20" VALUE="<?php echo $dept->deptId ?>" DISABLED="disabled"/> </TD>
    </TR>
    <TR> 
      <TD> <LABEL>Department Head</LABEL></TD>
      <TD><INPUT TYPE="text" NAME="dept_head" SIZE="20" VALUE="<?php echo $dept->head ?>"/></TD>
    </TR>
    <TR ALIGN="CENTER"> 
      <TD COLSPAN=2> 
        <INPUT TYPE="SUBMIT" NAME="submit" VALUE="Update"> 
        <INPUT NAME="delete" TYPE="SUBMIT" VALUE="Delete Record"> 
      <INPUT TYPE="hidden" NAME="deptId" VALUE="<?php echo $dept->deptId; ?>">
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
		
		$dept_name = new Validator('Department Name', $_POST['dept_name'],'EMPTY|STRING');
	$dept_head = new Validator('Department Head',$_POST['dept_head'],'EMPTY|STRING');
			
		if(Validator::isError()) { 
			$html = "<div id='error'>The following errors occured.Press the browser BACK button to fix them.";
			ob_start();
			 echo Validator::displayErrors();
			$html1 = ob_get_clean();
			$html .= $html1 . '</div>';
			$GLOBALS['TEMPLATE']['content'] .= $html;
		}
		else {
			$dept->name = $dept_name->getValue();
			$dept->head = $dept_head->getValue();
			if($dept->save()) {
				$html = '<p>The New Department Record was successfully modified.</p>';
				
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
	else {

		if(Department::deleteById($dept_id)) {
			$html = "<p>The Department Record was deleted.</p>";
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

 