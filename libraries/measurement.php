<?php
defined('_REXEC') or die('Restricted Access');

/**
 * Measurement Class
 * 
 */
 
class Measurement {
	private $id;
	private $fields;
	
	public function __construct() {
		$this->id = null;
		$this->fields = array('code' => '',
							  'description' => '');	
	}
	
	public function __get($field) {
		if($field == 'measurementId') {
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
	
	public static function getById($m_id) {
		$m = new Measurement();
		$query = sprintf('SELECT m_code, m_description, m_id FROM measurement_tbl' .
					' WHERE m_id = %d', $m_id);
		$result = mysql_query($query,DB);
		if(mysql_num_rows($result)) {
			$row = mysql_fetch_assoc($result);
			$m->setId($row['m_id']);
			$m->code = $row['m_code'];
			$m->description = $row['m_description'];
		}
		mysql_free_result($result);
		return $m;
	}
	
	public static function getAllList() {
		$m = array();
		
		$query = sprintf('SELECT * FROM measurement_tbl');
		$result = mysql_query($query,DB);
		if(mysql_num_rows($result)) {
			$i = 0;
			while($row=mysql_fetch_assoc($result)) {
				$m[$i] = new Measurement();
				$m[$i]->setId($row['m_id']);
				$m[$i]->code = $row['m_code'];
				$m[$i]->description = $row['m_description'];
				$i++;
			}
		}
		mysql_free_result($result);
		return $m;
	}
	
	public function save() {
		if($this->id) {
			$query = sprintf('UPDATE measurement_tbl SET m_code="%s", m_description="%s"' .
							 ' WHERE m_id = %d', 
							 mysql_real_escape_string($this->code, DB),
							 mysql_real_escape_string($this->description,DB),
							 $this->id);
			return mysql_query($query,DB);
		}
		else {
			$query = sprintf('INSERT INTO measurement_tbl(m_code, m_description)' . 
							 ' VALUES ("%s","%s")', 
							 mysql_real_escape_string($this->code,DB), 
							 mysql_real_escape_string($this->description,DB));
			if(mysql_query($query,DB)) {
				$this->id = mysql_insert_id(DB);
				return true;
			}
			else {
				return false;
			}
		}	
	}	
	
	public static function deleteById($id) {
		$query = "DELETE FROM measurement_tbl WHERE m_id = $id";
		if(mysql_query($query)) {
			return true;
		}
		else {
			return false;
		}
	}
} 



?>