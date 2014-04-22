<?php
/**
 * Created by PhpStorm.
 * User: evgenypredein
 * Date: 22/04/14
 * Time: 15:11
 */

class MailService {

    public function createEmailAccount($userInfo)
    {
        $domain = $userInfo->domain;
        $userName = $userInfo->userName;
        shell_exec("/home/jonny/workspace/utils/iRedMail-0.8.6/tools/create_mail_user_SQL.sh $domain $userName");
        $result = shell_exec("/home/jonny/workspace/utils/iRedMail-0.8.6/tools/executeVmail.sh");
        return $result;
    }
}