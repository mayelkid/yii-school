<?php
// 定义标题和面包屑信息
$this->title = '卡号管理';
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
    var statu = {0:'待使用',1:'使用中',2:'已冻结',3:'已注销'},
	m = meTables({
        title: "卡号管理",
        table: { 
            "aoColumns": [
            {"title": "id", "data": "id", "sName": "id", "isHide": true, "edit": {"type": "hidden", "required": true,"number": true}, "bSortable": false},  
			{"title": "卡号", "data": "card", "sName": "card", "edit": {"type": "text", "rangelength": "[2, 11]"}, "bSortable": false}, 
			{"title": "状态", "data": "status", "sName": "status", "value": statu, "edit": {"type": "radio"}, "bSortable": false, "createdCell": function (td, data) {$(td).html(statu[data] ? statu[data] : data);}},  
			

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