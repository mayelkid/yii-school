<?php

namespace console\controllers;
use yii\console\Controller;
use backend\models\School;
 
class SchoolController extends Controller
{
	public $server;
	
    //初始化程序
    public function actionIndex(){
		$this->server = new \swoole_http_server("0.0.0.0", 9502);
		$this->server->on("start", function (\swoole_http_server $server) {
			echo "Swoole http server is started at http://127.0.0.1:9501\n";
		});

		$this->server->on("request", function ($request, $response) {
			$response->header("Content-Type", "application/json");
			$server = $request->server;
			if($server['request_uri'] == '/School/get'){
				$data = School::findSchool(['sid'=>'410004001']);
				$response->end(json_encode($data));
			}else{
				$response->end('失败');
			}
			
		});
		return $this->server->start();
	}
}
