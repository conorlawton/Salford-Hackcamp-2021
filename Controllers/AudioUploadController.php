<?php
	
	require_once __DIR__ . "/../Core/ControllerBase.php";
	require_once __DIR__ . "/../Core/ViewBase.php";
	
	class AudioUploadController extends ControllerBase
	{
		function __construct() {
			$this->view = new ViewBase("", "/Views/UploadAudioView.phtml");
		}
		
		function get(): void {
			$this->view->view();
		}
		
		static function upload_audio_file(): AudioModel {
			if (isset($_POST["submit"])) {
				
				$file = $_FILES["file-upload"];
				
				if (!empty($file["error"])) {
					$_SESSION["file-upload-message"] = $file["error"];
					header("Location: AudioUpload");
				}
				
				$accepted_extensions = array("mp3, ogg, wav");
				
				$file_name = $file["name"];
				
				$file_name_exploded = explode(".", $file_name);
				
				$file_extension = strtolower(end($file_name_exploded));
				
				if (in_array($file_extension, $accepted_extensions) === false) {
					$_SESSION["file-upload-message"] = $file["error"];
					header("Location: AudioUpload");
				}
				
				$target_directory = "/User Data/";
				$file_name = hash("md5", $file_name . time());
				move_uploaded_file($file["tmp_name"], $target_directory . $file_name);
				$_SESSION["file-upload-message"] = "File successfully updated.";
			}
		}
			}
	