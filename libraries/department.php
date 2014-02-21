<?php
defined('_REXEC') or die('Restricted Access');

/**
 * Department Class
 *
 */
 
class Department {
	private $id;
	private $fields;
	
	public function __construct() {
		$this->id = null;
		$this->fields = array('name' => '',
							  'head' => '');	
	}
	
	public function __get($field) {
		if($field == 'deptId') {
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
	
	public static function getById($dept_id) {
		$department = new Department();
		$query = sprintf('SELECT dept_id,dept_name, dept_head FROM department_tbl' .
					' WHERE dept_id = %d', $dept_id);
		$result = mysql_query($query,DB);
		if(mysql_num_rows($result)) {
			$row = mysql_fetch_assoc($result);
			$department->setId($row['dept_id']);
			$department->name = $row['dept_name'];
			$department->head = $row['dept_head'];
		}
		mysql_free_result($result);
		return $department;
	}
	
	public static function deleteById($id) {
		$query = "DELETE FROM department_tbl WHERE dept_id = $id";
		if(mysql_query($query)) {
			return true;
		}
		else {
			return false;
		}
	}
	
	public static function getAllList() {
		$department = array();
		
		$query = sprintf('SELECT * FROM department_tbl');
		$result = mysql_query($query,DB);
		if(mysql_num_rows($result)) {
			$i = 0;
			while($row=mysql_fetch_assoc($result)) {
				$department[$i] = new Department();
				$department[$i]->setId($row['dept_id']);
				$department[$i]->name = $row['dept_name'];
				$department[$i]->head = $row['dept_head'];
				$i++;
			}
		}
		mysql_free_result($result);
		return $department;
	}
	public static function getNewId() {
		$query = 'SELECT max(dept_id) FROM department_tbl';
		$result = mysql_query($query);
		
		$row = mysql_fetch_row($result);
		$new_id = $row[0];
		$new_id++;
		return $new_id;
	}
	
	public function save() {
		if($this->id) {
			$query = sprintf('UPDATE department_tbl SET dept_name="%s", dept_head="%s"' .
							 ' WHERE dept_id = %d', 
							 mysql_real_escape_string($this->name, DB),
							 mysql_real_escape_string($this->head,DB),
							 $this->id);
			return mysql_query($query,DB);
		}
		else {
			$query = sprintf('INSERT INTO department_tbl(dept_name,dept_head)' . 
							 ' VALUES ("%s","%s")', 
							 mysql_real_escape_string($this->name,DB), 
							 mysql_real_escape_string($this->head,DB));
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