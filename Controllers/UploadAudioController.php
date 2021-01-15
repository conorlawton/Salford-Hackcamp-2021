<?php
	
	require_once __DIR__ . "/../Core/ControllerBase.php";
	require_once __DIR__ . "/../Core/ViewBase.php";
	require_once __DIR__ . "/../Models/AudioModel.php";
	require_once __DIR__ . "/../Models/ProblemModel.php";
	
	class UploadAudioController extends ControllerBase
	{
		function __construct()
		{
			$this->view = new ViewBase("", "/Views/UploadAudioView.phtml");
		}
		
		function get(): void
		{
			$this->view->view();
		}
		
		function post(): void
		{
			if (isset($_POST["submit"]))
			{
				var_dump($_POST);
				$problem_id = $_POST["problem_id"];
				
				if (ProblemModel::check_if_exists($problem_id)) {
					$new_audio_file_model = UploadAudioController::upload_audio_file($problem_id);
					$new_audio_file_model->insert_this_into_db();
				} else {
					$_SESSION["file-upload-message"] = "Invalid problem ID";
				}
			}
			
			header("Location: /UploadAudio");
		}
		
		static function upload_audio_file($problem_id): ?AudioModel
		{
			$path = $_SERVER["DOCUMENT_ROOT"] . "/UserData/";
			$file = $_FILES["file"];
			
			$file_name_exploded = explode(".", $file["name"]);
			$file_extension = "." . end($file_name_exploded);
			
			$hash = hash("md5", basename($file["name"]));
			$upload_file = $path . $hash . $file_extension;
			$result = move_uploaded_file($file["tmp_name"], $upload_file);
			
			$_SESSION["file-upload-message"] = "File successfully uploaded.";
			
			return new AudioModel($hash, $problem_id, $file["name"]);
		}
	}
	