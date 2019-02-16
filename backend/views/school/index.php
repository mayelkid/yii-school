<?php
// 定义标题和面包屑信息
$this->title = '学校管理';
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
	//var arrParent = <?=\yii\helpers\Json::encode($parent)?>,
    var m = meTables({
        title: "学校管理",
        table: {
            "aoColumns": [
			{"title": "id", "data": "id", "sName": "id", "edit": {"type": "hidden"}, "bSortable": false}, 
            {"title": "学校编号", "data": "sid", "sName": "sid", "bSortable": false}, 
            {"title": "学校名称", "data": "name", "sName": "name", "edit": {"type": "text", "rangelength": "[2, 50]"}, "search": {"type": "text"}, "bSortable": false}, 
            {"title": "联系人手机", "data": "phone", "sName": "phone", "edit": {"type": "text", "number": true}, "bSortable": false}, 
            {"title": "联系人邮箱", "data": "email", "sName": "email", "edit": {"type": "text", "rangelength": "[2, 50]"}, "bSortable": false}, 
            {"title": "坐标", "data": "location", "sName": "location", "edit": {"type": "text", "rangelength": "[2, 50]"}, "bSortable": false}, 
            {"title": "省", "data": "province", "sName": "province", "edit": {"type": "text", "rangelength": "[2, 50]"}, "bSortable": false}, 
            {"title": "市", "data": "city", "sName": "city", "edit": {"type": "text", "rangelength": "[2, 50]"}, "bSortable": false}, 
            {"title": "区", "data": "area", "sName": "area", "edit": {"type": "text", "rangelength": "[2, 50]"}, "bSortable": false}, 
            {"title": "添加时间", "data": "created_at", "sName": "created_at", "bSortable": false, "createdCell" : meTables.dateTimeString}, 
            {"title": "修改时间", "data": "updated_at", "sName": "updated_at", "bSortable": false, "createdCell" : meTables.dateTimeString}, 
			//{name:'city', index: 'city', title: "父类ID", width: 50, editable: true, value: arrParent,
			//	gridSearch: {type: "select"},
			//	editoptions: {size: "20", maxlength:"30"}
			//}
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