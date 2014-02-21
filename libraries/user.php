<?php
defined('_REXEC') or die('Restricted Access');

/**
 * User Class
 */
 
class User {
	private $fields;
	
	public function __construct() {
		$this->fields = array('username' => '',
							  'password' => '',
							  'real_name' => '',
							  'permission' => '',
							  'id' => '');	
	}
	
	public function __get($field) {
		return $this->fields[$field];

	}
	
	public function __set($field, $value) {
		if(array_key_exists($field, $this->fields)) {
			$this->fields[$field] = $value;
		}
	}
	
	public static function login($username, $password) {
		$query = sprintf('SELECT * FROM user_tbl WHERE username="%s" and password=PASSWORD("%s")',$username, $password);
		$result = mysql_query($query,DB);
		if(mysql_num_rows($result) > 0) {
			return true;
		} else {
			return false;
		}
		
	}
	
	public static function getPermissionLevel($username) {
		$query = sprintf('SELECT * FROM user_tbl WHERE username="%s"',$username);
		$result = mysql_query($query,DB);
		if(mysql_num_rows($result) > 0) {
			$row = mysql_fetch_assoc($result);
			$p =  $row['permission'];
			if($p=='m')
				return 'management';
			else	
				return 'ordinary';
		}
	}
	
	public static function getAllList() {
		$u = array();
		
		$query = sprintf('SELECT * FROM user_tbl');
		$result = mysql_query($query,DB);
		if(mysql_num_rows($result)) {
			$i = 0;
			while($row=mysql_fetch_assoc($result)) {
				$u[$i] = new User();
				$u[$i]->username = $row['username'];
				$u[$i]->real_name = $row['real_name'];
				$u[$i]->permission = $row['permission'];
				$u[$i]->id = $row['id'];
				$i++;
			}
		}
		mysql_free_result($result);
		return $u;
	}
	
	
	public static function deleteById($id) {
		$query = sprintf('DELETE FROM user_tbl where id = %d',$id);
		if(mysql_query($query,DB)) {
			return true;
		}	
		else {
			return false;
		}
	}	
	
	public function save() {
		$query = sprintf('INSERT INTO user_tbl(username,password,real_name,permission )' . 
							 ' VALUES ("%s","%s","%s","%s")', 
							 mysql_real_escape_string($this->username,DB), 
							 md5($this->password,DB),
							 mysql_real_escape_string($this->real_name,DB), 
							 mysql_real_escape_string($this->permission,DB));
		if(mysql_query($query)) 
			return true;
		else 
			return false;

	}	
	
	public static function checkUsername($username) {
		$query = sprintf('SELECT * from user_tbl WHERE username="%s"',$username);
		$result = mysql_query($query);
		
		if(mysql_num_rows($result)) {
			return true;
		}
		else {
			return false;
		}
	}
	
	public static function changePassword($username, $password) {
			$query = sprintf('UPDATE user_tbl SET password=PASSWORD("%s") WHERE username="%s"',
						mysql_real_escape_string($password,DB),
						$username);
			if(mysql_query($query)) {
				return true;
			} else {
				return false;
			}

	}
	
	public static function checkOldPassword($username, $password) {
		$query = sprintf('SELECT * FROM user_tbl WHERE username="%s" and password=PASSWORD("%s")',
						 mysql_real_escape_string($username,DB),
						 mysql_real_escape_string($password,DB));
		$result = mysql_query($query);
		
		if(mysql_num_rows($result) > 0) 
			return true;
		else 
			return false;
	}
	public function update($id) {
		$query = sprintf('UPDATE user_tbl SET password=PASSWORD("%s"),real_name="%s",permission="%s" ' .
						 ' WHERE id=%d', 
							 mysql_real_escape_string($this->password,DB),
							 mysql_real_escape_string($this->real_name,DB), 
							 mysql_real_escape_string($this->permission,DB),
							 mysql_real_escape_string($id));
		if(mysql_query($query)) 
			return true;
		else 
			return false;

	}	
} 



?>