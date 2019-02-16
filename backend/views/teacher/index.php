<?php
// 定义标题和面包屑信息
$this->title = '教师管理';
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
    grades = <?php echo $grades ?>, 
	cards = <?php echo $cards ?>, 
	m = meTables({
        title: "教师管理",
		fileSelector: ["#file"],
        table: {
            "aoColumns": [
            {"title": "id", "data": "id", "sName": "id","isHide": true, "edit": {"type": "hidden", "number": true}, "bSortable": false}, 
			{"title": "教师编号", "data": "teacher_id", "sName": "teacher_id", "edit": {"type": "text", "number": true, placeholder:"若不填，则自动生成"}, "bSortable": false},
			{"title": "考勤卡号", "data": "card_id", "sName": "card_id", "value": cards['0'] || {'0':'请选择'},  "edit": {"type": "select", "number": true}, "bSortable": false, "createdCell": function (td, data) {$(td).html(cards['1'][data] ? cards['1'][data] : data);}}, 
			{"title": "姓名", "data": "name", "sName": "name", "edit": {"type": "text","required": true, "rangelength": "[2, 10]"},  "search": {"type": "text"},"bSortable": false}, 
			{"title": "性别", "data": "sex", "sName": "sex", "value": gender, "edit": {"type": "radio"}, "bSortable": false,"createdCell": function (td, data) {$(td).html(gender[data] ? gender[data] : data);}},
			{"title": "简介", "data": "intro", "sName": "intro","isHide": true, "edit": {"type": "textarea"}, "bSortable": false},
			{"title": "年级", "data": "grade", "sName": "grade","value": grades, "edit": {"type": "select"}, "bSortable": false,"createdCell": function (td, data) {$(td).html(grades[data]);}}, 
			{"title": "手机号码", "data": "phone", "sName": "phone", "edit": {"type": "text","required": true, "rangelength": "[11, 11]"}, "search": {"type": "text"}, "bSortable": false}, 
			{"title": "出生日期", "data": "birth", "sName": "birth", "edit": {"type": "dateTime"}, "bSortable": false}, 
			{"title": "住址", "data": "address", "sName": "address", "edit": {"type": "text"}, "bSortable": false}, 
			{"title": "头像", "data": "ahead", "sName": "ahead","isHide": true, "edit": {"type": "file", options: {
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
			var option = '';
			for(var key in cards['0']){
				option += "<option value='"+ key +"'>"+ cards['0'][key] +"</option>";
			}
            if (this.action == "update") {
				option += "<option value='"+ data.card_id +"'>"+ cards['1'][data.card_id] +"</option>";
				if(!empty(data.ahead)){
					$("#file").ace_file_input("show_file_list", [data.ahead]);					
				}
            }
			$("select[name='card_id']").html(option);
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