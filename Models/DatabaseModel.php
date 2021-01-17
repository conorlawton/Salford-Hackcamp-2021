<?php
	
	class DatabaseModel {
		protected static $_dbInstance = null;
		protected $_dbHandle;

		public static function getInstance(): DatabaseModel {
			$db_host = $GLOBALS["db_host"];
			$db_username = $GLOBALS["db_username"];
			$db_password = $GLOBALS["db_password"];
			$db_name = $GLOBALS["db_name"];
			
			if (self::$_dbInstance === null) {
				self::$_dbInstance = new self($db_username, $db_password, $db_host, $db_name);
			}
			
			return self::$_dbInstance;
		}
		
		function __construct($db_username, $db_password, $db_host, $db_name) {
			$this->_dbHandle = mysqli_connect($db_host, $db_username, $db_password, $db_name);
			if(mysqli_connect_error()) {
				echo mysqli_connect_error();
			}
		}
		
		public function getDBConnection() {
			return $this->_dbHandle;
		}
		
		public function __destruct() {
			$this->_dbHandle = null;
		}
	}