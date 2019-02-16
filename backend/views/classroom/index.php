<?php
// 定义标题和面包屑信息
$this->title = '教室管理';
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
    var m = meTables({
        title: "教室管理",
        table: {
            "aoColumns": [
            {"title": "id", "data": "id", "sName": "id", "isHide": true, "edit": {"type": "hidden", "required": true,"number": true}, "bSortable": false}, 
			{"title": "教室编号", "data": "classroom_id", "sName": "classroom_id", "edit": {"type": "text","number": true, placeholder:"若不填，则自动生成"}, "bSortable": false}, 
			{"title": "教室", "data": "classroom", "sName": "classroom", "edit": {"type": "text", "rangelength": "[2, 10]"}, "bSortable": false}, 
			{"title": "楼号", "data": "buildno", "sName": "buildno", "edit": {"type": "text", "number": true, }, "bSortable": false},
			{"title": "楼层", "data": "floor", "sName": "floor", "edit": {"type": "text", "number": true, }, "bSortable": false}, 
			{"title": "房间号", "data": "houseno", "sName": "houseno", "edit": {"type": "text", "number": true, }, "bSortable": false}, 
			{"title": "限制人数", "data": "limits", "sName": "limits", "edit": {"type": "text", "number": true, }, "bSortable": false}, 
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