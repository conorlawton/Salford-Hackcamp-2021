<?php



class AuditModel
{
    public int $auditID;
    public int $userID;
    public int $problemID;
    public DateTime $date;
    public string $message;

    function __construct($auditID, $userID, $problemID, $date, $message)
    {
        $this->auditID = $auditID;
        $this->userID = $userID;
        $this->problemID = $problemID;
        $this->date = $date;
        $this->message =$message;
    }

    static function FetchAllAudits() {

        $audits = [];

        $db = DatabaseModel::getInstance();

        $fetch_all = $db->getDBConnection()->prepare("SELECT * FROM audit");
        $fetch_all->bind_result($auditID, $userID, $problemID, $date, $message);
        $fetch_all->execute();

        while($fetch_all->fetch()){
            $new_audit_model = new AuditModel($auditID, $userID, $problemID, $date, $message);
            array_push($audits,$new_audit_model);
        }

        $fetch_all->close();
        return $audits;
    }
}