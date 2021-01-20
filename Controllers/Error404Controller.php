<?php
	require_once "Core/ControllerBase.php";
	require_once "Core/ViewBase.php";
	
	class Error404Controller extends ControllerBase
	{
		function __construct()
		{
			$this->view = new ViewBase("404", "/Views/Error404View.phtml");
		}
		
		function get(): void
		{
			$this->view->view();
		}
		
		function post(): void
		{
		
		}
	}