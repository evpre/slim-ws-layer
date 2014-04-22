<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jonny
 * Date: 05/06/13
 * Time: 16:27
 * To change this template use File | Settings | File Templates.
 */

require_once dirname(__FILE__).'/../lib/Slim/Slim.php';

use Slim\Slim;
Slim::registerAutoloader();

abstract class BaseWSService {

    public $app;
    public $response;
    public $request;
    public $serviceAdapter;

    public function __construct(){
        $this->app = new \Slim\Slim();
        $this->response = $this->app->response();
        $this->request = $this->app->request();
        $this->serviceAdapter = $this->getServiceAdapter();
        $this->initAdapter();
        $this->app->run();
    }

    abstract function getServiceAdapter();

    abstract function initAdapter();

    public function getBody($serviceAdapter, $method=null, $params=null)
    {
        return $serviceAdapter->{$method}($params);
    }

    public function parseUrlEncoded($doubleURLed)
    {
        return urldecode($doubleURLed);
    }

}
