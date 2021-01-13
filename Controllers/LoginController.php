<?php
	
	require_once __DIR__ . "/../Models/DatabaseModel.php";
	
	class LoginController
	{
		
		private $_dbHandle;
		
		function __construct()
		{
			$this->_dbHandle = DatabaseModel::getInstance();
		}
		
		static function login_user($_email, $_password): ?UserModel
		{
			$db = DatabaseModel::getInstance();
			$login = $db->getDBConnection()->prepare("SELECT id, name, email, password FROM staff WHERE email = ? LIMIT 1");
			$login->bind_param("s", $_email);
			$login->bind_result($id, $name, $email, $password);
			$login->execute();
			
			$result = $login->fetch();
			if ($result === null)
			{
				$_SESSION["login-message"] = "Username or password is incorrect.";
				return null;
			}
			else
			{
				if ($result === false)
				{
					$_SESSION["login-message"] = "An unknown error has occurred.";
					return null;
				}
			}
			
			$login->close();
			
			if (password_verify($_password, $password))
			{
				$_SESSION["logged-in"] = true;
				return new UserModel($id, $name, $email);
			}
			else
			{
				$_SESSION["login-message"] = "Username or password is incorrect.";
				return null;
			}
		}
		
		static function logout_user()
		{
			$_SESSION["logged-in"] = false;
			$_SESSION["user"] = null;
			
			header("Location: /");
		}
		
		function view()
		{
			require_once __DIR__ . "/../Views/LoginView.phtml";
		}
	}
	
	if (isset($_POST["login"]))
	{
		$email = $_POST["email"];
		$password = $_POST["password"];
		$user = LoginController::login_user($email, $password);
		$_SESSION["user"] = $user;
		if ($_SESSION["logged-in"])
		{
			header("Location: /");
		}
		else
		{
			header("Location: /Login");
		}
	}
	else
	{
		if (isset($_POST["logout"]))
		{
			// If we are logged-in, let them log-out
			if ($_SESSION["logged-in"])
			{
				LoginController::logout_user();
				header("Location: /");
			}
			
			header("Location: /Login");
		}
	}
	
