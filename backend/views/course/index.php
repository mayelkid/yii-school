<?php
// 定义标题和面包屑信息
$this->title = '课程表';
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
    var grades = <?php echo $grades ?>,
	courses = <?php echo $courses ?>,
	lessons = <?php echo $lessons ?>,
	m = meTables({
        title: "课程表",
        table: {
            "aoColumns": [
            {"title": "id", "data": "id", "sName": "id", "isHide": true, "edit": {"type": "hidden", "required": true,"number": true}, "bSortable": false}, 
			{"title": "年级", "data": "grade", "sName": "grade", "value": grades, "edit": {"type": "select"}, "search": {"type": "select"}, "bSortable": false, "createdCell": function (td, data) {$(td).html(grades[data] ? grades[data] : data);}}, 
			{"title": "节数", "data": "lesson", "sName": "lesson", "value": lessons, "edit": {"type": "select"}, "bSortable": true,  "createdCell": function (td, data) {$(td).html(lessons[data] ? lessons[data] : data);}},
			{"title": "周一", "data": "week1", "sName": "week1",  "value": courses, "edit": {"type": "select"}, "bSortable": false,  "createdCell": function (td, data) {$(td).html(courses[data] ? courses[data]['course_name']+'-'+courses[data]['teacher_name'] : '休息');}}, 
			{"title": "周二", "data": "week2", "sName": "week2",  "value": courses, "edit": {"type": "select"}, "bSortable": false,  "createdCell": function (td, data) {$(td).html(courses[data] ? courses[data]['course_name']+'-'+courses[data]['teacher_name'] : '休息');}},
			{"title": "周三", "data": "week3", "sName": "week3",  "value": courses, "edit": {"type": "select"}, "bSortable": false,  "createdCell": function (td, data) {$(td).html(courses[data] ? courses[data]['course_name']+'-'+courses[data]['teacher_name'] : '休息');}}, 
			{"title": "周四", "data": "week4", "sName": "week4",  "value": courses, "edit": {"type": "select"}, "bSortable": false,  "createdCell": function (td, data) {$(td).html(courses[data] ? courses[data]['course_name']+'-'+courses[data]['teacher_name'] : '休息');}}, 
			{"title": "周五", "data": "week5", "sName": "week5",  "value": courses, "edit": {"type": "select"}, "bSortable": false,  "createdCell": function (td, data) {$(td).html(courses[data] ? courses[data]['course_name']+'-'+courses[data]['teacher_name'] : '休息');}}, 
			{"title": "周六", "data": "week6", "sName": "week6",  "value": courses, "edit": {"type": "select"}, "bSortable": false,  "createdCell": function (td, data) {$(td).html(courses[data] ? courses[data]['course_name']+'-'+courses[data]['teacher_name'] : '休息');}}, 
			{"title": "周日", "data": "week7", "sName": "week7",  "value": courses, "edit": {"type": "select"}, "bSortable": false,  "createdCell": function (td, data) {$(td).html(courses[data] ? courses[data]['course_name']+'-'+courses[data]['teacher_name'] : '休息');}}, 
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
	mt.fn.extend({
        beforeShow: function(data) {
            // 修改复值
			var option = '';
			option += "<option value=''>无</option>";
			for(var key in courses){
				option += "<option value='"+ key +"'>"+ courses[key]['course_name']+'-'+courses[key]['teacher_name'] +"</option>";
			}
			$("select[name='week1']").html(option);				
			$("select[name='week2']").html(option);				
			$("select[name='week3']").html(option);				
			$("select[name='week4']").html(option);				
			$("select[name='week5']").html(option);				
			$("select[name='week6']").html(option);				
			$("select[name='week7']").html(option);				
            return true;
        }
    });

     $(function(){
         m.init();
     });
</script>
<?php $this->endBlock(); ?>