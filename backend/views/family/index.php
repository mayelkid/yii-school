<?php
// 定义标题和面包屑信息
$this->title = '家长信息';
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
    var gender = {0:'男',1:'女'}, 
	links = {1:'爸爸',2:'妈妈',3:'爷爷',4:'奶奶'},
	students = <?php echo $arrStudents ?>, 
	m = meTables({
        title: "家长信息",
		fileSelector: ["#file"],
        table: {
            "aoColumns": [
            {"title": "id", "data": "id", "sName": "id", "isHide": true, "edit": {"type": "hidden", "required": true,"number": true}, "bSortable": false}, 
			{"title": "关联学生", "data": "student_id", "sName": "student_id", "value": students, "edit": {"type": "select"}, "bSortable": false, "createdCell": function (td, data) {$(td).html(students[data]? students[data] : data);}}, 
			{"title": "家长姓名", "data": "name", "sName": "name", "edit": {"type": "text", "required": true, "rangelength": "[2, 4]"}, "search": {"type": "text"}, "bSortable": false}, 
			{"title": "性别", "data": "sex", "sName": "sex", "value": gender, "edit": {"type": "radio"}, "bSortable": false,"createdCell": function (td, data) {$(td).html(gender[data] ? gender[data] : data);}},
			{"title": "关系", "data": "link", "sName": "link", "value": links, "edit": {"type": "select"}, "bSortable": false,"createdCell": function (td, data) {$(td).html(links[data] ? links[data] : data);}}, 
			{"title": "手机号码", "data": "phone", "sName": "phone", "edit": {"type": "text", "required": true, "rangelength": "[11, 11]"}, "search": {"type": "text"}, "bSortable": false}, 
			{"title": "出生日期", "data": "birth", "sName": "birth", "edit": {"type": "dateTime"}, "bSortable": false}, 
			{"title": "家庭住址", "data": "address", "sName": "address", "edit": {"type": "text", "rangelength": "[2, 20]"}, "bSortable": false}, 
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
		  $('.datetime-picker').datetimepicker({
            format: 'YYYY-MM-DD'
        });
		$file = $("#file");
     });
</script>
<?php $this->endBlock(); ?>