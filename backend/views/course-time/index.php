<?php
// 定义标题和面包屑信息
$this->title = '课程时间段设置';
$url = '@web/public/assets';
$depends = ['depends' => 'backend\assets\AdminAsset'];
$this->registerCssFile($url.'/css/bootstrap-datetimepicker.css', $depends);
$this->registerJsFile($url.'/js/date-time/moment.min.js', $depends);
$this->registerJsFile($url.'/js/date-time/bootstrap-datetimepicker.min.js', $depends);
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
    var choose = {0:'否',1:'是'},
	m = meTables({
        title: "课程时间段设置",
        table: {
            "aoColumns": [
            {"title": "id", "data": "id", "sName": "id", "isHide": true, "edit": {"type": "hidden", "required": true,"number": true}, "bSortable": false}, 
			{"title": "课节名称", "data": "name", "sName": "name", "edit": {"type": "text", }, "bSortable": false}, 
			{"title": "课节序号", "data": "lesson", "sName": "lesson", "edit": {"type": "text", }, "bSortable": false},
			{"title": "开始时间", "data": "starttime", "sName": "starttime", "edit": {"type": "dateTime"}, "bSortable": false}, 
			{"title": "结束时间", "data": "endtime", "sName": "endtime", "edit": {"type": "dateTime"}, "bSortable": false}, 

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
		 $('.datetime-picker').datetimepicker({format: 'H:mm',startView: 1,maxView:1});
     });
</script>
<?php $this->endBlock(); ?>