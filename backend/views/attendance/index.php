<?php

use yii\helpers\Json;
use \backend\models\Auth;

// 获取权限
$auth = Auth::getDataTableAuth('attendance');

// 定义标题和面包屑信息
$this->title = '考勤记录';
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
    var attendanceTypes = <?php echo $attendanceTypes ?>,
	m = meTables({
        title: "考勤记录",
		buttons: <?=Json::encode($auth['buttons'])?>,
		operations: {
                width: "auto",
                buttons: <?=Json::encode($auth['operations'])?>
            },
        table: {
            "aoColumns": [
            {"title": "id", "data": "id", "sName": "id", "isHide": true, "edit": {"type": "hidden", "required": true,"number": true}, "bSortable": false}, 
			{"title": "卡号", "data": "card_id", "sName": "card_id", "edit": {"type": "text", "number": true}, "bSortable": false}, 
			{"title": "考勤类型", "data": "type_id", "sName": "type_id","value":attendanceTypes, "edit": {"type": "select", "number": true}, "bSortable": false,"createdCell": function (td, data) {$(td).html(attendanceTypes[data] ? attendanceTypes[data] : data);}}, 
			{"title": "时间", "data": "time", "sName": "time", "edit": {"type": "text", "number": true}, "bSortable": false}, 
			

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