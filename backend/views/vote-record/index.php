<?php
// 定义标题和面包屑信息
$this->title = '投票结果';
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
	var vote = <?php echo $vote ?>;
	var option = <?php echo $option ?>;
	var students = <?php echo $students ?>;
    var m = meTables({
        title: "投票结果",
        table: {
            "aoColumns": [
			{"title": "id", "data": "id", "sName": "id",  "edit": {"type": "hidden"},"bSortable": false}, 
			{"title": "投票编号", "data": "vote_id", "sName": "vote_id","value": vote,"edit": {"type": "select"}, "bSortable": false ,"createdCell": function (td, data) {$(td).html(vote[data] ? vote[data] : data);}}, 
			{"title": "选项编号", "data": "option_id", "sName": "option_id","value": option,"edit": {"type": "select"}, "bSortable": false,"createdCell": function (td, data) {$(td).html(option[data] ? option[data] : data);}}, 
			{"title": "学生编号", "data": "student_id", "sName": "student_id","value": students,"edit": {"type": "select"},  "bSortable": false,"createdCell": function (td, data) {$(td).html(students[data] ? students[data] : data);}}, 
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
     });
</script>
<?php $this->endBlock(); ?>