<?php
// 定义标题和面包屑信息
$this->title = '学生选课调查记录表';
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
    var tasks = <?php echo $tasks ?>,
	courses = <?php echo $courses ?>,
	students = <?php echo $students ?>,
	m = meTables({
        title: "学生选课调查记录表",
        table: {
            "aoColumns": [
            {"title": "id", "data": "id", "sName": "id", "isHide":true, "edit": {"type": "hidden", "required": true,"number": true}, "bSortable": false}, 
			{"title": "任务", "data": "choosetaskid", "sName": "choosetaskid", "value": tasks, "edit": {"type": "select", "number": true}, "bSortable": false, "createdCell": function (td, data) {$(td).html(tasks[data]? tasks[data] : data);}}, 
			{"title": "课程", "data": "coursegroupids", "sName": "coursegroupids", "value": courses, "edit": {"type": "select", "number": true}, "bSortable": false, "createdCell": function (td, data) {$(td).html(courses[data] ? courses[data] : data);}}, 
			{"title": "学生", "data": "student_id", "sName": "student_id", "value": students, "edit": {"type": "select", "number": true}, "bSortable": false, "createdCell": function (td, data) {$(td).html(students[data]? students[data] : data);}}, 
			

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