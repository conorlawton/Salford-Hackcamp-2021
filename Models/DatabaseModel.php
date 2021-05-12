<?php
	
	class DatabaseModel {
		protected static $_dbInstance = null;
		protected $_dbHandle;

		public static function getInstance(): DatabaseModel {
			
			if (self::$_dbInstance === null) {
				$db_host = "poseidon.salford.ac.uk";
				$db_username = "hc21-2";
				
				// The password has been changed as of 2021-05-12,
				// in time the database will be removed entirely,
				// it remains here as legacy.
				$db_password = "9mXhS1VccjTU9uo";
				$db_name = "hc21_2";
				
				self::$_dbInstance = new self($db_username, $db_password, $db_host, $db_name);
			}
			
			return self::$_dbInstance;
		}
		
		function __construct($db_username, $db_password, $db_host, $db_name) {
			$this->_dbHandle = mysqli_connect($db_host, $db_username, $db_password, $db_name);
			if (mysqli_connect_error()) {
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
