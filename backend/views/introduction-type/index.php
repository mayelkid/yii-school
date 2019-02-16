<?php
// 定义标题和面包屑信息
$this->title = '校园属性';
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
    var m = meTables({
        title: "校园属性",
        table: {
            "aoColumns": [
                			{"title": "编号", "data": "id", "sName": "id", "bSortable": false}, 
			{"title": "属性名称", "data": "name", "sName": "name", "edit": {"type": "text", "required": true,"rangelength": "[2, 50]"}, "bSortable": false}, 
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