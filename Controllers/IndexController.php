<?php
	
	require_once __DIR__ . "/../Models/UserModel.php";
	require_once __DIR__ . "/../Core/ControllerBase.php";
	require_once __DIR__ . "/../Core/ViewBase.php";
	
	class IndexController extends ControllerBase
	{
		private $user;
		
		function __construct($user)
		{
			$this->user = $user;
			$this->view = new ViewBase("Home", "/Views/IndexView.phtml");
		}
		
		function view(): void
		{
			$this->view->view();
		}
	}