<?php
	class AuditModel
	{
		public int $auditID;
		public string $ip;
		public string $URL;
		public DateTime $timestamp;
		public string $request;
        public ?int $ID;
		
		function __construct($auditID, $ip, $URL, $timestamp, $request, $ID)
		{
			$this->auditID = $auditID;
			$this->ip = $ip;
			$this->URL = $URL;
			$this->timestamp = $timestamp;
			$this->request = $request;
			$this->ID = $ID;
		}
		
		static function FetchAllAudits()
		{
			
			$audits = [];
			
			$db = DatabaseModel::getInstance();
			
			$fetch_all = $db->getDBConnection()->prepare("SELECT auditID, INET6_NTOA(ip), URL, timestamp, request, staff_id FROM audit");
			$fetch_all->bind_result($auditID, $ip, $URL, $timestamp, $request, $ID);
			$fetch_all->execute();
			$fetch_all->store_result();
			
			while ($fetch_all->fetch())
			{
				$new_audit_model = new AuditModel($auditID, $ip, $URL, DateTime::createFromFormat("Y-m-d H:i:s", $timestamp), $request, $ID);
				array_push($audits, $new_audit_model);
			}
			
			$fetch_all->close();
			return $audits;
		}
		
		static function fetch_n_most_recent_with_offset($amount, $offset)
		{
			$records = [];

			$db = DatabaseModel::getInstance();
			
			$f = $db->getDBConnection()->prepare("SELECT * FROM (SELECT auditID, INET6_NTOA(ip), URL, timestamp, request, staff_id FROM audit ORDER BY timestamp DESC LIMIT ? OFFSET ?) please ORDER BY auditID DESC;");
			$f->bind_param("ii", $amount, $offset);
			$f->bind_result($auditID, $ip, $URL, $timestamp, $request, $ID);
			$f->execute();
			$f->store_result();
			
			while ($f->fetch())
			{
				$new_audit_model = new AuditModel($auditID, $ip, $URL, DateTime::createFromFormat("Y-m-d H:i:s", $timestamp), $request, $ID);
				array_push($records, $new_audit_model);
			}
			
			$f->close();
			return $records;
			
		}
		
		static function count(): int {
			$db = DatabaseModel::getInstance();
			
			$count = $db->getDBConnection()->prepare("SELECT COUNT(auditID) FROM audit;");
			$count->bind_result($value);
			$count->execute();
			$count->fetch();
			
			return $value;
		}
		
		/**
		 * @return int
		 */
		public function getAuditID(): int
		{
			return $this->auditID;
		}
		
		/**
		 * @return String
		 */
		public function getIp(): string
		{
			return $this->ip;
		}
		
		/**
		 * @return String
		 */
		public function getURL(): string
		{
			return $this->URL;
		}
		
		/**
		 * @return DateTime
		 */
		public function getTimestamp(): DateTime
		{
			return $this->timestamp;
		}
		
		/**
		 * @return String
		 */
		public function getRequest(): string
		{
			return $this->request;
		}

        public function getID(): ?int
        {
            return $this->ID;
        }
	}