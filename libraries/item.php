<?php
defined('_REXEC') or die('Restricted Access');

/**
 * Item Class 
 * 
 */
 
class Item {
	private $id;
	private $fields;
	
	public function __construct() {
		$this->id = null;
		$this->fields = array('name' => '',
							  'stock_qty' => '',
							  'reorder_lvl' => '',
							  'm_code' => '');	
	}
	
	public function __get($field) {
		if($field == 'itemId') {
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
	
	public static function getById($item_id) {
		$item = new Item();
		$query = sprintf('SELECT * FROM item_tbl' .
					' WHERE item_id = %d', $item_id);
		$result = mysql_query($query,DB);
		if(mysql_num_rows($result)) {
			$row = mysql_fetch_assoc($result);
			$item->setId($row['item_id']);
			$item->name = $row['name'];
			$item->stock_qty = $row['stock_qty'];
			$item->reorder_lvl = $row['reorder_lvl'];
			$item->m_code = $row['m_code'];
		}
		mysql_free_result($result);
		return $item;
	}
	
	public static function getNewId() {
		$query = 'SELECT max(item_id) FROM item_tbl';
		$result = mysql_query($query);
		
		$row = mysql_fetch_row($result);
		$new_id = $row[0];
		$new_id++;
		return $new_id;
	}
	
	public static function getAllList() {
		$item = array();
		
		$query = sprintf('SELECT * FROM item_tbl');
		$result = mysql_query($query,DB);
		if(mysql_num_rows($result)) {
			$i = 0;
			while($row=mysql_fetch_assoc($result)) {
				$item[$i] = new Item();
				$item[$i]->setId($row['item_id']);
				$item[$i]->name = $row['name'];
				$item[$i]->stock_qty = $row['stock_qty'];
				$item[$i]->reorder_lvl = $row['reorder_lvl'];
				$item[$i]->m_code = $row['m_code'];
				$i++;
			}
		}
		mysql_free_result($result);
		return $item;
	}
	
	public static function increaseQty($item_code, $quantity) {
		$query = "SELECT stock_qty FROM item_tbl where item_id=$item_code";
		$result = mysql_query($query);
		
		$row = mysql_fetch_row($result);
		$stock = $row[0];
		
		echo $stock;
		
		$stock += $quantity;
		
		$query = "UPDATE item_tbl SET stock_qty=$stock WHERE item_id=$item_code";
		$result = mysql_query($query);
		
		
	}
	
	public static function decreaseQty($item_code, $quantity) {
		$query = "SELECT stock_qty FROM item_tbl where item_id=$item_code";
		$result = mysql_query($query);
		
		$row = mysql_fetch_row($result);
		$stock = $row[0];
		
		$stock -= $quantity;
		
		$query = "UPDATE item_tbl SET stock_qty=$stock WHERE item_id=$item_code";
		$result = mysql_query($query);
		
		
	}
	public function save() {
		if($this->id) {
			$query = sprintf('UPDATE item_tbl SET name="%s", stock_qty=%f, reorder_lvl=%f, m_code="%s"' .
							 ' WHERE item_id = %d', 
							 mysql_real_escape_string($this->name, DB),
							 mysql_real_escape_string($this->stock_qty,DB),
							 mysql_real_escape_string($this->reorder_lvl,DB),
							 mysql_real_escape_string($this->m_code,DB),
							 $this->id);
			return mysql_query($query,DB);
		}
		else {
			$query = sprintf('INSERT INTO item_tbl(name, stock_qty, reorder_lvl, m_code)' . 
							 ' VALUES ("%s",%f,%f,"%s")', 
							 mysql_real_escape_string($this->name,DB), 
							 mysql_real_escape_string($this->stock_qty,DB),
							 mysql_real_escape_string($this->reorder_lvl,DB), 
							 mysql_real_escape_string($this->m_code,DB));
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
		$query = "DELETE FROM item_tbl WHERE item_id = $id";
		if(mysql_query($query)) {
			return true;
		}
		else {
			return false;
		}
	}
} 



?>