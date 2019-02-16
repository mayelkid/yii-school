<?php
// 定义标题和面包屑信息
$this->title = '管理员管理';
$url = '@web/public/assets';
$depends = ['depends' => 'backend\assets\AdminAsset'];
$this->registerCssFile($url.'/css/chosen.css', $depends);
$this->registerJsFile($url.'/js/chosen.jquery.min.js', $depends);
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
    var m = meTables({
        title: "管理员管理",
		fileSelector: ["#file"],
        table: {
            "aoColumns": [
            {"title": "id", "data": "id", "sName": "id", "isHide": true, "edit": {"type": "hidden", "required": true,"number": true}, "bSortable": false},  
			{"title": "姓名", "data": "name", "sName": "name", "edit": {"type": "text", "rangelength": "[2, 10]"}, "search": {"type": "text"}, "bSortable": false}, 
			{"title": "手机", "data": "phone", "sName": "phone", "edit": {"type": "text", "rangelength": "[2, 11]"}, "bSortable": false}, 
			{"title": "头像", "data": "ahead", "sName": "ahead", "isHide": true, "edit": {"type": "file", options: {
                                "id": "file",
                                "name": "UploadForm[ahead]",
                                "input-name": "ahead",
                                "input-type": "ace_file",
                                "file-name": "ahead"
                            }}, "bSortable": false}, 
			
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
	
	var $file = null;
    mt.fn.extend({
        beforeShow: function(data) {
            $file.ace_file_input("reset_input");

            // 修改复值
            if (this.action == "update" && ! empty(data.ahead)) {
                $file.ace_file_input("show_file_list", [data.ahead]);
            }

            return true;
        }
    });

     $(function(){
         m.init();
		 $file = $("#file");
     });
</script>
<?php $this->endBlock(); ?>