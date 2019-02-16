<?php

namespace backend\controllers;
use yii\web\Controller;
 
 
class SwooleController extends Controller
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
			$response->end(json_encode($request));
		});

		return $this->server->start();
		
		
		
		
		/*
        echo '正在启动程序' . PHP_EOL;
        
        $this->server = new \swoole_http_server("0.0.0.0", 9501);
        
        //第一次连接的时候
        $this->server->on('open', function (\swoole_http_server $server, $request) {
            
            echo "新用户连接 fd是 {$request->fd}".PHP_EOL;
        });

        
			
        $this->server->on('message', function (\swoole_http_server $server, $frame) {
            
            //收到用户信息
            
            //解析用户数据信息
            $data = json_decode($frame->data,true);
            
            
            //是否为第一次连接
            if($data['type']=='init'){
                
                //缓存用户信息
                S(md5($data['uid']),$frame->fd);
                S($frame->fd,md5($data['uid']));
                
                echo '用户'.$data['uid'].'注册成功'.PHP_EOL;
                
            }else{
                if( !S(md5($data['tid']))  ){
                    $server->push($frame->fd, '{"type":"notice","message":"用户不在线"}');
                    
                }else{
                    //否则推送消息给其他用户
                    $this->server->push(S(md5($data['tid'])), $frame->data);    
                    
                    echo '发送给消息人'.$data['tid'].'的消息已经发送成功'.PHP_EOL;
                    echo '他的FD为'.S(md5($data['tid'])).PHP_EOL;
                }
            }
            
            
            echo "接受到信息来自 {$frame->fd} ".PHP_EOL;
            echo " 内容 {$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}".PHP_EOL;
        });
        
        
        
        //退出事件监控
        $this->server->on('close', function ($ser, $fd) {
            echo "用户 {$fd} 退出聊天系统" . PHP_EOL;
            S(md5(S($frame->fd)),null);
            S($frame->fd,null);
        });
        
        echo '程序启动完毕 启动时间：' . date('Y-m-d H:i:s') . PHP_EOL;
        //启动程序
        $this->server->start();   */
	}
}
