<?php
	
	
	class AudioModel
	{
		public $id, $hash, $complaint_id;
		
		
		static function insert_record_into_db($file_name, $file_hash, $problem_id) {
			$db = DatabaseModel::getInstance();
			
			$insert_record = $db->getDBConnection()->prepare("INSERT INTO phone_recording (file_path, file_name, problem_id) VALUES (?, ?, ?);");
			$insert_record->bind_param("ssi", $file_hash,$file_name, $problem_id);
		}
	}