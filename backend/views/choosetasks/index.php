<?php

use yii\helpers\Url;
use yii\helpers\Json;
use \backend\models\Auth;

// 获取权限
$auth = Auth::getDataTableAuth('choosetasks');
// 定义标题和面包屑信息
$this->title = '选课任务';
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

	var statuss = {0:'调查',1:'选课',2:'分班',3:'排课',4:'完成'};
	var grade = <?php echo $grades ?>;
	var courses = <?php echo $courses ?>;
	var oOperationsButtons = <?=Json::encode($auth['operations'])?>;
	oOperationsButtons.see = {"cClass": "role-see"};
	oOperationsButtons.other = {
        bShow: <?=Yii::$app->user->can('choosetaskgroups/index') ? 'true' : 'false' ?>,
        "title": "课程组合",
        "button-title": "课程组合",
        "className": "btn-warning",
        "cClass": "role-edit",
        "icon": "fa-pencil-square-o",
        "sClass": "yellow"
    }; 
    var m = meTables({
        title: "选课任务",
		operations: {
            width: "200px",
            buttons: oOperationsButtons
        },
        table: {
            "aoColumns": [
			{"title": "id", "data": "id", "sName": "id", "edit": {"type": "hidden"}, "bSortable": false}, 
			{"title": "课程名称", "data": "name", "sName": "name", "edit": {"type": "text","required": true, "rangelength": "[2, 50]"}, "bSortable": false}, 
			{"title": "参选年级", "data": "grade", "sName": "grade", "value": grade, "edit": {"type": "select"}, "bSortable": false, "createdCell": function (td, data) {$(td).html(grade[data] ? grade[data] : data);}},
			{"title": "调查开始时间", "data": "checkstarttime", "sName": "checkstarttime", "edit": {"type": "dateTime","class": "time-format",}, "createdCell": mt.dateTimeString}, 
			
			{"title": "调查结束时间", "data": "checkendtime", "sName": "checkendtime", "edit": {"type": "dateTime","class": "time-format",},"createdCell": mt.dateTimeString ,"bSortable": false}, 
			{"title": "选课开始时间", "data": "choosestarttime", "sName": "choosestarttime", "edit": {"type": "dateTime","class": "time-format",},"createdCell": mt.dateTimeString}, 
			{"title": "选课结束时间", "data": "chooseendtime", "sName": "chooseendtime", "edit": {"type": "dateTime","class": "time-format",},"createdCell": mt.dateTimeString}, 
			{"title": "状态", "data": "status", "sName": "status", "value": statuss, "bSortable": false, "createdCell": function (td, data) {$(td).html(statuss[data] ? statuss[data] : data);}}, 
			{"title": "可选科目", "data": "amount", "sName": "amount",  "edit": {"type": "text","number": true}, "bSortable": false},

			//{"title": "操作时间", "data": "opertime", "sName": "opertime", "edit": {"type": "text", "rangelength": "[2, 50]"}, "bSortable": false}, 

            
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
	mt.fn.extend({
        beforeShow: function(data) {
           
            // 修改复值
			var option = '';
			option += "<option value='0'>顶级分类</option>";
			for(var key in grade){
				option += "<option value='"+ key +"'>"+ grade[key] +"</option>";
			}
			$("select[name='grade']").html(option);	
			
            return true;
        }
    });
	
	
	var mixLayer = null;

    function layerClose() {
        layer.close(mixLayer);
        mixLayer = null;
    }

    function layerOpen(title, url) {
        if (mixLayer) {
            layer.msg("请先关闭当前的弹出窗口");
        } else {
            mixLayer = layer.open({
                type: 2,
                area: ["90%", "90%"],
                title: title,
                content: url,
                anim: 2,
                maxmin: true,
                cancel: function () {
                    mixLayer = null;
                }
            });
        }
    }
	 $(function(){
		m.init();
		$('.datetime-picker').datetimepicker({format: 'YYYY-MM-DD'});
		// 
        $(document).on('click', '.role-edit', function () {
            var data = m.table.data()[$(this).attr('table-data')];
            if (data) {
                layerOpen(
                    "查看" + data["grade"] + "课程组合",
                    "<?=Url::toRoute(['choosetaskgroups/index'])?>?id=" + data['id']
                );
            }
        })
	});
</script>
<?php $this->endBlock(); ?>