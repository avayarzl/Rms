<?php
require_once("global.php");	
$GLOBALS['TEMPLATE']['content'] .= '<h3>Add New User Account</h3>';
ob_start();
?>

<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <TABLE>
    <TR> 
      <TD> <LABEL>Username</LABEL> </TD>
      <TD> <INPUT NAME="username" TYPE="text" ID="username" SIZE="20" MAXLENGTH="20" /> </TD>
    </TR>
    <TR> 
      <TD> <LABEL>Password</LABEL> </TD>
      <TD> <INPUT NAME="password" TYPE="PASSWORD" ID="password" SIZE="20" MAXLENGTH="20" /> </TD>
    </TR>
    <TR> 
      <TD> <LABEL>Permission Level</LABEL></TD>
      <TD> <SELECT NAME="permission_lvl" ID="permission_lvl">
          <OPTION>Management</OPTION>
          <OPTION>Ordinary</OPTION>
        </SELECT></TD>
    </TR>
    <TR> 
      <TD> <LABEL>Real Name</LABEL></TD>
      <TD> <INPUT NAME="real_name" TYPE="text" ID="real_name" SIZE="20" MAXLENGTH="75" /> </TD>
    </TR>
    <TR> 
      <TD COLSPAN=2 ALIGN=CENTER> <INPUT TYPE="submit" NAME="submit" VALUE="Add User">
        <INPUT TYPE="RESET" NAME="Reset" VALUE="Clear"> </TD>
    </TR>
  </TABLE>
</FORM>

<?php

$form = ob_get_clean();


if(!isset($_POST['submit'])) {
	$GLOBALS['TEMPLATE']['content'] .= $form;
}
else {
	$username = new Validator('Username',$_POST['username']);
	$password = new Validator('Password',$_POST['password']);
	$permission_lvl = new Validator('Permission Level',$_POST['permission_lvl']);
	$real_name = new Validator('Real Name',$_POST['real_name']);
	
	if(Validator::isError()) { 
		$html = "<div id='error'>The following errors occured.Press the browser BACK button to fix them.<br>";
		ob_start();
		echo Validator::displayErrors();
		$html1 = ob_get_clean();
		$html .= $html1 . '</div>';
		$GLOBALS['TEMPLATE']['content'] .= $html;
	} 
	else {

	$user = new User();
	$user->username = $username->getValue();
	$user->password = $password->getValue();
	$user->permission_lvl = $permission_lvl->getValue();
	$user->real_name = $real_name->getValue();
	
	if(User::checkUsername($user->username)) {
		$GLOBALS['TEMPLATE']['content'] .= "<p>The username {$username} already exists. Try another one!";
		$GLOBALS['TEMPLATE']['content'] .= $form;
	} else {
	if($user->save()) {
		$GLOBALS['TEMPLATE']['content'] .= "<p>The New User Record({$user->username}) was successfully updated.</p>";
	}
	else {
		$html = '<p>There was some error while inserting the records.</p>';
		$html .= 'MySQL ERROR: ' . mysql_error(DB);
		$html .= 'MySQL ErrorNo: ' . mysql_errno(DB);
		$GLOBALS['TEMPLATE']['content'] = $html;
	}
	}
	}
		
}

require_once(TEMPLATE_PATH . 'page.php');
?>

 