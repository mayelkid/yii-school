<?php
// 定义标题和面包屑信息
// 定义标题和面包屑信息
use yii\helpers\Url;
use yii\helpers\Json;
use \backend\models\Auth;

// 获取权限
$auth = Auth::getDataTableAuth('grade');

$this->title = '年级管理';
$url = '@web/public/assets';
$depends = ['depends' => 'backend\assets\AdminAsset'];
$this->registerJsFile($url.'/js/date-time/moment.min.js', $depends);
$this->registerJsFile($url.'/js/date-time/bootstrap-datetimepicker.min.js', $depends);
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
	var grade = <?php echo $grades ?>;
	var teachers = <?php echo $teachers ?>;
	var classrooms = <?php echo $classrooms ?>;
	oOperationsButtons = <?=Json::encode($auth['operations'])?>;

    //oButtons.updateAll = {bShow: false};
    //oButtons.deleteAll = {bShow: false};
    oOperationsButtons.other = {
        bShow: true,
        "title": "升班",
        "button-title": "升班",
        "className": "btn-warning",
        "cClass": "grade-promotion",
        "icon": "fa-pencil-square-o",
        "sClass": "yellow"
    };
    var m = meTables({
        title: "年级管理",
		operations: {
            width: "200px",
            buttons: oOperationsButtons
        },
        table: {
            "aoColumns": [
            {"title": "ID", "data": "id", "sName": "id", "isHide": true,"edit": {"type": "hidden","number": true}}, 
			{"title": "班级编号", "data": "cid", "sName": "cid", "edit": {"type": "text","number": true, "rangelength": "[1, 4]",placeholder:"若不填，则自动生成"},"bSortable": false}, 
			{"title": "所属年级", "data": "pid", "sName": "pid", "isHide": true, "value": grade, "edit": {"type": "select"}, "bSortable": false, "createdCell": function (td, data) {$(td).html(grade[data] ? grade[data] : data);}},
			{"title": "班级名称", "data": "name", "sName": "name", "edit": {"type": "text", "rangelength": "[2, 10]"}, "bSortable": false}, 
			{"title": "班主任", "data": "manager", "sName": "manager", "value": teachers, "edit": {"type": "select", }, "bSortable": false, "createdCell": function (td, data) {$(td).html(teachers[data] ? teachers[data] : data);}},  
			{"title": "授课教室", "data": "classroom", "sName": "classroom", "value": classrooms, "edit": {"type": "select", }, "bSortable": false, "createdCell": function (td, data) {$(td).html(classrooms[data] ? classrooms[data] : data);}},  

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
			var option = 0;
			for(var key in grade){
				option += "<option value='"+ key +"'>"+ grade[key] +"</option>";
			}
			$("select[name='pid']").html(option);				
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
        $(document).on('click', '.grade-promotion', function () {
            var data = m.table.data()[$(this).attr('table-data')];
            if (data) {
                layerOpen(
                    "查看" + data["name"] + "升班",
                    "<?=Url::toRoute(['student/promotion'])?>?grade=" + data['cid']
                );
            }
        })
	});
</script>
<?php $this->endBlock(); ?>