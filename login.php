<?php
/** 
 * Login/Logout 
 * 
 * @author Prasham Ojha
 * 
 */

// PARENT FLAG
define('_EXEC', 1);
define('LOGIN_PROCESS',1);

$style = <<<EOT
<style>
div#login_info {
	width:600px;
	background-color:#4fc449;
	color:#034400;
	margin:20% auto 0;
	border:1px solid #009900;
}
a {
	color:#000000;
}
a:hover {
	text-decoration:none;
}
</style>\n
EOT;

if(isset($_GET['option']) && $_GET['option'] == "logout") {
	session_unset();
	session_destroy();
	header("Refresh:1; URL=login.php");
	echo $style;
	echo "<div id='login_info'>";
	echo "You have been logged out of the system.";
	echo "You are being redirected to the login page in 1 second.<br>";
	echo "(If you think you are not being redirected as your browser doesn't support this , " .
		" <a href='login.php'>click here</a>)";
	echo "</div>";
	die();
} 

if(isset($_SESSION['logged']) && $_SESSION['logged']==1 ) {
	header("Refresh:3; URL=index.php");
	echo $style;
	echo "<div id='login_info'>";
	echo "You are currently logged in as <strong>{$_SESSION['username']}</strong>. Log out if you want to log in with another username.<br>";
	echo "You are being redirected to the index page in 3 seconds.<br>";
	echo "(If you think you are not being redirected as your browser doesn't support this , " .
		" <a href='index.php'>click here</a>)";
	echo "</div>";
	die();
}

$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'home.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RMS Login Page</title>
<link href="templates/default/styles/login.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/oXMLHttpConn.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/login.js"></script>
</head>

<body>

<div id="container">
	<div id="login_panel">
    	<p id="login_title">RMS System Login</p>
        <p id="login_information">Enter your username and password</p>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        	<input type="hidden" id="redirect" name="redirect" value="<?php echo $redirect; ?>" />
        	<p><label for="username">Username</label><br />
            <input type="text" size="30" maxlength="50" name="username" id="username" />
            </p>
            <p><label for="password">Password</label><br />
            <input type="password" size="30" maxlength="50" name="password" id="password" />
            <p>
            <p class="submit"><input type="image" src="templates/default/images/spacer.gif" id="btn_login" /></p>
        </form>
    </div>
    
   	<div id="error_panel">
	</div>
    
    
   
</div>

</body>
</html>

