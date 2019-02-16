<?php

use yii\helpers\Json;
use \backend\models\Auth;

// 获取权限
$auth = Auth::getDataTableAuth('message');

// 定义标题和面包屑信息
$this->title = '家长留言';
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
    var m = meTables({
        title: "家长留言",
		buttons: <?=Json::encode($auth['buttons'])?>,
        table: {
            "aoColumns": [
            {"title": "id", "data": "id", "sName": "id", "isHide": true, "edit": {"type": "hidden", "required": true,"number": true}, "bSortable": false}, 
			{"title": "发布人姓名", "data": "pubname", "sName": "pubname", "edit": {"type": "text", "rangelength": "[2, 10]"}, "search": {"type": "text"}, "bSortable": false}, 
			{"title": "发布人电话", "data": "pubtel", "sName": "pubtel", "edit": {"type": "text", "rangelength": "[11, 11]"}, "search": {"type": "text"}, "bSortable": false}, 
			{"title": "内容", "data": "content", "sName": "content", "edit": {"type": "text", "rangelength": "[2, 255]"}, "bSortable": false}, 
			{"title": "发布时间", "data": "created_at", "sName": "created_at", "bSortable": false, "createdCell" : meTables.dateTimeString}, 
			
            ]       
        }
    });
    
    /**
    meTables.fn.extend({
        // 显示的前置和后置操作
        beforeShow: function(data, child) {
            return true;
        },
        afterShow: function(data, child) {
            return true;
        },
        
        // 编辑的前置和后置操作
        beforeSave: function(data, child) {
            return true;
        },
        afterSave: function(data, child) {
            return true;
        }
    });
    */

     $(function(){
         m.init();
     });
</script>
<?php $this->endBlock(); ?>