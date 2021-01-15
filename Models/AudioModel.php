<?php
	
	
	class AudioModel
	{
		public $hash, $problem_id, $file_name;
		
		function __construct($hash, $problem_id, $file_name) {
			$this->hash = $hash;
			$this->problem_id = $problem_id;
			$this->file_name = $file_name;
		}
		
		function insert_this_into_db(): void {
			AudioModel::insert_record_into_db($this->hash, $this->problem_id, $this->file_name);
		}
		
		static function insert_record_into_db($hash, $problem_id, $file_name) {
			$db = DatabaseModel::getInstance();
			
			
			$insert_record = $db->getDBConnection()->prepare("INSERT INTO phone_recording (hash, problem_id, file_name) VALUES (?, ?, ?);");
			$insert_record->bind_param("sis", $hash,$problem_id, $file_name);
			$insert_record->execute();
			
			$result = $insert_record->fetch();
			$insert_record->close();
			
			return $result;
		}
		
		static function get_by_problem_id($problem_id) {
			$db = DatabaseModel::getInstance();
			
			$insert_record = $db->getDBConnection()->prepare("SELECT hash, file_name FROM phone_recording WHERE problem_id = ?;");
			$insert_record->bind_param("i", $problem_id);
			$insert_record->bind_result($hash, $file_name);
			
			$insert_record->execute();
			
			$results = [];
			
			while ($insert_record->fetch()) {
				array_push($results, new AudioModel($hash, $file_name, $problem_id));
			}
			
			$insert_record->close();
			return $results;
		}
	}