<?php
	
	require_once "../Models/user_model.php";
	
	class IndexController
	{
		private $user;
		
		function __construct($user) {
			$this->user = $user;
		}
		
		function view() {
			require_once __DIR__."/../Views/index_view.phtml";
		}
	}