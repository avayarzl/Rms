<?php
require_once("global.php");	
$GLOBALS['TEMPLATE']['content'] .= '<h3>Add New Employee Record</h3>';
ob_start();
?>

<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <TABLE>
    <TR>
		<TD>
			<LABEL>Employee Name</LABEL>
		</TD>
		<TD>
			<INPUT TYPE="text" ID="name" NAME="name" SIZE="20" />
		</TD>
	</TR>	
	<TR> 
      <TD BGCOLOR="#CCCCCC"> 
        <LABEL>Employee Address</LABEL>
		</TD>
		
      <TD BGCOLOR="#CCCCCC"> 
        <INPUT TYPE="text" ID="address" NAME="address" SIZE="20" />
		</TD>
	</TR>	
	<TR>
		<TD>
			<LABEL>Designation</LABEL>
		</TD>
		<TD>
			<!--<select name="designation">
				<?php 
					$_GET['option_data'] = true;
					include_once(BASE_PATH.DS.'ajax'.DS.'employee_list.php');
				?>			
			</select> -->
			<INPUT TYPE="text" NAME="designation" SIZE="20" />
		</TD>
	</TR>	
	<TR BGCOLOR="#CCCCCC"> 
      <TD> 
        <LABEL>Telephone</LABEL>
      </TD>
		
      <TD> 
        <INPUT TYPE="text" ID="telephone" NAME="telephone" SIZE="20" />
      </TD>
	</TR>	
	<TR>
		<TD>
			<LABEL>Mobile</LABEL>
		</TD>
		<TD>
			<INPUT TYPE="text" ID="mobile" NAME="mobile" SIZE="20" />
		</TD>
	</TR>	
	<TR BGCOLOR="#CCCCCC"> 
      <TD> 
        <LABEL>Email</LABEL>
		</TD>
		
      <TD> 
        <INPUT TYPE="text" ID="email" NAME="email" SIZE="20" />
		</TD>
	</TR>	
	<TR>
		<TD>
			<LABEL>Salary</LABEL>
		</TD>
		<TD>
			<INPUT TYPE="text" ID="salary" NAME="salary" SIZE="20" />
		</TD>
	</TR>	
	<TR BGCOLOR="#CCCCCC"> 
      <TD HEIGHT="25"> 
        <LABEL>Join Date(yy-mm-dd)</LABEL>
		</TD>
		
      <TD> 
        <INPUT TYPE="text" ID="join_date" NAME="join_date" SIZE="20" />
		</TD>
	</TR>	
	<TR ALIGN="CENTER"> 
      <TD COLSPAN=2> 
        <INPUT TYPE="submit" NAME="submit" VALUE="Add Employee">
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
	$name = new Validator('Name',$_POST['name']);;
	$address = new Validator('Address',$_POST['address']);
	$designation = new Validator('Designation',$_POST['designation'],'EMPTY|STRING');
	$salary = new Validator('Salary',$_POST['salary']);	
	$telephone = new Validator('Telephone',$_POST['telephone'],'EMPTY|INTEGER');
	$mobile = new Validator('Mobile',$_POST['mobile'],'EMPTY|INTEGER');
	$email = new Validator('Email',$_POST['email'],'EMPTY|EMAIL');
	$join_date = new Validator('Join Date',$_POST['join_date']);
	
	if(Validator::isError()) { 
		$html = "<div id='error'>The following errors occured.Press the browser BACK button to fix them.<br>";
		ob_start();
		echo Validator::displayErrors();
		$html1 = ob_get_clean();
		$html .= $html1 . '</div>';
		$GLOBALS['TEMPLATE']['content'] .= $html;
	} 
	else {
	$employee = new Employee();
	$employee->name = $name->getValue();
	$employee->designation = $designation->getValue();
	$employee->salary = $salary->getValue();
	$employee->address = $address->getValue();
	$employee->telephone = $telephone->getValue();
	$employee->mobile = $mobile->getValue();
	$employee->email = $email->getValue();
	$employee->join_date = $join_date->getValue();
	if($employee->save()) {
		$GLOBALS['TEMPLATE']['content'] .= "<p>The Employee Record({$employee->name}) was successfully added.</p>";
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

 