<?php
use yii\helpers\Json;

// 定义标题和面包屑信息
$this->title = '学生管理';
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
    var gender = <?=Json::encode($gender)?>,
	m = meTables({
        title: "学生管理",
        table: {
            "aoColumns": [
            {"title": "学生编号", "data": "id", "sName": "id", "edit": {"type": "hidden"}, "defaultOrder": "desc"}, 
			{"title": "学校编号", "data": "kid", "sName": "kid", "bSortable": false}, 
			{"title": "卡号", "data": "cardno", "sName": "cardno", "edit": {"type": "text", "required": true,"rangelength": "[2, 50]"}, "bSortable": false}, 
			{"title": "姓名", "data": "cname", "sName": "cname", "edit": {"type": "text", "required": true,"rangelength": "[2, 20]"}, "search": {"type": "text"}, "bSortable": false}, 
			{"title": "班级", "data": "cclass", "sName": "cclass", "edit": {"type": "text", "required": true,"rangelength": "[2, 10]"}, "search": {"type": "text"}, "bSortable": false}, 
			{"title": "性别", "data": "csex", "sName": "csex","value": gender, "edit": {"type": "radio"}, "bSortable": false,"createdCell": function (td, data) {$(td).html(gender[data] ? gender[data] : data);}}, 
			{"title": "生日", "data": "cbirth", "sName": "cbirth", "edit": {"type": "dateTime"}, "bSortable": false}, 
			{"title": "住址", "data": "caddress", "sName": "caddress", "edit": {"type": "text", "rangelength": "[2, 30]"}, "bSortable": false}, 
			/*{"title": "视频", "data": "video", "sName": "video", "bSortable": false}, */
			{"title": "头像", "data": "chead", "sName": "chead","isHide": true, "edit": {"type": "file", options: {
                                "id": "file",
                                "name": "UploadForm[chead]",
                                "input-name": "chead",
                                "input-type": "ace_file",
                                "file-name": "chead"
                            }}, "bSortable": false}, 
			/*{"title": "会员", "data": "isvip", "sName": "isvip", "edit": {"type": "text", "required": true,"number": true}, "bSortable": false}, 
			{"title": "会员时间", "data": "viptime", "sName": "viptime", "edit": {"type": "text", "required": true,"rangelength": "[2, 20]"}, "bSortable": false},*/ 
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
            if (this.action == "update" && ! empty(data.chead)) {
                $file.ace_file_input("show_file_list", [data.chead]);
            }

            return true;
        }
    });
	
     $(function(){
         m.init();
		 // 时间选项
        $('.datetime-picker').datetimepicker({
            format: 'YYYY-MM-DD'
        });
		$file = $("#file");
     });
</script>
<?php $this->endBlock(); ?>