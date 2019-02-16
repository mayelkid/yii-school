<?php
// 定义标题和面包屑信息
$this->title = '校园风采';
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
	
    var introduction = <?php echo $introduction ?>, 
    m = meTables({
        title: "校园风采",
        table: {
            "aoColumns": [
                            {"title": "id", "data": "id", "sName": "id", "edit": {"type": "hidden", "required": true,"number": true}, "bSortable": false}, 
            {"title": "名称", "data": "type", "sName": "type", "value": introduction, "edit": {"type": "select", "number": true}, "bSortable": false, "createdCell": function (td, data) {$(td).html(introduction[data]? introduction[data] : data);}}, 
			//{"title": "标题", "data": "title", "sName": "title", "edit": {"type": "text", "rangelength": "[2, 50]"}, "bSortable": false}, 
            {"title": "内容", "data": "content", "sName": "content", "edit": {"type": "text", "rangelength": "[2, 255]"}, "bSortable": false}, 
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