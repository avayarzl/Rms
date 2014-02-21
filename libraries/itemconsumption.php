<?php
defined('_REXEC') or die('Restricted Access');

/**
 * Item Consumption Class 
 * 
 */
 
class ItemConsumption {
	private $fields;
	
	public function __construct() {
		$this->fields = array('dept_code' => '',
							  'item_code' => '',
							  'date' => '',
							  'consumption' => '',
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
		$query = sprintf('INSERT INTO item_consumption_tbl(dept_code, item_code, date, wastage, ' . 
						  'wastage_description, consumption)' . 
							 ' VALUES (%d,%d,"%s",%d,"%s",%d)', 
							 mysql_real_escape_string($this->dept_code,DB), 
							 mysql_real_escape_string($this->item_code,DB),
							 mysql_real_escape_string($this->date,DB), 
							 mysql_real_escape_string($this->wastage,DB), 
							 mysql_real_escape_string($this->wastage_description,DB), 
							 mysql_real_escape_string($this->consumption,DB));
		if(mysql_query($query)) 
			return true;
		else 
			return false;

	}	
	
	public static function getByDate($date,$dept_code) {
		$itemc = array();
		$date = $date == -1 ? date('Y-m-d') : $date; 
		$query = sprintf('SELECT * from item_consumption_tbl WHERE date="%s" and dept_code=%d', $date,$dept_code);
		

		
		$result = mysql_query($query);
		
		$i = 0;
		while($row = mysql_fetch_assoc($result)) {
			$itemc[$i] = new ItemConsumption();
			$itemc[$i]->dept_code = $row['dept_code'];
			$itemc[$i]->item_code = $row['item_code'];
			$itemc[$i]->date = $row['date'];
			$itemc[$i]->wastage = $row['wastage'];
			$itemc[$i]->wastage_description = $row['wastage_description'];
			$itemc[$i]->consumption = $row['consumption'];
			$i++;
		}
		
		return $itemc;
	}
	
	public static function check($date,$dept_code) {
		$query = sprintf('SELECT * from item_consumption_tbl WHERE date="%s" and dept_code=%d', $date, $dept_code);
		$result = mysql_query($query);		
		
		if(mysql_num_rows($result) > 0 )
			return true;
		else
			return false;
	}
} 



?>