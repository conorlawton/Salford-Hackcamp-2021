<?php
	
	require_once __DIR__ . "/Controllers/IndexController.php";
	require_once __DIR__ . "/Core/ControllerBase.php";
	
	$url = isset($_SERVER["PATH_INFO"]) ? explode("/", ltrim($_SERVER["PATH_INFO"], "/")) : "/";
	
	// If the user token isn't set re-route to the login page,
	// Since this is a staff only page we don't need to create a "home page" for anyone else.
	
	session_start();
	if (isset($_SESSION["user"]) && $_SESSION["logged-in"])
	{
		$user = $_SESSION["user"];
		
		// Accessing the root page of the site, serve the index page.
		if ($url[0] == "/")
		{
			$index_controller = new IndexController($user);
			
			$index_controller->view();
		}
		else
		{
			$requested_controller = $url[0];
			$request_action = isset($url[1]) ? $url[1] : "";
			$request_parameters = array_slice($url, 2);
			
			// Get the path to the controller file
			$controller_path = __DIR__ . "/Controllers/" . $requested_controller . "Controller.php";
			// Check if the controller exists, otherwise serve a 404
			if (file_exists($controller_path))
			{
				// Perform some magic
				/** @noinspection PhpIncludeInspection */
				require_once $controller_path;
				$controller_name = ucfirst($requested_controller) . "Controller";
				$controller = new $controller_name();
				$controller->view();
				die();
			}
			else
			{
				header("HTTP/1.1 404 Not Found");
				require_once __DIR__ . "/404.php";
				die("404 - The file '" . $controller_path . "' does not exist");
			}
		}
	}
	else
	{
		require_once __DIR__ . "/Controllers/LoginController.php";
		
		$login_controller = new LoginController();
		$login_controller->view();
	}
	