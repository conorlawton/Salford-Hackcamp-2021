<?php
	
	require_once __DIR__ . "/../Models/UserModel.php";
	require_once __DIR__ . "/../Core/ControllerBase.php";
	
	class IndexController extends ControllerBase
	{
		private $user;
		
		function __construct($user) {
			$this->user = $user;
		}
		
		function view(): void {
			require_once __DIR__."/../Views/IndexView.phtml";
		}
	}