<?php
// 定义标题和面包屑信息
use \yii\helpers\Html;
use yii\helpers\Json;
use \backend\models\Auth;


$url = '@web/public/assets';
$depends = ['depends' => 'backend\assets\AdminAsset'];

$this->registerJsFile($url.'/js/chosen.jquery.min.js', $depends);
$this->registerCssFile($url.'/css/chosen.css', $depends);
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?> 
<script type="text/javascript">
	m = meTables({
		title: "学生管理",
		params:{'grade':'<?= $grade ?>'},
		fileSelector: ["#file"],
		operations: {
            "width": "auto",
            buttons: {'delete':{'bShow':false},'update':{'bShow':false},'see':{'bShow':false}},
        },
		buttons:{"create":{"bShow":false},"import":{"bShow":false},"refresh":{"bShow":false},"deleteAll":{"bShow":false},"export":{"bShow":false},"updateAll":{"bShow":false}},
		table: {
			"aoColumns": [
				{"title": "姓名", "data": "name", "sName": "name", "edit": {"type": "text","required": true, "rangelength": "[2, 5]"}, "search": {"type": "text"}, "bSortable": false}, 
			
			]       
		}
	});
   
	var $select = null;

    meTables.fn.extend({
        // 显示的前置和后置操作
        beforeShow: function(data, child) {
            $("#select-multiple").val([]).trigger("chosen:updated").next().css({'width': "100%"});
            return true;
        }
    });

     $(function(){
         m.init();

         // 选择表
         $select = $(".chosen-select").chosen({
             allow_single_deselect: false,
             width: "100%"
         });
     });
	
</script>
<?php $this->endBlock(); ?>
<div class="well">
    <form id="search-form" method="get">
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">管理员</label>
                    <div class="col-sm-10">
                        <?=Html::dropDownList('grade',null,$arrRoles,
                            [
                                'multiple' => 'multiple',
                                'class' => 'chosen-select tag-input-style',
                                'data-placeholder' => '请选择班级',
                            ]
                        )?>
                    </div>
                </div>
            </div>
        </div>
		<input type="hidden" value="promotion" name="action">
        <div class="row">
            <div class="col-xs-12 pull-right" style="margin-top: 10px;">
                <div class="pull-right" id="me-table-buttons">
                    <button class="btn btn-info btn-sm">
                        确认
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
