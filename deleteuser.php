<?php
require_once('global.php');	

$id = $_GET['id'];

if(User::deleteById($id)) {
	header('Location:user.php');
}
else {
$GLOBALS['TEMPLATE']['content'] .= '<h3>Delete User Records</h3>';
$GLOBALS['TEMPLATE']['content'] .= '<p>There was an error while deleting the record.<a href="user.php">Click here</a> to go back to User screen and delete again.</p>';

require_once(TEMPLATE_PATH . 'page.php');
}
?>

 