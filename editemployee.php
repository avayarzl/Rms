<?php
require_once("global.php");	
$GLOBALS['TEMPLATE']['content'] .= '<h3>Modify Employee Record</h3>';
if(isset($_POST['empId'])) 
	$empId = $_POST['empId']; 
else if(isset($_GET['empId']))
	$empId = $_GET['empId'] ;
else
	$empId = 0;

if($empId != 0) 
	$employee = Employee::getById($empId);

ob_start();
?>
<FORM METHOD="get" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<P>Select Employee: <SELECT NAME="empId"> <?php 
$_GET['option_data'] = true;
require_once('ajax'.DS.'employee_list.php');
?></SELECT> <INPUT TYPE="submit" NAME="empSubmit" VALUE="Go"></P>
</FORM>
<?php 
if($empId != 0) {
?>
<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

<TABLE>
	<TR>
		<TD>
			<LABEL>Employee Name</LABEL>
		</TD>
		<TD>
			<INPUT TYPE="text" ID="name" NAME="name" SIZE="20" VALUE="<?php echo $employee->name; ?>" />
		</TD>
	</TR>	
	<TR>
		<TD>
			<LABEL>Employee Address</LABEL>
		</TD>
		<TD>
			<INPUT TYPE="text" ID="address" NAME="address" SIZE="20" VALUE="<?php echo $employee->address; ?>"/>
		</TD>
	</TR>	
	<TR>
		<TD>
			<LABEL>Designation</LABEL>
		</TD>
		<TD>
			<INPUT TYPE="text" ID="designation" NAME="designation" SIZE="20" VALUE="<?php echo $employee->designation; ?>"/>
		</TD>
	</TR>	
	<TR>
		<TD>
			<LABEL>Telephone</LABEL>
		</TD>
		<TD>
			<INPUT TYPE="text" ID="telephone" NAME="telephone" SIZE="20" VALUE="<?php echo $employee->telephone; ?>" />
		</TD>
	</TR>	
	<TR>
		<TD>
			<LABEL>Mobile</LABEL>
		</TD>
		<TD>
			<INPUT TYPE="text" ID="mobile" NAME="mobile" SIZE="20" VALUE="<?php echo $employee->mobile; ?>" />
		</TD>
	</TR>	
	<TR>
		<TD>
			<LABEL>Email</LABEL>
		</TD>
		<TD>
			<INPUT TYPE="text" ID="email" NAME="email" SIZE="20" VALUE="<?php echo $employee->email; ?>" />
		</TD>
	</TR>	
	<TR>
		<TD>
			<LABEL>Salary</LABEL>
		</TD>
		<TD>
			<INPUT TYPE="text" ID="salary" NAME="salary" SIZE="20" VALUE="<?php echo $employee->salary; ?>"/>
		</TD>
	</TR>	
	<TR>
		<TD>
			<LABEL>Join Date(yy-mm-dd)</LABEL>
		</TD>
		<TD>
			<INPUT TYPE="text" ID="join_date" NAME="join_date" SIZE="20" VALUE="<?php echo $employee->join_date; ?>" />
		</TD>
	</TR>	
	<TR ALIGN="CENTER"> 
      <TD COLSPAN=2> 
	  <INPUT TYPE="hidden" NAME="empId" VALUE="<?php echo $employee->employeeId; ?>">
        <INPUT TYPE="submit" NAME="submit" VALUE="Edit Employee">
        <INPUT NAME="delete" TYPE="submit" ID="delete" VALUE="Delete Record"> </TD>
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
		
	$name = new Validator('Name',$_POST['name']);;
	$address = new Validator('Address',$_POST['address']);
	$designation = new Validator('Designation',$_POST['designation'],'EMPTY|STRING');
	$salary = new Validator('Salary',$_POST['salary']);	
	$telephone = new Validator('Telephone',$_POST['telephone'],'EMPTY|INTEGER');
	$mobile = new Validator('Mobile',$_POST['mobile'],'EMPTY|INTEGER');
	$email = new Validator('Email',$_POST['email'],'EMPTY|EMAIL');
	$join_date = new Validator('Join Date',$_POST['join_date']);
	
	
	if(Validator::isError()) { 
		$html = "<div id='error'>The following errors occured.Press the browser BACK button to fix them.";
		ob_start();
		 echo Validator::displayErrors();
		$html1 = ob_get_clean();
		$html .= $html1 . '</div>';
		$GLOBALS['TEMPLATE']['content'] .= $html;
	}
	else {

	$employee->name = $name->getValue();
	$employee->designation = $designation->getValue();
	$employee->salary = $salary->getValue();
	$employee->address = $address->getValue();
	$employee->telephone = $telephone->getValue();
	$employee->mobile = $mobile->getValue();
	$employee->email = $email->getValue();
	$employee->join_date = $join_date->getValue();
	if($employee->save()) {
			$GLOBALS['TEMPLATE']['content'] .= "<p>The Employee Record({$employee->name}) was successfully updated.</p>";
		}
		else {
			$html = '<p>There was some error while inserting the records.</p>';
			$html .= 'MySQL ERROR: ' . mysql_error(DB);
			$html .= 'MySQL ErrorNo: ' . mysql_errno(DB);
			$GLOBALS['TEMPLATE']['content'] = $html;
		}
	}
		
	} 
	else {
		if(Employee::deleteById($empId)) {
			$html = "<p>The Employee Record of  was deleted.</p>";
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

 