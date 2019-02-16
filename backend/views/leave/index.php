<?php
// 定义标题和面包屑信息
$this->title = '请假信息';
$url = '@web/public/assets';
$depends = ['depends' => 'backend\assets\AdminAsset'];
$this->registerCssFile($url.'/css/bootstrap-datetimepicker.css', $depends);
$this->registerJsFile($url.'/js/date-time/moment.min.js', $depends);
$this->registerJsFile($url.'/js/date-time/bootstrap-datetimepicker.min.js', $depends);
$this->registerCssFile($url.'/css/chosen.css', $depends);
$this->registerJsFile($url.'/js/chosen.jquery.min.js', $depends);
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
    var m = meTables({
        title: "请假信息",
        table: {
            "aoColumns": [
                			{"title": "id", "data": "id", "sName": "id","isHide": true, "edit": {"type": "hidden", "number": true}, "bSortable": false}, 
			{"title": "sid", "data": "sid", "sName": "sid", "bSortable": false}, 
			{"title": "请假事件", "data": "title", "sName": "title", "edit": {"type": "text", "rangelength": "[2, 50]"}, "bSortable": false}, 
			{"title": "请假原因", "data": "content", "sName": "content", "edit": {"type": "text", "rangelength": "[2, 255]"}, "bSortable": false}, 
			{"title": "开始时间", "data": "start_time", "sName": "start_time", "edit": {"type": "dateTime"},  "bSortable": false}, 
			{"title": "结束时间", "data": "end_time", "sName": "end_time", "edit": {"type": "dateTime"}, "bSortable": false}, 
			{"title": "班级", "data": "class", "sName": "class", "bSortable": false}, 
			{"title": "请假人家长", "data": "fid", "sName": "fid", "bSortable": false}, 
			{"title": "请假人", "data": "cid", "sName": "cid", "bSortable": false}, 
			{"title": "状态", "data": "status", "sName": "status", "bSortable": false}, 
			{"title": "回复内容", "data": "reply", "sName": "reply", "bSortable": false}, 
			{"title": "回复人", "data": "rid", "sName": "rid", "bSortable": false}, 
			{"title": "回复时间", "data": "reply_time", "sName": "reply_time", "bSortable": false}, 
			{"title": "添加时间", "data": "created_at", "sName": "created_at", "bSortable": false, "createdCell" : meTables.dateTimeString}, 
			
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
		 $('.datetime-picker').datetimepicker({
            format: 'YYYY-MM-DD'
        });
     });
</script>
<?php $this->endBlock(); ?>