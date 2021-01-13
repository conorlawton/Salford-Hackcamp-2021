<?php
	
	require_once __DIR__ . '/Controllers/index_controller.php';
	require_once __DIR__ . "/Core/controller_base.php";
	
	$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'])) : '/';
	
	// If the user token isn't set re-route to the login page,
	// Since this is a staff only page we don't need to create a "home page" for anyone else.
	
	if (isset($_SESSION["user"])) {
		
		// Accessing the root page of the site, serve the index page.
		if ($url[0] == '/') {
			
			$user = $_SESSION["user"];
			
			$index_controller = new indexcontroller($user);
			
			$index_controller->view();
			
		} else {
			$requested_controller = $url[0];
			$request_action = isset($url[1]) ? $url[1] : '';
			$request_parameters = array_slice($url, 2);
			
			// Get the path to the controller file
			$controller_path = __DIR__ . "/Controllers/" . $requested_controller . "_controller.php";
			
			// Check if the controller exists, otherwise serve a 404
			if (file_exists($controller_path)) {
				
				// Perform some magic
				$controller_name = ucfirst($controller_path);
				$controller = new $controller_name();
				$controller->view();
				die();
			} else {
				header('HTTP/1.1 404 Not Found');
				require_once "404.php";
				die('404 - The file \'' . $controller_path . '\' does not exist');
			}
		}
	} else {
		require_once __DIR__ . "/Controllers/login_controller.php";
		
		$login_controller = new LoginController();
		$login_controller->view();
	}
	