<?php
// 定义标题和面包屑信息
$this->title = '教师授课表';
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
    var statuss = {0:'停课',1:'正常'},
	subjects = <?php echo $subjects ?>,
	teachers = <?php echo $teachers ?>,
	m = meTables({
        title: "教师授课表",
        table: {
            "aoColumns": [
            {"title": "id", "data": "id", "sName": "id", "isHide": true, "edit": {"type": "hidden", "required": true,"number": true}, "bSortable": false}, 
			{"title": "教师", "data": "teacher_id", "sName": "teacher_id", "value": teachers, "edit": {"type": "select"}, "bSortable": false, "createdCell": function (td, data) {$(td).html(teachers[data] ? teachers[data] : data);}}, 
			{"title": "科目", "data": "subject_id", "sName": "subject_id", "value": subjects, "edit": {"type": "select", "number": true}, "bSortable": false, "createdCell": function (td, data) {$(td).html(subjects[data] ? subjects[data] : data);}}, 
			{"title": "状态", "data": "status", "sName": "status", "value": statuss, "edit": {"type": "radio"}, "bSortable": false, "createdCell": function (td, data) {$(td).html(statuss[data] ? statuss[data] : data);}}, 
			

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