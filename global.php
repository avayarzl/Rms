<?php
	session_start();
	
	define('_REXEC',1);
	
	
	require_once('config.php');
	require_once(BASE_PATH.DS.'includes'.DS.'dbsettings.php');
	
	
	if(!defined("LOGIN_PROCESS")) {
	if(!isset($_SESSION['user']) && $_SESSION['logged_in']!=true) {
		header('Location:login.php');		
	}
	}
	
	/**
	 * Loads the required class automatically 
	 * @author Prasham
	 */	
	function __autoload($class)
  	{
      $file = strtolower(str_replace('_', DS ,$class).'.php');     
      require_once(BASE_PATH.DS.'libraries'.DS.$file);
 	}
	
	/*GLOBAL DEFINATIONS */
	$menuoff = false;
	$GLOBALS['TEMPLATE']['extra_head'] .= '<script language="javascript" type="text/javascript" src="includes/js/ajbase.js"></script>';
	
	/*Month Naming Function */
	function getMonthName($month) {
		$month_name = '';
		switch($month) {
				case 1: $month_name = "January";
						break;
				case 2: $month_name = "February";
						break;
				case 3: $month_name = "March";
						break;
				case 4: $month_name = "April";
						break;
				case 5: $month_name = "May";
						break;
				case 6: $month_name = "June";
						break;
				case 7: $month_name = "July";
						break;
				case 8: $month_name = "August";
						break;
				case 9: $month_name = "September";
						break;
				case 10: $month_name = "October";
						break;
				case 11: $month_name = "November";
						break;
				case 12: $month_name = "December";
						break;
				default: $month_name = "January";
						break;		
		}
		
		return $month_name;
	}
?>