<?php
	
	$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO']), '/') : '/';
	
	if ($url[0] == '/') {
		
		// If the user token isn't set reroute to the login page
		if (isset($_SESSION["user"])) {
			
			require_once __DIR__.'/Controllers/IndexController.php';
			require_once __DIR__ . '/Views/IndexView.phtml';
			
			$user = $_SESSION["user"];
			
			$index_controller = new IndexController($user);
			
			print $index_controller->view();
		} else {
		
		}
		
	} else {
		$requested_controller = $url[0];
		$request_action = isset($url[1]) ? $url[1] : '';
		$request_parameters = array_slice($url, 2);
		
		$controller_path = __DIR__.'/Controllers/'.$requested_controller.'_controller.php';
		
		if (file_exists($controller_path)) {
		
		} else {
			header('HTTP/1.1 404 Not Found');
			die('404 - The file \''.$controller_path.'\' does not exist');
		}
	}
	