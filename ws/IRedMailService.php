<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jonny
 * Date: 8/04/14
 * Time: 18:42
 * To change this template use File | Settings | File Templates.
 */

require_once dirname(__FILE__) . '/BaseWSService.php';
require_once dirname(__FILE__) . '/../adapters/IRedMailAdapter.php';

class IRedMailService extends BaseWSService {

    public function __construct() {
        parent::__construct();
    }

    public function getServiceAdapter(){
        return new IRedMailAdapter();
    }

    function initAdapter()
    {
        $res = $this->response;
        $serviceAdapter = $this->serviceAdapter;
        $req = $this->request;
        $this->app->put('/newUser/', function () use($res, $serviceAdapter, $req) {
            $res->header('Content-Type', 'application/json');
            $body = $req->getBody();
            $result = $serviceAdapter->createEmailAccount($body);
            $res->body($result);
        });
        $this->app->post('/newDomain/', function () use($res, $serviceAdapter, $req) {
            $res->header('Content-Type', 'application/json');
            $domain = $req->post('domain');
            $result = $serviceAdapter->createDomain($domain);
            $res->body($result);
        });
    }
}

$service = new IRedMailService();
