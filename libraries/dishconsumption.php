<?php
defined('_REXEC') or die('Restricted Access');

/**
 * Dish Consumption Class 
 * 
 */
 
class DishConsumption {
	private $fields;
	
	public function __construct() {
		$this->fields = array('dept_code' => '',
							  'dish_code' => '',
							  'date' => '',
							  'prepared' => '',
							  'wastage' => '',
							  'wastage_description' => '');	
	}
	
	public function __get($field) {
		return $this->fields[$field];
	}
	
	public function setId($value) {
		$this->id = $value;
	}
	
	public function __set($field, $value) {
		if(array_key_exists($field, $this->fields)) {
			$this->fields[$field] = $value;
		}
	}
	
	public function save() {
		$query = sprintf('INSERT INTO dish_consumption_tbl(dept_code, dish_code, date, wastage, ' . 
						  'wastage_description, prepared)' . 
							 ' VALUES (%d,%d,"%s",%d,"%s",%d)', 
							 mysql_real_escape_string($this->dept_code,DB), 
							 mysql_real_escape_string($this->dish_code,DB),
							 mysql_real_escape_string($this->date,DB), 
							 mysql_real_escape_string($this->wastage,DB), 
							 mysql_real_escape_string($this->wastage_description,DB), 
							 mysql_real_escape_string($this->prepared,DB));
							echo $query;
		if(mysql_query($query)) 
			return true;
		else 
			return false;

	}	
	
	public static function getByDate($date,$dept_code) {
		$dishc = array();
		$date = $date == -1 ? date('Y-m-d') : $date; 
		$query = sprintf('SELECT * from dish_consumption_tbl WHERE date="%s" and dept_code=%d', $date, $dept_code);
		$result = mysql_query($query);
		
		$i = 0;
		while($row = mysql_fetch_assoc($result)) {
			$dishc[$i] = new DishConsumption();
			$dishc[$i]->dept_code = $row['dept_code'];
			$dishc[$i]->dish_code = $row['dish_code'];
			$dishc[$i]->date = $row['date'];
			$dishc[$i]->wastage = $row['wastage'];
			$dishc[$i]->wastage_description = $row['wastage_description'];
			$dishc[$i]->prepared = $row['prepared'];
			$i++;
		}
		
		return $dishc;
	}
	
	public static function check($date,$dept_code) {
		$query = sprintf('SELECT * from dish_consumption_tbl WHERE date="%s" and dept_code=%d', $date, $dept_code);
		$result = mysql_query($query);		
		
		if(mysql_num_rows($result) > 0 )
			return true;
		else
			return false;
	}
} 



?>