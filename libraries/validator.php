<?php
	
class Validator {
	private static $error = false;
	private static $message;
	private $value;
	private $fieldname;
	
	
	function __construct($fieldname, $fieldvalue, $rules = 'EMPTY') {
		$this->value = $fieldvalue;
		$this->fieldname = $fieldname;
		$this->validate($rules, $fieldvalue);
	}		
	
	function validate($rules, $value) {
	
		$rules = strtoupper($rules);
		$_rules = explode('|',$rules);
		sort($_rules);
		
		$field = $this->fieldname;
		//$value = $this->value;
		//Validation Calls
		if(in_array('EMPTY',$_rules)) {
			$_noerror = $this->checkEmpty($field, $value);
		}
				
		if(!$_noerror)
			return;
			
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
		if(in_array('EMAIL',$_rules)) {
			$_noerror = $this->checkEmail($field,$value);
		}
		
	}
	
	function checkEmpty($field,$value) {
		if(trim($value) == '') {
			self::$error = true;
			self::$message .= "<br />" . $this->fieldname . " cannot be blank!";
			return false;
		} else {
			return true;
		}
	}
	
	function checkNumeric($field,$value) {
		if(!is_numeric($value)) {
			self::$error = true;
			self::$message .= "<br />" . $this->fieldname . " contains characters other than string. It can only be of numeric characters.!";
			
			return false;
		} else {
			return true;
		}
	}
	
	function checkString($field,$value) {
		if(!is_string($value)) {
			self::$error = true;
			self::$message .= "<br />" . $this->fieldname . " contains invalid characters. It can only be of alphanumeric characters.!";
			return false;
		} else {
			return true;
		}
	}
	
	function checkInteger($field, $value) {
		if(!is_integer($value)) {
			//self::$error = true;
			//self::$message .= "<br />" . $this->fieldname . " contains decimal number. It can only be of integer nature.!";
			return true;
		} else {
			return true;
		}
	}
	
	function checkFloat($field, $value) {
            $value = (float)$value;
	if(!is_float($value)) {
			self::$error = true;
			self::$message .= "<br />" . $this->fieldname . " doesnot contain decimal number. Put a decimal value.!";
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
			self::$error = true;
			self::$message .= "<br />" . $this->fieldname . " can only contain alphabet characters. !";
			return false;
		}
	}
	
	function checkEmail($field, $value) {
		$reg = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$";
		if (!function_exists('eregi')) {
                if(ereg($reg,$value)) {
			return true;
		} else {
			self::$error = true;
			self::$message .= "<br />" . $this->fieldname . " doesnot contain a valid email address !";
			return false;
		}
	}}
	
	
	function getValue() {
		return $this->value;
	}
	
	public static function isError() {
		if(self::$error) 
			return true;
		else
			return false;
	}
	
	public static function displayErrors() {
		/*$return_msg = "";
		foreach(self::$message as $msg) {
			$return_msg .= $msg + "<br />";
		}
		
		return $return_msg; */
		
		return self::$message;
	}
			
}