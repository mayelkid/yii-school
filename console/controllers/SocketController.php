<?php

namespace console\controllers;
use yii\console\Controller;
use yii;

class SocketController extends Controller
{
	public $server;
	
	//初始化程序
    public function actionIndex(){
        
        $this->server = new \swoole_websocket_server("0.0.0.0", 9501);
		
		$table = new \swoole_table(1024);
		$table->column('fd', \swoole_table::TYPE_INT);
		$table->create();
        $this->server->table = $table;
		
        //连接事件
        $this->server->on('open', function ($server, $request) {
            echo "新用户连接 fd是 {$request->fd}".PHP_EOL;
        });

        //接收消息事件
        $this->server->on('message', function ($server, $frame) {

            //解析用户数据信息
            $data = json_decode($frame->data,true);
		  
            //是否为第一次连接
            if($data['type'] == 'init'){                
                //存储用户信息
				$this->server->table->set($data['uid'], array('fd' => $frame->fd));         
            }else{
				if(isset($data['tid']) && $data['tid']){
					//指定用户发送消息
					if($v = $this->server->table->get($data['tid'])){    
						//如果对方用户在线
						$this->server->push($v['fd'], $frame->data);                
					}else{
						//如果对方用户不在线
						$this->server->push($frame->fd, '{"type":"notice","data":"用户不在线"}');
					}
				}else{
					//向所有用户发送消息
					foreach($this->server->table as $v){
						$this->server->push($v['fd'], $frame->data);
					}
				}
            }
        });
        
        //断开事件
        $this->server->on('close', function ($server, $fd) {
			foreach($this->server->table as $k=>$v){
				if($v['fd'] == $fd){
					$this->server->table->del($k);break;					
				}
			}
        });
        
        //启动程序
        $this->server->start();
    }
}