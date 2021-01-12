<?php
	
	require_once "../Models/UserModel.php";
	
	class IndexController
	{
		private $user;
		
		function __construct($user) {
			$this->user = $user;
		}
		
		function view() {
		
		}
	}