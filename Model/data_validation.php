<?php 
	/**
	 * 
	 */
	class Validation{

		function chk_pswd($password){
			$uppercase 		= preg_match('@[A-Z]@', $password);
			$lowercase 		= preg_match('@[a-z]@', $password);
			$number    		= preg_match('@[0-9]@', $password);
			$specialChars 	= preg_match('@[^\w]@', $password);
			if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8){  
	    		return 0;
			}
			return 1;
		}

	/*
	*
	*	for Name Space removing
	*
	*/
		function name_set($str){
			error_log('propering name set');
			$str=trim($str);
			if($str!=''){
				$str = preg_replace("/[^a-zA-Z]/", "", $str);
				$str = ucfirst($str);
			}
			return $str;
		}
	/*
	*
	*	for Email validation
	*
	*/	
		function email_val($str){
			error_log('validation of email');
			if (!filter_var($str, FILTER_VALIDATE_EMAIL)){
				return 0;
			}
			return 1;
		}
	}
 ?>