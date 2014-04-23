<?php
/**
 * Created by PhpStorm.
 * User: evgenypredein
 * Date: 22/04/14
 * Time: 15:11
 */

require_once dirname(__FILE__).'/../adapters/MysqlAdapter.php';

class MailService {

    protected $db;

    function __construct(){
        $this->db = new MysqlAdapter();
    }

    public function createEmailAccount($userInfo)
    {
        $domain = $userInfo->domain;
        $userName = $userInfo->userName;
        $userAlias = $userInfo->userAlias;

        $result = shell_exec("sh ../eamida_create_mail_user_SQL.sh $domain $userName");
        if(!$result){
            throw new Exception("shell script for user creation failed");
        }

        $this->db->openConnection();
        $result = $this->db->createAlias($userName, $userAlias, $domain);
        $this->db->closeConnection();
        return $result;
    }

    public function createDomain($domain)
    {
        $this->db->openConnection();
        $result = $this->db->createDomain($domain);
        $this->db->closeConnection();
        return $result;
    }


}
