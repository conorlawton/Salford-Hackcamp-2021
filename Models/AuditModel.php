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

        $fetch_all = $db->getDBConnection()->prepare("SELECT id, INET6_NTOA(ip), URL, timestamp, request FROM audit");
        $fetch_all->bind_result($auditID, $ip, $URL, $timestamp, $request);
        $fetch_all->execute();

        while($fetch_all->fetch()){
            $new_audit_model = new AuditModel($auditID, $ip, $URL, $timestamp, $request);
            array_push($audits,$new_audit_model);
        }

        $fetch_all->close();
        return $audits;
    }
}