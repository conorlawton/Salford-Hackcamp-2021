<?php

	require_once __DIR__ . "/../Models/DatabaseModel.php";
	
	class LoginController {
		
		private $_dbHandle;
		
		function __construct() {
			$this->_dbHandle = DatabaseModel::getInstance();
		}
		
		function view() {
			require_once __DIR__."/../Views/login_view.phtml";
		}

		static function login_user($_email, $_password): ?UserModel {

			$db = DatabaseModel::getInstance();
			$login = $db->getDBConnection()->prepare("SELECT id, name, email, password FROM staff WHERE email = ? LIMIT 1");
			$login->bind_param("s", $_email);
			$login->bind_result($id, $name, $email, $password);
			$login->execute();

			$result = $login->fetch();
			if ($result === null) {
				$_SESSION["login-message"] = "Username or password is incorrect.";
				return null;
			} else if($result === false) {
				$_SESSION["login-message"] = "An unknown error has occurred.";
				return null;
			}
			
			$login->close();
			
			if (password_verify($_password, $password)) {
				$_SESSION["logged-in"] = true;
				return new UserModel();
			} else {
				$_SESSION["login-message"] = "Username or password is incorrect.";
				return null;
			}
		}
		
		static function logout_user() {
			$_SESSION["logged-in"] = false;
			$_SESSION["user"] = null;
			
			header("Location: /");
		}
	}

	session_start();
	if (isset($_POST["submit"])) {
		$email = $_POST["email"];
		$password = $_POST["password"];
		$user = LoginController::login_user($email, $password);
		$_SESSION["user"] = $user;
	}
	
