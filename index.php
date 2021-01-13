<?php
	
	$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO']), '/') : '/';
	
	// If the user token isn't set re-route to the login page,
	// Since this is a staff only page we don't need to create a "home page" for anyone else.
	
	if (isset($_SESSION["user"])) {
		if ($url[0] == '/') {
			
			require_once __DIR__ . '/Controllers/index_controller.php';
			require_once __DIR__ . '/Views/index_view.phtml';
			
			$user = $_SESSION["user"];
			
			$index_controller = new indexcontroller($user);
			
			print $index_controller->view();
			
		} else {
			$requested_controller = $url[0];
			$request_action = isset($url[1]) ? $url[1] : '';
			$request_parameters = array_slice($url, 2);
			
			$controller_path = __DIR__ . '/Controllers/' . $requested_controller . '_controller.php';
			
			if (file_exists($controller_path)) {
			
			} else {
				header('HTTP/1.1 404 Not Found');
				die('404 - The file \'' . $controller_path . '\' does not exist');
			}
		}
	} else {
		require_once __DIR__."/Controllers/login_controller.php";
		
		$login_controller = new LoginController();
	}
	