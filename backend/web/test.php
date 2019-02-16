<html>
<head>
	 <meta charset="utf-8">
	 <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
<style>
span{display:block;width:100%;text-align:left;line-height:30px;}
span.right{text-align:right;}
</style>

<div style="width:60%;height:500px;margin:20px auto;border:1px solid #eee" class="speak_box"></div>
<div style="width:60%;height:300px;margin:20px auto">
<textarea class="" style="width:100%;height:200px;"></textarea>
<button type="submit">发送</button>
</div>
</body>
<script>
//websocket长连接方式,swoole方式
    var wsServer = 'ws://192.144.151.39:9501';
    ws = new WebSocket(wsServer);
    var uid = <?php echo $_GET['uid']?>;
    ws.onopen = function(){
		console.log("socket连接已打开");
		var data = {
		  uid:uid,
		  type:'init',
		};
		ws.send(JSON.stringify(data));
    };
    
    ws.onmessage = function(e){
		console.log("message:" + e.data);
        if(e.data){
            var info = $.parseJSON(e.data);
            $('.speak_box').append('<span class="left">' + info.data+'</span>');
        }

    };
    ws.onclose = function(){
		console.log("socket连接已断开");
    };
    ws.onerror = function(e){
		console.log("ERROR:" + e.data);
    };
    //离开页面时关闭连接
    $(window).bind('beforeunload',function(){
		ws.close();
	});
	
	$('button').on('click',function(){
		var data = {
		  tid: '4',
		  type:'chat',
		  data: $('textarea').val()
		};
		ws.send(JSON.stringify(data));
		$('.speak_box').append('<span class="right">' + data.data + '</span>');
		$('textarea').val('');
	})
</script>
</html>