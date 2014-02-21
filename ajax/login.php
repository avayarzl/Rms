<?php
/**
 * @author Prasham
 */
 class UserLogin {
	private $username = '';
	private $password = '';
	
	public function setUserName($username) {
		$this->username = $username;
	}
	
	public function setPassword($password) {
		$this->password = md5($password);
	}
	
	public function authenticate() {
		if(empty($this->username) or empty($this->password))
			return false;
		
		$this->password = md5($this->password);
		$sql = "SELECT * FROM user_tbl WHERE username='{$this->username}' && password='{$this->password}'";
		$oResult = mysql_query($sql);
		$numrows = mysql_num_rows($oResult);
		if($numrows > 0) {
			return true;			
		} else {
			return false;		
		}
	}
}

class StreamXML {
	public function stream($str) {
		$response = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" standalone=\"yes\" ?>\n";
		$response .= '<response>';
		$response .= $str;
		$response .= '</response>';
		return $response; 
	}
}

	$sXML = new StreamXML();
	$user = new UserLogin();
	$user->setUserName($_POST['username']);
	$user->setPassword($_POST['password']);
	
	if(empty($_POST['username']) && empty($_POST['password'])) {
		$returnXML = $sXML->stream('<error>Type in the username and password field</error>');
	}
	else if(empty($_POST['username'])) {
		$returnXML = $sXML->stream('<error>Type in the username</error>');
	}
	else if(empty($_POST['password'])) {
		$returnXML = $sXML->stream('<error>Type in the password</error>');
	}
	
	if(!isset($returnXML)) {
		if(!$user->authenticate()) {
			$returnXML =  $sXML->stream('<error>The user authetication failed! Try again.</error>');
		} else {
			$returnXML = $sXML->stream('<text>You have successfully logged into the system. You will be redirected in a moment.</text>');
			$_SESSION['logged_in'] = true;
			$_SESSION['user'] = $_POST['username'];	
			$_SESSION['permission'] = User::getPermissionLevel($_POST['username']);
		}
	}
	
	if(ob_get_length() > 0 ) ob_get_clean();
	header('Content-Type:text/xml');
	echo $returnXML;
	
?>
