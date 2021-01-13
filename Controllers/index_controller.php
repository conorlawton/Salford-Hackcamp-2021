<?php
	
	require_once __DIR__."/../Models/user_model.php";
	require_once __DIR__."/../Core/controller_base.php";
	
	class IndexController extends ControllerBase
	{
		private $user;
		
		function __construct($user) {
			$this->user = $user;
		}
		
		function view(): void {
			require_once __DIR__."/../Views/index_view.phtml";
		}
	}