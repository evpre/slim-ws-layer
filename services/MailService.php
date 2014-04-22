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
        $result = shell_exec("sh ../eamida_create_mail_user_SQL.sh $domain $userName");
        return $result;
    }


}
