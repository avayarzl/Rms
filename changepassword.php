<?php
require_once("global.php");	

ob_start();
?>
<H3>Change Password</H3>
<FORM METHOD="post" ACTION="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <TABLE>
    <TR> 
      <TD WIDTH="106"> <LABEL>Username</LABEL> </TD>
      <TD WIDTH="120"><?php echo $_SESSION['user']; ?> </TD>
    </TR>
    <TR> 
      <TD> <LABEL>Old Password</LABEL> </TD>
      <TD> <INPUT NAME="old_password" TYPE="PASSWORD" ID="old_password" MAXLENGTH="20" /> 
      </TD>
    </TR>
    <TR> 
      <TD>New Password</TD>
      <TD><INPUT NAME="new_password" TYPE="PASSWORD" ID="new_password"></TD>
    </TR>
    <TR> 
      <TD>Confirm Password</TD>
      <TD><INPUT NAME="confirm_password" TYPE="PASSWORD" ID="confirm_password"></TD>
    </TR>
    <TR> 
      <TD COLSPAN=2 ALIGN=CENTER> <INPUT TYPE="submit" NAME="submit" VALUE="Change Password"> 
        <INPUT TYPE="RESET" NAME="Reset" VALUE="Clear"> </TD>
    </TR>
  </TABLE>
</FORM>

<?php

$form = ob_get_clean();

if(!isset($_POST['submit'])) {
	$GLOBALS['TEMPLATE']['content'] = $form;
}
else {
	$old_password = $_POST['old_password'];
	$new_password = $_POST['new_password'];
	$confirm_password = $_POST['confirm_password'];
	
	if(strcasecmp($new_password,$confirm_password)!=0) {
		$error_html = '<p>The New Passwords donot match.</p>';
		$error_html .= $form; 
		$GLOBALS['TEMPLATE']['content'] .= $error_html;
	}
	else {
		if(User::checkOldPassword($_SESSION['user'],$old_password)) {
			if(User::changePassword($_SESSION['user'],$new_password)) {
					$GLOBALS['TEMPLATE']['content'] .= "<p>Password was successfully changed.</p>";
			}
			else {
				$html = '<p>There was some error while inserting the records.</p>';
				$html .= 'MySQL ERROR: ' . mysql_error(DB);
				$html .= 'MySQL ErrorNo: ' . mysql_errno(DB);
				$GLOBALS['TEMPLATE']['content'] .= $html;
			}
		} else {
			$GLOBALS['TEMPLATE']['content'] .= '<p>The old password doesn\'t match.</p>' . $form;
		}
	}	
}

require_once(TEMPLATE_PATH . 'page.php');
?>

 