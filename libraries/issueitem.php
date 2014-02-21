<?php
defined('_REXEC') or die('Restricted Access');

/**
 * IssueItem Class 
 * 
 */
 
class IssueItem {
	//private $id;
	private $fields;
	
	public function __construct() {
		//$this->id = null;
		$this->fields = array('issue_code' => '',
							  'dept_code' => '',
							  'issue_date' => '',
							  'item_code' => '',
							  'item_qty' => '');	
	}
	
	public function __get($field) {
		return $this->fields[$field];
	}
	
	public function __set($field, $value) {
		if(array_key_exists($field, $this->fields)) {
			$this->fields[$field] = $value;
		}
	}
	
	public static function getById($issue_code) {
		$i_item = array();
		$query = sprintf('SELECT ismas.issue_code, ismas.dept_code,ismas.issue_date,' .
					' isdet.item_code, isdet.quantity FROM issue_master_tbl as ismas, issue_details_tbl as isdet' .
					' WHERE ismas.issue_code = %d and ismas.issue_code = isdet.issue_code', $issue_code);
		$result = mysql_query($query,DB);
		//if(mysql_num_rows($result)) {
			$i = 0;
			while($row = mysql_fetch_assoc($result)) {
				$i_item[$i] = new IssueItem();
				$i_item[$i]->issue_code = $row['issue_code'];
				$i_item[$i]->dept_code = $row['dept_code'];
				$i_item[$i]->issue_date = $row['issue_date'];
				$i_item[$i]->item_code = $row['item_code'];
				$i_item[$i]->item_qty = $row['quantity'];
				$i++;
			}
		//}
		//mysql_free_result($result);
		return $i_item;
	}
	
	public static function getAllList() {
		$i_item = array();
		$query = sprintf('SELECT ismas.issue_code, ismas.dept_code,ismas.issue_date,' .
					' isdet.item_code, isdet.quantity FROM issue_master_tbl as ismas, issue_details_tbl as isdet' .
					' WHERE ismas.issue_code = isdet.issue_code order by ismas.issue_date desc');
		$result = mysql_query($query,DB);
			$i = 0;
			while($row = mysql_fetch_assoc($result)) {
				$i_item[$i] = new IssueItem();
				$i_item[$i]->issue_code = $row['issue_code'];
				$i_item[$i]->dept_code = $row['dept_code'];
				$i_item[$i]->issue_date = $row['issue_date'];
				$i_item[$i]->item_code = $row['item_code'];
				$i_item[$i]->item_qty = $row['quantity'];
				$i++;
			}

		return $i_item;
	}
	
	public static function check($date) {
		$query = sprintf('SELECT * from issue_master_tbl WHERE issue_date="%s"', $date);
		$result = mysql_query($query);		
		
		if(mysql_num_rows($result) > 0 )
			return true;
		else
			return false;
	}
	
	public static function getListByDate($date) {
		$i_item = array();
		$query = sprintf('SELECT ismas.issue_code, ismas.dept_code,ismas.issue_date,' .
					' isdet.item_code, isdet.quantity FROM issue_master_tbl as ismas, issue_details_tbl as isdet' .
					' WHERE ismas.issue_code = isdet.issue_code and ismas.issue_date = "%s" order by ismas.issue_date desc', $date);
		$result = mysql_query($query,DB);
			$i = 0;
			while($row = mysql_fetch_assoc($result)) {
				$i_item[$i] = new IssueItem();
				$i_item[$i]->issue_code = $row['issue_code'];
				$i_item[$i]->dept_code = $row['dept_code'];
				$i_item[$i]->issue_date = $row['issue_date'];
				$i_item[$i]->item_code = $row['item_code'];
				$i_item[$i]->item_qty = $row['quantity'];
				$i++;
			}

		return $i_item;
	}
		
	public function save() {
		$query = sprintf('SELECT issue_code FROM issue_master_tbl WHERE issue_code = %s' ,
						mysql_real_escape_string($this->issue_code,DB));
		$result = mysql_query($query,DB);
		if(mysql_num_rows($result) > 0) {
			$query = sprintf('INSERT INTO issue_details_tbl(issue_code, item_code, quantity)' .
							' VALUES ("%s",%d,%f)',
							mysql_real_escape_string($this->issue_code,DB),
							mysql_real_escape_string($this->item_code,DB),
							mysql_real_escape_string($this->item_qty,DB));
			 mysql_query($query,DB);
			 Item::decreaseQty($this->item_code,$this->item_qty);
			 return true;
		}
		else {
			$query = sprintf('INSERT INTO issue_master_tbl(issue_code,dept_code,issue_date)' .
							' VALUES ("%s",%d,"%s")',
							mysql_real_escape_string($this->issue_code,DB),
							mysql_real_escape_string($this->dept_code,DB),
							mysql_real_escape_string($this->issue_date,DB));
			if(mysql_query($query,DB)) {
				$query = sprintf('INSERT INTO issue_details_tbl(issue_code, item_code, quantity)' .
							' VALUES ("%s",%d,%f)',
							mysql_real_escape_string($this->issue_code,DB),
							mysql_real_escape_string($this->item_code,DB),
							mysql_real_escape_string($this->item_qty,DB));
				mysql_query($query,DB);
				Item::decreaseQty($this->item_code,$this->item_qty);
			 	return true;
			} 
			else {
				return false;
			}

		}	
	}	
	
	public static function deleteItem($issue_code, $item_code){
		$query = "DELETE from issue_details_tbl WHERE issue_code=$issue_code and item_code=$item_code";
		if(mysql_query($query)) {
			return true;
		} 
		else {
			return false;
		}
	} 
	
	public static function getNewId() {
		$query = 'SELECT max(issue_code) FROM issue_master_tbl';
		$result = mysql_query($query);
		
		$row = mysql_fetch_row($result);
		$new_id = $row[0];
		$new_id++;
		return $new_id;
	}

} 



?>