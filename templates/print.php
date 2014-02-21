<?php
/**
 * @author Prasham
 * Template File
 */
defined('_REXEC') or die('Restricted Access');
 
/**
 * Headers sent so that browser doesn't cache
 */ 
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Pragma: no-cache");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?php
if (!empty($GLOBALS['TEMPLATE']['title']))
{
echo $GLOBALS['TEMPLATE']['title'];
}
?>
</title>
<link rel="stylesheet" type="text/css" href="templates/css/printstyle.css" />
<SCRIPT language="javascript" src="includes/js/jsprint.js" type="text/javascript">
</SCRIPT>
</head>

<body onLoad="printdoc();">
	
		<div id="content">
	 <?php
		if (!empty($GLOBALS['TEMPLATE']['content']))
{
echo $GLOBALS['TEMPLATE']['content'];
}
?>
<p align=center style='border-top:1px solid #000000;height:25px;background:#EFEFEF;line-height:23px;'>&copy; Ambience Restaurant and Bar | Report Generated on <?php echo date('l jS \of F Y h:i:s A');?> </p>
		</div>

		<div id="footer">
			
		</div>

                   
</body>
</html>

           