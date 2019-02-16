<?php
// 定义标题和面包屑信息
$this->title = '学生档案';
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
    var students = <?php echo $arrStudents ?>, 
    profileTypes = <?php echo $profileTypes ?>, 
	m = meTables({
        title: "学生档案",
        table: {
            "aoColumns": [
            {"title": "id", "data": "id", "sName": "id", "isHide": true, "edit": {"type": "hidden", "required": true,"number": true}, "bSortable": false}, 
			{"title": "属性", "data": "type_id", "sName": "type_id", "value": profileTypes, "edit": {"type": "select", "number": true}, "search": {"type": "select"}, "bSortable": false, "createdCell": function (td, data) {$(td).html(profileTypes[data]? profileTypes[data] : data);}}, 
			{"title": "学生", "data": "student_id", "sName": "student_id", "value": students, "edit": {"type": "select"}, "bSortable": false, "createdCell": function (td, data) {$(td).html(students[data]? students[data] : data);}}, 
			{"title": "情形", "data": "content", "sName": "content", "edit": {"type": "text", }, "bSortable": false},     
			{"title": "发布时间", "data": "created_at", "sName": "created_at", "edit": {"type": "hidden", "number": true}, "bSortable": true, "createdCell" : meTables.dateTimeString},
 
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