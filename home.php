<?php
require_once('global.php');

$html = '<h3>WELCOME TO THE RESTAURANT MANAGEMENT SYSTEM</h3>';
$html .= '<p>Logged In as ' . $_SESSION['user'] . ' with ' . ucwords($_SESSION['permission']) . ' permission</p>'; 
if($_SESSION['permission']!='management') {
$html .= '<p>To increase your permission and management menu options, <a href="changeuser.php">log in</a> with higher permission account</p>';
}
$GLOBALS['TEMPLATE']['content'] .= $html;
                                        
require_once(TEMPLATE_PATH . 'page.php');
?>

 