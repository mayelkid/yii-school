<?php
// 定义标题和面包屑信息
$this->title = '公告';
$url = '@web/public/assets';
$depends = ['depends' => 'backend\assets\AdminAsset'];
$this->registerCssFile($url.'/css/bootstrap-datetimepicker.css', $depends);
$this->registerJsFile($url.'/js/date-time/moment.min.js', $depends);
$this->registerJsFile($url.'/js/date-time/bootstrap-datetimepicker.min.js', $depends);
$this->registerCssFile($url.'/css/chosen.css', $depends);
$this->registerJsFile($url.'/js/chosen.jquery.min.js', $depends);
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
    var m = meTables({
        title: "公告",
		
		fileSelector: ["#file"],
        table: {
            "aoColumns": [
			{"title": "ID", "data": "id", "sName": "id","edit": {"type": "hidden"},  "bSortable": false}, 
			{"title": "学校编号", "data": "sid", "sName": "sid","edit": {"type": "hidden"}, "bSortable": false}, 
			{"title": "标题", "data": "title", "sName": "title", "edit": {"type": "text", "rangelength": "[2, 50]"}, "bSortable": false}, 
			{"title": "内容", "data": "content", "sName": "content", "edit": {"type": "textarea", "rangelength": "[2, 255]"}, "bSortable": false}, 
			{"title": "封面", "data": "thumb", "sName": "thumb", "isHide": true, "edit": {"type": "file", options: {"id": "file","name": "UploadForm[thumb]","input-name": "thumb","input-type": "ace_file","file-name": "thumb"}}, "bSortable": false}, 
			{"title": "阅读权限", "data": "arcrank", "sName": "arcrank", "edit": {"type": "text", "rangelength": "[2, 50]"}, "bSortable": false}, 
			{"title": "点击量", "data": "click", "sName": "click", "bSortable": false}, 
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
	var $file = null;
    mt.fn.extend({
        beforeShow: function(data) {
            $file.ace_file_input("reset_input");

            // 修改复值
            if (this.action == "update" && ! empty(data.thumb)) {
                $file.ace_file_input("show_file_list", [data.thumb]);
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