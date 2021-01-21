<?php
	// phpinfo();
	
	require_once "Models/DatabaseModel.php";
	
	ini_set('display_error', 1);
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
	$db = DatabaseModel::getInstance()->getDBConnection();
	
	$log_request = $db->prepare("INSERT INTO audit (ip, URL, request) SELECT INET6_ATON(?),?,?;");
	$log_request->bind_param("sss", $_SERVER['REMOTE_ADDR'], $_SERVER["REQUEST_URI"], $_SERVER['REQUEST_METHOD']);
	$log_request->execute();
	$log_request->close();
	
	
	// Check if the request URI matches a file ending in any of:
	if (preg_match('/\.(?:php|png|jpg|jpeg|gif|ico|css|js|mp3|ogg|wav)\??.*$/',
		$_SERVER["REQUEST_URI"]))
	{
		return false; // Serve the requested resource as-is.
	}
	
	require_once "Controllers/IndexController.php";
	require_once "Core/ControllerBase.php";
	
	// ALL $_SERVER["PATH_INFO"] MUST BE $_SERVER["REQUEST_URI"] WHEN ON POSEIDON
	
	// First break the url request down and split it by "/"
	$url = isset($_SERVER["PATH_INFO"]) ? explode("/", ltrim($_SERVER["PATH_INFO"], "/")) : "/";
	
	// Begin the session in the router so that it doesn't need to start anywhere else.
	session_start();
	/*
	if (!isset($_SESSION["new_comments_check"])) {
		$_SESSION["new_comments_check"] = [];
	}
	*/
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
                    case "AuditTrailController":
                    case "AddProblemController":
						$controller = new $controller_name($user);
						break;
                    default:
						$controller = new $controller_name;
						break;
				}
				
				//$controller->$request_action();
				
				$result = call_user_func(array($controller, $request_action));
			}
			else
			{
				// Send a 404 header and serve the 404 page.
				require_once __DIR__ . "/Controllers/Error404Controller.php";
				$error_controller = new Error404Controller();
				call_user_func(array($error_controller, $request_action));
			}
		}
	}
	else
	{
		// If the user isn't logged in, serve the Login page.
		require_once __DIR__ . "/Controllers/LoginController.php";
		
		$login_controller = new LoginController();
		call_user_func(array($login_controller, $request_action));
	}
	