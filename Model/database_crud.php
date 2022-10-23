<?php


/*
*Database class object for connection! 
*/
	require 'data_model.php';
	class DatabaseCrud extends Db_helper{
		function __construct(){
			self::getInstance();
		}

		/*
		* 	fuction is for inserting data in table and updating the data in table
		*	Function takes table name and takes values in associative array,
		*	and condition will having the value where we have to change and the key is for 		
		* 	retriving.. flag is for checking value is for update or insert.. 
		*
		*/
		function escape_string($data){
			if (is_array($data)) {
			foreach ($data as $key => $value) {
					$data[$key] = self::$conn->real_escape_string($value);
					error_log($data[$key]." has been escaped the character");
				}
				return $data;
			}else{
				$data = self::$conn->real_escape_string($data);
				error_log($data." has been escaped the character");
				return	$data;	
			}
		}
		function insert_and_update($table_name, $values, $flag=false, $condition=null, $key=null){
			if(!$flag){
				$str_key    =	implode(" , ",array_keys($values));
				$str_values = 	"'".implode("' , '",array_values($values))."'";
				$sql        =	"INSERT INTO `$table_name` ($str_key) VALUES ($str_values)";
				if($result = self::$conn->query($sql))	{
					error_log("Sql data insert ".$sql);
					return true;
				}
				else{
					error_log("Sql data is not inserted ".$sql);
					return false;
				}
			}	
			else{
				$str="";
				/*
				*	Creating a string for update 
				*/	
				foreach ($values as $k => $value){
					$str =	$str."$k = '".$value."'".",";
				}
				$str = 	substr( $str, 0, strlen( $str ) -1 );
				$sql =	"UPDATE `$table_name` SET $str WHERE $condition = '".$key."' "; 
				if(	$result = self::$conn->query($sql))	{
					error_log("Sql data Updated ".$sql);
					return true;
				}
				else{
					error_log("Sql data is not updated ".$sql);
					return false;
				}
			}
		}

		/*
		*	here key is condition matching paremeter where it is 	
		*	row is an array which contain name for coloum id.	
		*	column id and values is matching parameter..
		*/
		function select($table_name, $row, $key, $values){
			$str=implode(" , ",$row);
			$sql="SELECT $str from `$table_name` where $key = '".$values."'";
			if($result =self::$conn->query($sql)){
				error_log("Query for select is executed $sql");
				$result=$result->fetch_assoc();
				if($result==null) {
					return false;
				}
				return $result;	
			}
			else{
				error_log("Query for select is not executed $sql");
				return false;
			}
		}

		/*
		*	For delete one or more than one row...
		*	here key is condition matching paremeter where it is 	
		*	column id and values is matching parameter..
		*/
		function delete($table_name, $key, $values){
			$sql="DELETE from `$table_name` where $key = '".$values."'";
			if($result =self::$conn->query($sql)){
				error_log("Query for delete is executed $sql");
				return true;	
			}
			else{
				error_log("Query for delete is not executed $sql");
				return false;
			}
		}
	}
?>