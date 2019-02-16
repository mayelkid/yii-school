<?php
// 定义标题和面包屑信息
$this->title = '科目管理';
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
    var require = {1:'必修',2:'选修'}, 
	m = meTables({
        title: "科目管理",
        table: {
            "aoColumns": [
            {"title": "id", "data": "id", "sName": "id", "isHide": true, "edit": {"type": "hidden", "required": true,"number": true}, "bSortable": false}, 
			{"title": "科目编号", "data": "subject_id", "sName": "subject_id","bSortable": false}, 
			{"title": "科目名称", "data": "subject_name", "sName": "subject_name", "edit": {"type": "text", "required": true}, "bSortable": false}, 
			{"title": "要求", "data": "is_required", "sName": "is_required", "value":require, "edit": {"type": "radio"}, "bSortable": false, "createdCell": function (td, data) {$(td).html(require[data] ? require[data] : data);}}, 
			

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