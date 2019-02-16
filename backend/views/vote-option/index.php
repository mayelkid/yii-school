<?php
// 定义标题和面包屑信息
$this->title = '选项内容';
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
	var vote = <?php echo $vote ?>;
    var m = meTables({
		params:{'vote_id':'<?= $id ?>'},
        title: "选项内容",
        table: {
            "aoColumns": [
			{"title": "id", "data": "id", "sName": "id", "edit": {"type": "hidden", "required": true,"number": true}, "bSortable": false}, 
			{"title": "投票编号", "data": "vote_id", "sName": "vote_id","value": vote,"edit": {"type": "select"}, "bSortable": false ,"createdCell": function (td, data) {$(td).html(vote[data] ? vote[data] : data);}}, 
			{"title": "候选选项", "data": "option", "sName": "option", "edit": {"type": "text", "rangelength": "[2, 255]"},  "search": {"type": "text"},"bSortable": false}, 
			{"title": "添加时间", "data": "created_at", "sName": "created_at", "bSortable": false, "createdCell" : meTables.dateTimeString}, 
			{"title": "修改时间", "data": "updated_at", "sName": "updated_at", "bSortable": false, "createdCell" : meTables.dateTimeString}, 

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