<?php
/**
 * Created by PhpStorm.
 * User: evgenypredein
 * Date: 23/04/14
 * Time: 10:00
 */

class MysqlAdapter {

    protected $conn;

    function openConnection(){
        $this->conn = mysqli_connect("localhost","root","root","vmail");
        if (mysqli_connect_errno()) {
            throw new Exception("Failed to connect to MySQL: " . mysqli_connect_error());
        }
    }

    function closeConnection(){
        mysqli_close($this->conn);
    }

    function createAlias($userName, $userAlias, $domain){
        return mysqli_query($this->conn,"INSERT INTO alias (address, goto, domain, created, active) VALUES ('$userName', '$userAlias','$domain', NOW(), 1)");
    }
    function createDomain($domain)
    {
        return mysqli_query($this->conn,"INSERT INTO domain (domain, created) VALUES ('$domain', NOW())");
    }

    public function existsDomain($domain)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM domain WHERE domain='$domain'");
        if($result==null || !$result){
            throw new Exception("domain does not exist");
        }
        return true;
    }

    public function notExistsDomain($domain)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM domain WHERE domain='$domain'");
        if($result){
            throw new Exception("domain already exists");
        }
        return true;
    }

} 