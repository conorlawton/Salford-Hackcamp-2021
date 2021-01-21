<?php



class AuditModel
{
    public int $auditID;
    public String $ip;
    public String $URL;
    public DateTime $timestamp;
    public String $request;

    function __construct($auditID, $ip, $URL, $timestamp, $request)
    {
        $this->auditID = $auditID;
        $this->ip = $ip;
        $this->URL = $URL;
        $this->timestamp = $timestamp;
        $this->request =$request;
    }

    static function FetchAllAudits() {

        $audits = [];

        $db = DatabaseModel::getInstance();

        $fetch_all = $db->getDBConnection()->prepare("SELECT auditID, INET6_NTOA(ip), URL, timestamp, request FROM audit");
        $fetch_all->bind_result($auditID, $ip, $URL, $timestamp, $request);
        $fetch_all->execute();

        while($fetch_all->fetch()){
            $new_audit_model = new AuditModel($auditID, $ip, $URL, DateTime::createFromFormat("Y-m-d H:i:s", $timestamp), $request);
            array_push($audits,$new_audit_model);
        }

        $fetch_all->close();
        return $audits;
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


}