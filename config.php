<?php

//no direct access
defined('_REXEC') or die('Restricted Access');

/**
 * BASE_PATH
 * @author Prasham
 * Assigns the filesystem we are located in to BASE_PATH
 */

define('BASE_PATH',dirname(__FILE__));

/** 
 * DS
 *@author Prasham
 * Get directory separator
 */
define('DS',DIRECTORY_SEPARATOR);

/**
 * DB_USER
 * @author Prasham
 * Username for connecting to the database
 */
define('DB_USER','root');

/**
 * DB_PASSWORD
 * @author Prasham
 * Password for connecting to the database
 */
define('DB_PASSWORD','');

/**
 * DB_HOST
 * @author Prasham
 * The addresss of the host that runs database
 */
define('DB_HOST','localhost');

/**
 * DB_DATABASE
 * @author Prasham
 * The database name 
 */
define('DB_DATABASE','restaurant');

/**
 * TEMPLATE PATH
 * @author Prasham
 * The path of the template folder
 */
define('TEMPLATE_PATH',BASE_PATH.DS.'templates'.DS);

/**
 * ERROR REPORTING SETTINGS
 * @author Prasham
 * IS_ENV_DEVELOPMENT defines whether it is production(false) or development(true)
 */
define ('IS_ENV_DEVELOPMENT', true);
// configure error reporting options
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', IS_ENV_DEVELOPMENT);
ini_set('error_log', BASE_PATH.DS.'log'.DS.'phperror.log');

/**
 *
 * @author Prasham
 */
//date_default_timezone_set('Asia/Katmandu');


/**
 * Assigning default values to the $GLOBAL['TEMPLATE'] variables
 * @author Prasham
 */
	$GLOBALS['TEMPLATE']['title'] = 'Restaurant Management System';
	$GLOBALS['TEMPLATE']['extra_head'] = '';
	$GLOBALS['TEMPLATE']['content'] = '';
?>