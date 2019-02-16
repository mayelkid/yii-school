<?php
// 定义标题和面包屑信息
$this->title = '档案属性';
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
    var m = meTables({
        title: "档案属性",
        table: {
            "aoColumns": [
            {"title": "id", "data": "id", "sName": "id", "edit": {"type": "hidden", "required": true,"number": true}, "bSortable": false}, 
            {"title": "属性", "data": "title", "sName": "title", "edit": {"type": "text", "required": true, "rangelength": "[2, 20]"}, "bSortable": false}, 

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