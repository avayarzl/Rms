<?php
defined('_REXEC') or die('Restricted Access');

/**
 * Employee Class
 * 
 */
 
class Employee {
	private $id;
	private $fields;
	
	public function __construct() {
		$this->id = null;
		$this->fields = array('name' => '',
							  'address' => '',
							  'salary' => '',
							  'telephone' => '',
							  'mobile' => '',
							  'email' => '',
							  'designation' => '',
							  'join_date' => '',
							  'salary' => '');	
	}
	
	public function __get($field) {
		if($field == 'employeeId') {
			return $this->id;
		}
		else {
			return $this->fields[$field];
		}
	}
	
	public function setId($value) {
		$this->id = $value;
	}
	
	public function __set($field, $value) {
		if(array_key_exists($field, $this->fields)) {
			$this->fields[$field] = $value;
		}
	}
	
	public static function getById($emp_id) {
		$employee = new Employee();
		$query = sprintf('SELECT emp_id,name,address, salary , telephone, mobile, email, designation,' .
										'join_date, salary FROM employee_tbl' .
										' WHERE emp_id = %d', $emp_id);
		$result = mysql_query($query,DB);
		if(mysql_num_rows($result)) {
			$row = mysql_fetch_assoc($result);
			$employee->setId($row['emp_id']);
			$employee->name = $row['name'];
			$employee->designation = $row['designation'];
			$employee->address = $row['address'];
			$employee->salary = $row['salary'];
			$employee->telephone = $row['telephone'];
			$employee->mobile = $row['mobile'];
			$employee->email = $row['email'];
			$employee->join_date = $row['join_date'];
		}
		mysql_free_result($result);
		return $employee;
	}
	
	public static function deleteById($id) {
		$query = "DELETE FROM employee_tbl WHERE emp_id = $id";
		if(mysql_query($query)) {
			return true;
		}
		else {
			return false;
		}
	}
	
	public static function getAllList() {
		$employee = array();
		
		$query = sprintf('SELECT * FROM employee_tbl');
		$result = mysql_query($query,DB);
		if(mysql_num_rows($result)) {
			$i = 0;
			while($row=mysql_fetch_assoc($result)) {
				$employee[$i] = new Employee();
				$employee[$i]->setId($row['emp_id']);
				$employee[$i]->name = $row['name'];
				$employee[$i]->designation = $row['designation'];
				$employee[$i]->address = $row['address'];
				$employee[$i]->salary = $row['salary'];
				$employee[$i]->telephone = $row['telephone'];
				$employee[$i]->mobile = $row['mobile'];
				$employee[$i]->join_date = $row['join_date'];
				$employee[$i]->email = $row['email'];
				$i++;
			}
		}
		mysql_free_result($result);
		return $employee;
	}
	
	public function save() {
		if($this->id) {
			$query = sprintf('UPDATE employee_tbl SET name="%s", designation="%s", address="%s", salary="%f"' .
							 ' , telephone="%s", mobile="%s",join_date="%s", email="%s" ' . 
							 ' WHERE emp_id = %d', 
							 mysql_real_escape_string($this->name, DB),
							 mysql_real_escape_string($this->designation,DB),
							 mysql_real_escape_string($this->address,DB),
							 mysql_real_escape_string($this->salary,DB),
							 mysql_real_escape_string($this->telephone,DB),
							 mysql_real_escape_string($this->mobile,DB),
							 mysql_real_escape_string($this->join_date,DB),
							 mysql_real_escape_string($this->email,DB),
							 $this->id);
			return mysql_query($query,DB);
		}
		else {
			$query = sprintf('INSERT INTO employee_tbl(name, designation, address, salary,telephone,mobile,join_date,email)' . 
							 ' VALUES ("%s","%s","%s",%f,"%s","%s","%s","%s")', 
							 mysql_real_escape_string($this->name,DB), 
							 mysql_real_escape_string($this->designation,DB),
							 mysql_real_escape_string($this->address,DB), 
							 mysql_real_escape_string($this->salary,DB),
							 mysql_real_escape_string($this->telephone,DB),
							 mysql_real_escape_string($this->mobile,DB),
							 mysql_real_escape_string($this->join_date,DB),
 							 mysql_real_escape_string($this->email,DB));
			if(mysql_query($query,DB)) {
				$this->id = mysql_insert_id(DB);
				return true;
			}
			else {
				return false;
			}
		}	
	}
	
} 



?>