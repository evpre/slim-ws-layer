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
        $userAlias = $userInfo->userAlias;

        $result = shell_exec("sh ../eamida_create_mail_user_SQL.sh $domain $userName");

        if($result){
            $con=mysqli_connect("localhost","root","root","vmail");
            if (mysqli_connect_errno()) {
                throw new Exception("Failed to connect to MySQL: " . mysqli_connect_error());
            }
            $result = mysqli_query($con,"INSERT INTO alias (address, goto, domain, created, active) VALUES ('$userName', '$userAlias','$domain', NOW(), 1)");
            mysqli_close($con);
        }

        return $result;
    }

    public function createDomain($domain)
    {
        $con=mysqli_connect("localhost","root","root","vmail");
        if (mysqli_connect_errno()) {
            throw new Exception("Failed to connect to MySQL: " . mysqli_connect_error());
        }
        $result = mysqli_query($con,"INSERT INTO domain (domain, created) VALUES ('$domain', NOW())");
        mysqli_close($con);
        return $result;
    }


}
