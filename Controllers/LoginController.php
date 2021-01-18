<?php
	
	require_once "Models/DatabaseModel.php";
	require_once "Core/ControllerBase.php";
	require_once "Core/ViewBase.php";
	
	class LoginController extends ControllerBase
	{
		
		function __construct()
		{
			$this->view = new ViewBase("Login", "/Views/LoginView.phtml");
		}
		
		function get(): void {
			$this->view->view();
		}
		
		function post(): void
		{
			// Check if the user is logging in or out.
			if (isset($_POST["login"]))
			{
				// Get the values from the post form.
				$email = $_POST["email"];
				$password = $_POST["password"];
				
				// Call the login_user method and get the user result.
				$user = LoginController::login_user($email, $password);
				
				
				// If we are logged in, reroute the user to the index page,
				// otherwise take them back to the login page on a failed login.
				if ($_SESSION["logged-in"])
				{
					// Set the user session token to the returned user.
					$_SESSION["user"] = $user;
					header("Location: /");
				}
				else
				{
					header("Location: /login");
				}
			}
			else if (isset($_POST["logout"]))
			{
				// If we are logged-in, let them log-out.
				if ($_SESSION["logged-in"])
				{
					LoginController::logout_user();
					header("Location: /");
				}
				
				header("Location: /login");
			}
		}
		
		static function login_user($_email, $_password): ?UserModel
		{
			// Get the database connection instance.
			$db = DatabaseModel::getInstance();
			
			// Prepare the SQL query, we want to get a user.
			$login = $db->getDBConnection()->prepare("SELECT id, name, email, password FROM staff WHERE email = ? LIMIT 1");
			
			// Bind the parameters and results of the query to reference variables.
			$login->bind_param("s", $_email);
			$login->bind_result($id, $name, $email, $password);
			
			// Execute the query.
			$login->execute();
			
			// Fetch the result.
			$result = $login->fetch();
			
			// If the result is null that means that no records were collected.
			if ($result === null)
			{
				// Set the login error message.
				$_SESSION["login-message"] = "Username or password is incorrect.";
				return null;
			}
			
			// If the result was false an error has occurred.
			else
			{
				if ($result === false)
				{
					// Set the login error message.
					$_SESSION["login-message"] = "An unknown error has occurred.";
					return null;
				}
			}
			
			// Close the query.
			$login->close();
			
			// Check if the password entered matches the hashed password retrieved from the database.
			if (password_verify($_password, $password))
			{
				// Set whether the user is logged-in to true.
				$_SESSION["logged-in"] = true;
				return new UserModel($id, $name, $email);
			}
			else
			{
				// Set the login error message.
				$_SESSION["login-message"] = "Username or password is incorrect.";
				return null;
			}
		}
		
		static function logout_user()
		{
			// Set logged-in to false.
			$_SESSION["logged-in"] = false;
			
			// Set the user token to null.
			$_SESSION["user"] = null;
			
			header("Location: /");
		}
	}
	
