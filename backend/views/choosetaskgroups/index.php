<?php

use yii\helpers\Url;
use yii\helpers\Json;
use \backend\models\Auth;

// 获取权限
$auth = Auth::getDataTableAuth('choosetaskgroups');
// 定义标题和面包屑信息
// 定义标题和面包屑信息
$this->title = '选课组合表';
$url = '@web/public/assets';
$depends = ['depends' => 'backend\assets\AdminAsset'];

$this->registerJsFile($url.'/js/chosen.jquery.min.js', $depends);
$this->registerCssFile($url.'/css/chosen.css', $depends);
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
	var oOperationsButtons = <?=Json::encode($auth['operations'])?>;
	oOperationsButtons.see = {"cClass": "role-see"};
	oOperationsButtons.other = {
        bShow: <?=Yii::$app->user->can('chootaskstudents/index') ? 'true' : 'false' ?>,
        "title": "选课结果",
        "button-title": "选课结果",
        "className": "btn-warning",
        "cClass": "role-edit",
        "icon": "fa-pencil-square-o",
        "sClass": "yellow"
    };  
	
    var tasks = <?php echo $tasks ?>,
	courses = <?php echo $courses ?>,
	m = meTables({
        title: "选课组合表",
		params:{'choosetaskid':'<?= $id ?>'},
		operations: {
            width: "200px",
            buttons: oOperationsButtons
        },
        table: {
            "aoColumns": [
            {"title": "id", "data": "id", "sName": "id", "isHide":true, "edit": {"type": "hidden", "required": true,"number": true}, "bSortable": false}, 
			{"title": "任务", "data": "choosetaskid", "sName": "choosetaskid", "value": tasks, "edit": {"type": "select", "number": true}, "bSortable": false, "createdCell": function (td, data) {$(td).html(tasks[data]? tasks[data] : data);}}, 
			{"title": "课程", "data": "coursegroupids", "sName": "coursegroupids","value": courses, 
				"edit": {
				"type": "select",
				"multiple": true,
				"id": "select-multiple",
				"required": true,
				"class": "tag-input-style width-100 chosen-select",
				"data-placeholder": "请选择课程"
				}, "bSortable": false
			}, 
			{"title": "课程名称", "data": "coursegroupname", "sName": "coursegroupname", "edit": {"type": "hidden"}, "bSortable": false}, 
			
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

    var $select = null;
	
	meTables.fn.extend({
        beforeShow: function(data) { 
			
			$("#select-multiple").val(data?data.coursegroupids.split(','):[]).trigger("chosen:updated").next().css({'width': "100%"});
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
	 // 选择表
	 $select = $(".chosen-select").chosen({
		 allow_single_deselect: false,
		 width: "100%"
	 });
	 $(document).on('click', '.role-edit', function () {
            var data = m.table.data()[$(this).attr('table-data')];
            if (data) {
                layerOpen(
                    "查看学生选课结果",
                    "<?=Url::toRoute(['chootaskstudents/index'])?>?id=" + data['id']
                );
            }
        })
	});
</script>
<?php $this->endBlock(); ?>