<?php 
	$configue = parse_ini_file('../app.ini');
	class Db_helper {
		private static $instance = null;
		protected static $conn;

		private function __construct(){
			$sn =$GLOBALS['configue']['DB_HOST'];
			$usr=$GLOBALS['configue']['DB_USERNAME'];
			$ps=$GLOBALS['configue']['DB_PASSWORD'];
			$db=$GLOBALS['configue']['DB_DATABASE'];
			error_log($GLOBALS['configue']['APP_URL'].'-----------------'.$GLOBALS['configue']['DB_USERNAME'].'---------------'.$GLOBALS['configue']['DB_PASSWORD'].'-----------'.$GLOBALS['configue']['DB_DATABASE']);
			self::$conn = new mysqli($sn,$usr,$ps,$db);
			if (self::$conn->connect_errno) {
			    error_log("Connect failed". self::$conn->connect_error);
			    exit();
			}
		}

		public static function getInstance(){

			if(self::$instance === null){
				self::$instance = new self();
			}
			return self::$instance;
		}
	}
 ?>