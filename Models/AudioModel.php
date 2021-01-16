<?php
	
	require_once 'Core/Widget.php';
	
	class AudioModel extends Widget
	{
		public string $hash;
		public int $problem_id;
		public string $file_name;
		public DateTime $time_stamp;
		
		function __construct($hash, $problem_id, $file_name, $time_stamp)
		{
			$this->hash = $hash;
			$this->problem_id = $problem_id;
			$this->file_name = $file_name;
			$this->time_stamp = $time_stamp;
		}
		
		static function get_by_problem_id($problem_id): array
		{
			$db = DatabaseModel::getInstance();
			
			$insert_record = $db->getDBConnection()->prepare("SELECT hash, file_name, time_when_added FROM phone_recording WHERE problem_id = ?;");
			$insert_record->bind_param("i", $problem_id);
			$insert_record->bind_result($hash, $file_name, $time_stamp);
			
			$insert_record->execute();
			
			$results = [];
			
			while ($insert_record->fetch())
			{
				array_push($results, new AudioModel($hash, $file_name, $problem_id, DateTime::createFromFormat("Y-m-d H:i:s", $time_stamp)));
			}
			
			$insert_record->close();
			return $results;
		}
		
		function insert_this_into_db(): void
		{
			AudioModel::insert_record_into_db($this->hash, $this->problem_id, $this->file_name);
		}
		
		static function insert_record_into_db($hash, $problem_id, $file_name)
		{
			$db = DatabaseModel::getInstance();
			
			$insert_record = $db->getDBConnection()->prepare("INSERT INTO phone_recording (hash, problem_id, file_name) VALUES (?, ?, ?);");
			$insert_record->bind_param("sis", $hash, $problem_id, $file_name);
			$insert_record->execute();
			
			$result = $insert_record->fetch();
			$insert_record->close();
			
			return $result;
		}
		
		static function fetch_all_from_db(): array {
			$db = DatabaseModel::getInstance();
			
			$fetch_all = $db->getDBConnection()->prepare("SELECT * FROM phone_recording;");
			$fetch_all->bind_result($hash, $problem_id, $file_name, $time_stamp);
			$fetch_all->execute();
			
			/** @var AudioModel[] $audio_models */
			$audio_models = [];
			
			while($fetch_all->fetch()) {
				$new_audio_model = new AudioModel($hash, $problem_id, $file_name, DateTime::createFromFormat("Y-m-d H:i:s", $time_stamp));
				array_push($audio_models, $new_audio_model);
			}
			
			$fetch_all->close();
			
			return $audio_models;
		}
		
		static function fetch_where_corresponding_problem_active(): array {
			$db = DatabaseModel::getInstance();
			
			$fetch_where_resolved = $db->getDBConnection()->prepare("SELECT (hash, problem_id, file_name, phone_recording.time_when_added) FROM phone_recording JOIN problems ON phone_recording.problem_id = problems.id WHERE resolved = 0;");
			$fetch_where_resolved->bind_result($hash, $problem_id, $file_name, $time_stamp);
			$fetch_where_resolved->execute();
			
			/** @var AudioModel[] $audio_models */
			$audio_models = [];
			
			while($fetch_where_resolved->fetch()) {
				$new_audio_model = new AudioModel($hash, $problem_id, $file_name, DateTime::createFromFormat("Y-m-d H:i:s", $time_stamp));
				array_push($audio_models, $new_audio_model);
			}
			
			$fetch_where_resolved->close();
			
			return $audio_models;
		}
		
		static function fetch_by_id_and_active($problem_id_in): array {
			$db = DatabaseModel::getInstance();
			
			$fetch_where_resolved = $db->getDBConnection()->prepare("SELECT hash, problem_id, file_name, phone_recording.time_when_added FROM phone_recording JOIN problems ON phone_recording.problem_id = problems.id WHERE resolved = 0 AND problems.id = ?;");
			$fetch_where_resolved->bind_result($hash, $problem_id, $file_name, $time_stamp);
			$fetch_where_resolved->bind_param("i", $problem_id_in);
			$fetch_where_resolved->execute();
			
			/** @var AudioModel[] $audio_models */
			$audio_models = [];
			
			while($fetch_where_resolved->fetch()) {
				$new_audio_model = new AudioModel($hash, $problem_id, $file_name, DateTime::createFromFormat("Y-m-d H:i:s", $time_stamp));
				array_push($audio_models, $new_audio_model);
			}
			
			$fetch_where_resolved->close();
			
			return $audio_models;
			
		}
		
		public function display(): void
		{
			$audio_model = $this;
			$file_name_exploded = explode(".", $this->file_name);
			$file_extension = end($file_name_exploded);
			$path = "/UserData/" . $this->hash  . "." . $file_extension;
			$file_exists = file_exists($_SERVER["DOCUMENT_ROOT"] . $path);
			require $_SERVER["DOCUMENT_ROOT"] . "/Views/Templates/AudioModelView.phtml";
		}
	}