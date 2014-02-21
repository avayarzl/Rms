<?php
defined('_REXEC') or die('Restricted Access');

/**
 * Dish Class 
 * 
 */
 
class Dish {
	private $fields;
	
	public function __construct() {
		$this->fields = array('dish_code' => '',
							  'dish_name' => '',
							  'dept_code' => '',
							  'dish_serving' => '',
							  'item_code' => '',
							  'quantity' => '',
							  'cost' => '',
							  'sale_price' => '');	
	}
	
	public function __get($field) {
		return $this->fields[$field];
	}
	
	public function __set($field, $value) {
		if(array_key_exists($field, $this->fields)) {
			$this->fields[$field] = $value;
		}
	}
	
	public static function getById($dish_code) {
		$dish = array();
		$query = sprintf('SELECT dishmas.dish_code, dishmas.dept_code, dishmas.dish_name, dishmas.sale_price, ' .
					' dishmas.serving, dishdet.item_code, dishdet.quantity, dishdet.cost' .
					' FROM dish_master_tbl as dishmas, dish_ingredients_tbl as dishdet' . 
					' WHERE dishmas.dish_code = %d and dishmas.dish_code = dishdet.dish_code', $dish_code);
		$result = mysql_query($query,DB);
		//if(mysql_num_rows($result)) {
			$i = 0;
			while($row = mysql_fetch_assoc($result)) {
				$dish[$i] = new Dish();
				$dish[$i]->dish_code = $row['dish_code'];
				$dish[$i]->dish_name = $row['dish_name'];
				$dish[$i]->dept_code = $row['dept_code'];
				$dish[$i]->dish_serving = $row['serving'];
				$dish[$i]->item_code = $row['item_code'];
				$dish[$i]->quantity = $row['quantity'];
				$dish[$i]->cost = $row['cost'];
				$dish[$i]->sale_price = $row['sale_price'];
				$i++;
			}
		//}
		//mysql_free_result($result);
		return $dish;
	}
	
	public static function getByIdDishMaster($dish_code) {
		$query = sprintf('SELECT * from dish_master_tbl where dish_code=%d',$dish_code);
		$result = mysql_query($query,DB);
		$row = mysql_fetch_assoc($result);
		$dish = new Dish();
		$dish->dish_code = $row['dish_code'];
		$dish->dish_name = $row['dish_name'];
		$dish->dish_serving = $row['serving'];
		$dish->dept_code = $row['dept_code'];
		$dish->sale_price = $row['sale_price'];
		return $dish;
		
	}
	
	public static function getDishItem($dish_code,$item_code) {
		$query = sprintf('SELECT * from dish_ingredients_tbl where dish_code=%d and item_code=%d',$dish_code,$item_code);
		$result = mysql_query($query,DB);
		$row = mysql_fetch_assoc($result);
		$dish = new Dish();
		$dish->dish_code = $row['dish_code'];
		$dish->item_code = $row['item_code'];
		$dish->quantity = $row['quantity'];
		$dish->cost = $row['cost'];
		return $dish;
		
	}
	
	public function save() {
		$query = sprintf('SELECT dish_code FROM dish_master_tbl WHERE dish_code = %s' ,
						mysql_real_escape_string($this->dish_code,DB));
		$result = mysql_query($query,DB);
		if(mysql_num_rows($result) > 0) {
			$query = sprintf('INSERT INTO dish_ingredients_tbl(dish_code, item_code, quantity, cost)' .
							' VALUES (%d,"%s",%f, %f)',
							mysql_real_escape_string($this->dish_code,DB),
							mysql_real_escape_string($this->item_code,DB),
							mysql_real_escape_string($this->quantity,DB),
							mysql_real_escape_string($this->cost,DB));
			return mysql_query($query,DB);
		}
		else {
			$query = sprintf('INSERT INTO dish_master_tbl(dish_code,serving, dish_name, sale_price, dept_code)' .
							' VALUES ("%s",%d, "%s",%f, %d)',
							mysql_real_escape_string($this->dish_code,DB),
							mysql_real_escape_string($this->dish_serving,DB),
							mysql_real_escape_string($this->dish_name, DB),
							mysql_real_escape_string($this->sale_price,DB),
							mysql_real_escape_string($this->dept_code,DB));
			if(mysql_query($query,DB)) {
				$query = sprintf('INSERT INTO dish_ingredients_tbl(dish_code, item_code, quantity, cost)' .
							' VALUES ("%s","%s",%f, %f)',
							mysql_real_escape_string($this->dish_code,DB),
							mysql_real_escape_string($this->item_code,DB),
							mysql_real_escape_string($this->quantity,DB),
							mysql_real_escape_string($this->cost,DB));
			return mysql_query($query,DB);
			} 
			else {
				return false;
			}

		}	
	}	
	
	public function update() {
		$query = sprintf('UPDATE dish_master_tbl SET serving=%d, dish_name="%s", sale_price=%f, dept_code=%d WHERE dish_code = %d' ,
							mysql_real_escape_string($this->dish_serving,DB),
							mysql_real_escape_string($this->dish_name, DB),
							mysql_real_escape_string($this->sale_price,DB),
							mysql_real_escape_string($this->dept_code,DB),
							mysql_real_escape_string($this->dish_code,DB));
			if(mysql_query($query,DB)) {
				return true;		
			} 
			else {
				return false;
			}
	}
	
	public function updateIngredient($dish_code, $item_code) {
		$query = sprintf('UPDATE dish_ingredients_tbl SET quantity=%f, cost=%f WHERE dish_code=%d and item_code=%d',
							mysql_real_escape_string($this->quantity,DB),
							mysql_real_escape_string($this->cost,DB),$dish_code, $item_code);
		return mysql_query($query,DB);
	}
	
	public static function deleteIngredient($dish_code, $item_code) {
		$query = sprintf('DELETE FROM dish_ingredients_tbl WHERE dish_code=%d and item_code=%d',
						mysql_real_escape_string($dish_code,DB),
						mysql_real_escape_string($item_code,DB));
		return mysql_query($query,DB);
	}
	
	public static function deleteDish($dish_code) {
		$query = "DELETE FROM dish_master_tbl where dish_code=$dish_code";
		if(mysql_query($query)) {
			$query = "DELETE FROM dish_ingredients_tbl where dish_code=$dish_code";
			if(mysql_query($query)) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	public static function getDishList() {
		$dish = array();
		$query = sprintf('SELECT * from dish_master_tbl');
		$result = mysql_query($query,DB);
			$i = 0;
			while($row = mysql_fetch_assoc($result)) {
				$dish[$i] = new Dish();
				$dish[$i]->dish_code = $row['dish_code'];
				$dish[$i]->dish_name = $row['dish_name'];
				$i++;
			}

		
		return $dish;
		
	}
	
	public static function getDishInfo($dish_code) {
		$query = sprintf('SELECT * from dish_master_tbl where dish_code=%d',$dish_code);
		$result = mysql_query($query,DB);
		$row = mysql_fetch_assoc($result);
		$dish = new Dish();
		$dish->dish_code = $row['dish_code'];
		$dish->dish_name = $row['dish_name'];	
		$dish->dish_serving = $row['serving'];
		$dish->dept_code = $row['dept_code'];
		return $dish;
		
	}
	
	public static function getNewId() {
		$query = 'SELECT max(dish_code) FROM dish_master_tbl';
		$result = mysql_query($query);
		
		$row = mysql_fetch_row($result);
		$new_id = $row[0];
		$new_id++;
		return $new_id;
	}

} 



?>