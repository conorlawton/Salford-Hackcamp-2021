<?php
	
	
	class AssetsController
	{
		function view($file_name): void {
			$path = $_SERVER["DOCUMENT_ROOT"] . "/Assets/".$file_name;
			$contents = file_get_contents($path);
			
			$file_info = new finfo(FILEINFO_MIME);
			$mime = $file_info->buffer($contents);
			
			header("Content-type: " . $mime);
			die($contents);
		}
	}