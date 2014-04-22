<?php
/**
 * Created by PhpStorm.
 * User: evgenypredein
 * Date: 22/04/14
 * Time: 12:31
 */

class IRedMailAdapter {

    function createEmailAccount($userInfo){
        $userObject = json_decode($userInfo);
        return $userInfo;
    }
} 