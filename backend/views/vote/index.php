<?php

use yii\helpers\Url;
use yii\helpers\Json;
use \backend\models\Auth;
// 定义标题和面包屑信息
$this->title = '投票信息';
// 获取权限
$auth = Auth::getDataTableAuth('vote');
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
	
	var oButtons = <?=Json::encode($auth['buttons'])?>,
        oOperationsButtons = <?=Json::encode($auth['operations'])?>;

    //oButtons.updateAll = {bShow: false};
    //oButtons.deleteAll = {bShow: false};
    oOperationsButtons.other = {
        bShow: true,
        "title": "查看结果",
        "button-title": "查看结果",
        "className": "btn-warning",
        "cClass": "vote-see",
        "icon": "fa-pencil-square-o",
        "sClass": "yellow"
    };
	
    var m = meTables({		
        title: "投票信息",
		bCheckbox: false,
        buttons: oButtons,
        operations: {
            width: "200px",
            buttons: oOperationsButtons
        },
		
        table: {
            "aoColumns": [
			{"title": "id", "data": "id", "sName": "id","edit": {"type": "hidden"}, "bSortable": false}, 
			{"title": "学校编号", "data": "sid", "sName": "sid", "bSortable": false}, 
			{"title": "标题", "data": "title", "sName": "title", "edit": {"type": "text", "rangelength": "[2, 50]"}, "bSortable": false}, 
			{"title": "内容", "data": "content", "sName": "content", "edit": {"type": "text", "rangelength": "[2, 255]"}, "bSortable": false}, 
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
	/**/
	mt.fn.extend({
        beforeShow: function (data) {
            if (this.action === "update") {
                data.newName = data.name;
            }
 
            return true;
        },
        afterShow: function () {
            $(this.options.sFormId).find('input[name=type]').val(iType);
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
		 
        $(document).on('click', '.vote-see', function () {
            var data = m.table.data()[$(this).attr('table-data')];
            if (data) {
                layerOpen(
                    "查看选项",
                    "<?=Url::toRoute(['vote-option/index'])?>?id=" + data['id']		
                );
            }
        });
		
     });
</script>
<?php $this->endBlock(); ?>