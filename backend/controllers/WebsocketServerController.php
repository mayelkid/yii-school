<?php

namespace backend\controllers;

use yii;

class WebsocketServerController 
{
	//初始化程序
    public function index(){
        
        
        echo '正在启动程序' . PHP_EOL;
        
        $this->server = new \swoole_websocket_server("0.0.0.0", 9501);
        
        //第一次连接的时候
        $this->server->on('open', function (\swoole_websocket_server $server, $request) {
            
            echo "新用户连接 fd是 {$request->fd}".PHP_EOL;
        });

        $cache = Yii::$app->cache; 
        
        $this->server->on('message', function (\swoole_websocket_server $server, $frame) {
            
            //收到用户信息
            
            //解析用户数据信息
            $data = json_decode($frame->data,true);
            
            
            //是否为第一次连接
            if($data['type']=='init'){
                
                //缓存用户信息
				$cache->set(md5($data['uid']),$frame->fd);
				$cache->set($frame->fd,md5($data['uid']));
                //S(md5($data['uid']),$frame->fd);
                //S($frame->fd,md5($data['uid']));
                
                echo '用户'.$data['uid'].'注册成功'.PHP_EOL;
                
            }else{
                if( !$cache->get(md5($data['tid']))){
                    $server->push($frame->fd, '{"type":"notice","message":"用户不在线"}');
                    
                }else{
                    //否则推送消息给其他用户
                    $this->server->push($cache->get(md5($data['tid'])), $frame->data);    
                    
                    echo '发送给消息人'.$data['tid'].'的消息已经发送成功'.PHP_EOL;
                    echo '他的FD为'.$cache->get(md5($data['tid'])).PHP_EOL;
                }
            }
            
            
            echo "接受到信息来自 {$frame->fd} ".PHP_EOL;
            echo " 内容 {$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}".PHP_EOL;
        });
        
        
        
        //退出事件监控
        $this->server->on('close', function ($ser, $fd) {
            echo "用户 {$fd} 退出聊天系统" . PHP_EOL;
            $cache->set(md5(S($frame->fd)),null);
            $cache->set($frame->fd,null);
        });
        
        echo '程序启动完毕 启动时间：' . date('Y-m-d H:i:s') . PHP_EOL;
        //启动程序
        $this->server->start();    
        
        
        
    }
}