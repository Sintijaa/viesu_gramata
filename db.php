<?php
class DB
{
    private $host;
    private $user;
    private $pass;
    private $dbname;
    private $conn;
    function __construct()
    {
        $this->host = "LOCALHOST";
        $this->user = "skolnieks";
        $this->pass = "pQcM10ClEn3lSWy";
        $this->dbname = "viesu_gramata";
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
    }
    function insert($sql)
    {
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    function select($sql)
    {
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    function selectOne($sql)
    {
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
}
?>
 