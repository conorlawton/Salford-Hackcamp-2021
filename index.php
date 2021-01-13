<?php
	
	require_once __DIR__ . "/Controllers/IndexController.php";
	require_once __DIR__ . "/Core/ControllerBase.php";
	
	// First break the url request down and split it by "/"
	$url = isset($_SERVER["PATH_INFO"]) ? explode("/", ltrim($_SERVER["PATH_INFO"], "/")) : "/";
	
	// Begin the session in the router so that it doesn't need to start anywhere else.
	session_start();
	
	// If the user token isn't set re-route to the login page,
	// Since this is a staff only page we don't need to create a "home page" for anyone else.
	if (isset($_SESSION["user"]) && $_SESSION["logged-in"])
	{
		$user = $_SESSION["user"];
		
		// Accessing the root page of the site, serve the index page.
		if ($url[0] == "/")
		{
			// Create the IndexController, give it the user and serve the page via view().
			$index_controller = new IndexController($user);
			$index_controller->view();
		}
		else
		{
			// Get the page the user wants to access.
			$requested_controller = $url[0];
			$request_action = isset($url[1]) ? $url[1] : "";
			
			// Get the rest of the url parts.
			$request_parameters = array_slice($url, 2);
			
			// Get the path to the controller file.
			$controller_path = __DIR__ . "/Controllers/" . $requested_controller . "Controller.php";
			// Check if the controller exists, otherwise serve a 404.
			if (file_exists($controller_path))
			{
				// Perform some magic.
				/** @noinspection PhpIncludeInspection */
				
				// Require the controller given the requested page's controller.
				require_once $controller_path;
				
				// Get the controller name.
				$controller_name = ucfirst($requested_controller) . "Controller";
				
				// Construct a new controller of that type.
				$controller = new $controller_name();
				
				// Serve the controller's view.
				$controller->view();
				
				// Die.
				die();
			}
			else
			{
				// Send a 404 header and serve the 404 page.
				header("HTTP/1.1 404 Not Found");
				require_once __DIR__ . "/404.php";
				die("404 - The file '" . $controller_path . "' does not exist");
			}
		}
	}
	else
	{
		// If the user isn't logged in, serve the Login page.
		require_once __DIR__ . "/Controllers/LoginController.php";
		
		$login_controller = new LoginController();
		$login_controller->view();
	}
	