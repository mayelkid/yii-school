<?php
// 定义标题和面包屑信息
$this->title = '考勤类型';
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
    var m = meTables({
        title: "考勤类型",
        table: {
            "aoColumns": [
            {"title": "id", "data": "id", "sName": "id", "isHide": true, "edit": {"type": "hidden", "required": true,"number": true}, "bSortable": false}, 
			{"title": "类型编号", "data": "type_id", "sName": "type_id", "edit": {"type": "text", "number": true, "required": true,}, "bSortable": false}, 
			{"title": "考勤类型", "data": "type_name", "sName": "type_name", "edit": {"type": "text", "required": true, "rangelength": "[2, 10]"}, "bSortable": false}, 

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