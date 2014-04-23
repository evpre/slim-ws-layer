<?php
/**
 * Created by PhpStorm.
 * User: evgenypredein
 * Date: 22/04/14
 * Time: 12:31
 */

require_once dirname(__FILE__).'/../services/MailService.php';

class IRedMailAdapter {

    protected $mailService;

    function __construct(){
        $this->mailService = new MailService();
    }

    function createEmailAccount($userInfo){
        try{
            $result = $this->mailService->createEmailAccount(json_decode(urldecode($userInfo)));
            return $result;
        }
        catch (Exception $e){
            return json_encode(array("success"=>false, "data" => $e->getMessage()));
        }
    }
    function createDomain($domain){
        try{
            $result = $this->mailService->createDomain(urldecode($domain));
            return $result;
        }
        catch (Exception $e){
            return json_encode(array("success"=>false, "data" => $e->getMessage()));
        }
    }
} 