<?php
defined('_REXEC') or die('Restricted Access');

/**
 * PurchaseItem Class 
 * 
 */
 
class PurchaseItem {
	private $fields;
	
	public function __construct() {
		$this->fields = array('pur_code' => '',
							  'pur_date' => '',
							  'item_code' => '',
							  'item_qty' => '',
							  'item_rate' => '');	
	}
	
	public function __get($field) {
		return $this->fields[$field];
	}
	
	public function __set($field, $value) {
		if(array_key_exists($field, $this->fields)) {
			$this->fields[$field] = $value;
		}
	}
	
	public static function getById($pur_code) {
		$p_item = array();
		$query = sprintf('SELECT purmas.pur_code, purmas.pur_date, purdet.item_code,purdet.quantity,purdet.rate' .
					' FROM purchase_master_tbl as purmas, purchase_details_tbl as purdet' . 
					' WHERE purmas.pur_code = %d and purmas.pur_code = purdet.pur_code', $pur_code);
		$result = mysql_query($query,DB);
		//if(mysql_num_rows($result)) {
			$i = 0;
			while($row = mysql_fetch_assoc($result)) {
				$p_item[$i] = new PurchaseItem();
				$p_item[$i]->pur_code = $row['pur_code'];
				$p_item[$i]->item_code = $row['item_code'];
				$p_item[$i]->pur_date = $row['pur_date'];
				$p_item[$i]->item_rate = $row['rate'];
				$p_item[$i]->item_qty = $row['quantity'];
				$i++;
			}
		//}
		//mysql_free_result($result);
		return $p_item;
	}
	
	public static function getAllList() {
		$p_item = array();
		$query = sprintf('SELECT purmas.pur_code, purmas.pur_date, purdet.item_code,purdet.quantity,purdet.rate' .
					' FROM purchase_master_tbl as purmas, purchase_details_tbl as purdet' . 
					' WHERE purmas.pur_code = purdet.pur_code order by purmas.pur_date desc');
		$result = mysql_query($query,DB);
		//if(mysql_num_rows($result)) {
			$i = 0;
			while($row = mysql_fetch_assoc($result)) {
				$p_item[$i] = new PurchaseItem();
				$p_item[$i]->pur_code = $row['pur_code'];
				$p_item[$i]->item_code = $row['item_code'];
				$p_item[$i]->pur_date = $row['pur_date'];
				$p_item[$i]->item_rate = $row['rate'];
				$p_item[$i]->item_qty = $row['quantity'];
				$i++;
			}
		//}
		//mysql_free_result($result);
		return $p_item;
	}
	
	public static function getListByDate($date) {
		$p_item = array();
		$query = sprintf('SELECT purmas.pur_code, purmas.pur_date, purdet.item_code,purdet.quantity,purdet.rate' .
					' FROM purchase_master_tbl as purmas, purchase_details_tbl as purdet' . 
					' WHERE purmas.pur_code = purdet.pur_code and purmas.pur_date="%s" order by purmas.pur_date desc', $date);
		$result = mysql_query($query,DB);
		//if(mysql_num_rows($result)) {
			$i = 0;
			while($row = mysql_fetch_assoc($result)) {
				$p_item[$i] = new PurchaseItem();
				$p_item[$i]->pur_code = $row['pur_code'];
				$p_item[$i]->item_code = $row['item_code'];
				$p_item[$i]->pur_date = $row['pur_date'];
				$p_item[$i]->item_rate = $row['rate'];
				$p_item[$i]->item_qty = $row['quantity'];
				$i++;
			}
		//}
		//mysql_free_result($result);
		return $p_item;
	}
	
	public static function getListByMonth($month, $year) {
		$date_begin = "$year-$month-1";
		$date_end = "$year-$month-32";
		$p_item = array();
		$query = sprintf('SELECT purmas.pur_code, purmas.pur_date, purdet.item_code,purdet.quantity,purdet.rate' .
					' FROM purchase_master_tbl as purmas, purchase_details_tbl as purdet' . 
					' WHERE purmas.pur_code = purdet.pur_code and purmas.pur_date>="%s" and purmas.pur_date<="%s" order by purmas.pur_date desc', $date_begin, $date_end);
		$result = mysql_query($query,DB);
		//if(mysql_num_rows($result)) {
			$i = 0;
			while($row = mysql_fetch_assoc($result)) {
				$p_item[$i] = new PurchaseItem();
				$p_item[$i]->pur_code = $row['pur_code'];
				$p_item[$i]->item_code = $row['item_code'];
				$p_item[$i]->pur_date = $row['pur_date'];
				$p_item[$i]->item_rate = $row['rate'];
				$p_item[$i]->item_qty = $row['quantity'];
				$i++;
			}
		//}
		//mysql_free_result($result);
		return $p_item;
	}
	
	public static function check($date) {
		$query = sprintf('SELECT * from purchase_master_tbl WHERE pur_date="%s"', $date);
		$result = mysql_query($query);		
		
		if(mysql_num_rows($result) > 0 )
			return true;
		else
			return false;
	}
	
	public static function checkMonth($month,$year) {
		$date_begin = "$year-$month-1";
		$date_end = "$year-$month-32";
		$query = sprintf('SELECT * from purchase_master_tbl WHERE pur_date>="%s" and pur_date<="%s"', $date_begin, $date_end);
		$result = mysql_query($query);		
		
		if(mysql_num_rows($result) > 0 )
			return true;
		else
			return false;
	}
	
	public function save() {
		$query = sprintf('SELECT pur_code FROM purchase_master_tbl WHERE pur_code = %s' ,
						mysql_real_escape_string($this->pur_code,DB));
		$result = mysql_query($query,DB);
		if(mysql_num_rows($result) > 0) {
			$query = sprintf('INSERT INTO purchase_details_tbl(pur_code, item_code, quantity, rate)' .
							' VALUES ("%s",%d,%f, %f)',
							mysql_real_escape_string($this->pur_code,DB),
							mysql_real_escape_string($this->item_code,DB),
							mysql_real_escape_string($this->item_qty,DB),
							mysql_real_escape_string($this->item_rate,DB));
			mysql_query($query,DB);
			Item::increaseQty($this->item_code,$this->item_qty);
			return true;
		}
		else {
			$query = sprintf('INSERT INTO purchase_master_tbl(pur_code,pur_date)' .
							' VALUES ("%s","%s")',
							mysql_real_escape_string($this->pur_code,DB),
							mysql_real_escape_string($this->pur_date,DB));
			if(mysql_query($query,DB)) {
				$query = sprintf('INSERT INTO purchase_details_tbl(pur_code, item_code, quantity, rate)' .
							' VALUES ("%s",%d,%f, %f)',
							mysql_real_escape_string($this->pur_code,DB),
							mysql_real_escape_string($this->item_code,DB),
							mysql_real_escape_string($this->item_qty,DB),
							mysql_real_escape_string($this->item_rate,DB));
				mysql_query($query,DB);
				Item::increaseQty($this->item_code,$this->item_qty);
				return true;
			} 
			else {
				return false;
			}

		}	
	}	

	public function update() {
			$query = sprintf('INSERT INTO purchase_master_tbl(pur_code,pur_date)' .
							' VALUES ("%s","%s")',
							mysql_real_escape_string($this->pur_code,DB),
							mysql_real_escape_string($this->pur_date,DB));
			if(mysql_query($query,DB)) {
				$query = sprintf('INSERT INTO purchase_details_tbl(pur_code, item_code, quantity, rate)' .
							' VALUES ("%s",%d,%f, %f)',
							mysql_real_escape_string($this->pur_code,DB),
							mysql_real_escape_string($this->item_code,DB),
							mysql_real_escape_string($this->item_qty,DB),
							mysql_real_escape_string($this->item_rate,DB));
				return mysql_query($query,DB);
			} 
			else {
				return false;
			}	
	}
	
	public static function deleteItem($purchase_code, $item_code){
		$query = "DELETE from purchase_details_tbl WHERE pur_code=$purchase_code and item_code=$item_code";
		if(mysql_query($query)) {
			return true;
		} 
		else {
			return false;
		}
	} 
	
	public static function getNewId() {
		$query = 'SELECT max(pur_code) FROM purchase_master_tbl';
		$result = mysql_query($query);
		
		$row = mysql_fetch_row($result);
		$new_id = $row[0];
		$new_id++;
		return $new_id;
	}
} 



?>