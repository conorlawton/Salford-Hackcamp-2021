<?php

	require_once __DIR__."/../Models/database_model.php";
	
	class LoginController {
		
		private $_dbHandle;
		
		function __construct() {
			$this->_dbHandle = DatabaseModel::getInstance();
		}
		
		function view() {
			require_once __DIR__."/../Views/login_view.phtml";
		}
	}