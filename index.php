<?php
	// phpinfo();
	
	//	error_reporting(-1);
	//	ini_set('display_errors', 'On');
	
	$GLOBALS["db_host"] = "poseidon.salford.ac.uk";
	$GLOBALS["db_username"] = "hc21-2";
	$GLOBALS["db_password"] = "9mXhS1VccjTU9uo";
	$GLOBALS["db_name"] = "hc21_2";
	
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
	ini_set('display_error', 1);
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
	// Check if the request URI matches a file ending in any of:
	if (preg_match('/\.(?:php|png|jpg|jpeg|gif|ico|css|js|mp3|ogg|wav)\??.*$/',
		$_SERVER["REQUEST_URI"]))
	{
		return false; // Serve the requested resource as-is.
	}
	
	
	require_once __DIR__ . "/Controllers/IndexController.php";
	require_once __DIR__ . "/Core/ControllerBase.php";
	
	// ALL $_SERVER["PATH_INFO"] MUST BE $_SERVER["REQUEST_URI"] WHEN ON POSEIDON
	
	// First break the url request down and split it by "/"
	$url = isset($_SERVER["PATH_INFO"]) ? explode("/", ltrim($_SERVER["PATH_INFO"], "/")) : "/";
	
	// Begin the session in the router so that it doesn't need to start anywhere else.
	session_start();
	
	$request_action = strtolower($_SERVER['REQUEST_METHOD']);
	
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
			$index_controller->$request_action();
		}
		else
		{
			// Get the page the user wants to access.
			$requested_controller = $url[0];
			
			// Get the rest of the url parts.
			$request_parameters = array_slice($url, 2);
			
			// Get the path to the controller file.
			$controller_path = __DIR__ . "/Controllers/" . ucfirst($requested_controller) . "Controller.php";
			
			// Check if the controller exists, otherwise serve a 404.
			if (file_exists($controller_path))
			{
				// Perform some magic
				
				// Require the controller given the requested page's controller..
				/** @noinspection PhpIncludeInspection */
				require_once $controller_path;
				
				// Get the controller name.
				$controller_name = ucfirst($requested_controller) . "Controller";
				
				switch ($controller_name)
				{
					case "AddProblemController":
						$controller = new $controller_name($user);
						break;
					default:
						$controller = new $controller_name;
						break;
				}
				
				//$controller->$request_action();
				
				$result = call_user_func(array($controller, $request_action));
				var_dump($result);
			}
			else
			{
				// Send a 404 header and serve the 404 page.
				require_once __DIR__ . "/Controllers/Error404Controller.php";
				$error_controller = new Error404Controller();
				$error_controller->$request_action();
			}
		}
	}
	else
	{
		// If the user isn't logged in, serve the Login page.
		require_once __DIR__ . "/Controllers/LoginController.php";
		
		$login_controller = new LoginController();
		$login_controller->$request_action();
	}
	