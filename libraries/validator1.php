<?php
/** 
 * FormValidate Class
 * 
 * 
 * @author Prasham Ojha
 * 
 */
 
class Validator1 {
	private $errorList;
	var $separator = '<p>';
	var $end_separator = '</p>';
	
	function __construct() {
		$this->cleanErrorList();
	}
	
	function validate($field, $value, $rules = 'EMPTY' ) {
		$_noerror = true;
		$rules = strtoupper($rules);
		$_rules = explode('|',$rules);
		sort($_rules);
		//Validation Calls
		if(in_array('EMPTY',$_rules)) {
			$_noerror = $this->checkEmpty($field, $value);
		}
		//No point checking for further validation rules if the $value is empty
		if(!$_noerror)
			return mysql_real_escape_string($value);
			
		if(in_array('ALPHA',$_rules)) {
			$_noerror = $this->checkAlpha($field,$value);
		}
		if(in_array('FLOAT',$_rules)) {
			$_noerror = $this->checkFloat($field,$value);
		}
		if(in_array('INTEGER',$_rules)) {
			$_noerror = $this->checkInteger($field,$value);
		}
		if(in_array('NUMERIC',$_rules)) {
			$_noerror = $this->checkNumeric($field,$value);
		}
		if(in_array('STRING',$_rules)) {
			$_noerror = $this->checkString($field,$value);
		}

		return mysql_real_escape_string($value);
		
	}
	
	function isError() {
		if(sizeof($this->errorList) > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function cleanErrorList() {
		$this->errorList = array();
	}
	
	function getErrorList() {
		return $this->errorList;
	}
	
	function checkEmpty($field,$value) {
		if(trim($value) == '') {
			$this->errorList[] = "{$this->separator}<strong>$field</strong> cannot be blank. {$this->end_separator}";
			return false;
		} else {
			return true;
		}
	}
	
	function checkNumeric($field,$value) {
		if(!is_numeric($value)) {
			$this->errorList[] = "{$this->separator}<strong>$field</strong> contains characters other than string. It can only be of numeric characters. {$this->end_separator}";
			return false;
		} else {
			return true;
		}
	}
	
	function checkString($field,$value) {
		if(!is_string($value)) {
			$this->errorList[] = "{$this->separator}<strong>$field</strong> contains invalid characters. It can only be of alphanumeric characters. {$this->end_separator}";
			return false;
		} else {
			return true;
		}
	}
	
	function checkInteger($field, $value) {
		if(!is_integer($value)) {
			$this->errorList[] = "{$this->separator}<strong>$field</strong> contains decimal number. It can only be of integer nature. {$this->end_separator}";
			return false;
		} else {
			return true;
		}
	}
	
	function checkFloat($field, $value) {
	if(!is_float($value)) {
			$this->errorList[] = "{$this->separator}<strong>$field</strong> doesnot contain decimal number. Put a decimal value. {$this->end_separator}";
			return false;
		} else {
			return true;
		}
	}
	
	function checkAlpha($field, $value) {
		$reg = "/^[a-zA-z]+$/";
		if(preg_match($reg,$value)) {
			return true;
		} else {
			$this->errorList[] = "{$this->separator}<strong>$field</strong> can only contain alphabet characters. {$this->end_separator}";
			return false;
		}
	}
	
	function displayErrors() {
		$errlist = $this->getErrorList();
		$str = '<div id="form_errors">';
		foreach($errlist as $err) {
			$str .= $err;
		}
		$str .= '</div>';
		return $str;
	}
	
}


/**$fv = new FormValidate();
$age = $fv->validate('Age','er','EMPTY');

if($fv->isError()) {
	$errorList = $fv->getErrorList();
	foreach($errorList as $error) {
		echo $error;
	}
}

$eb->finish();
echo "Execution time in ms: " . $eb->display() ;

class ExecutionBenchmark {
	private $start_time;
	private $end_time;
	
	function start() {
		$this->start_time = explode(' ', microtime());
	}
	
	function finish() {
		$this->end_time = explode(' ',microtime());
	}
	
	function display() {
		$ms = (float)$this->end_time[0] - (float)$this->start_time[0];
		$sec = $this->end_time[1] - $this->start_time[1];
		return round(($sec+$ms),4);
	}
}
**/



?>
