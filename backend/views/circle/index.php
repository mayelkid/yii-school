<?php
// 定义标题和面包屑信息
$this->title = '班级圈';
?>
<?=\backend\widgets\MeTable::widget()?>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
    var	aStatus = ['否','是'],
	grades = ['全园','仅老师','仅家长'],
	m = meTables({
        title: "班级圈",
		fileSelector: ["#file"],
        table: {
            "aoColumns": [
			{"title": "id", "data": "id", "sName": "id","edit": {"type": "hidden"}, "bSortable": false}, 
            {"title": "学校编号", "data": "sid", "sName": "sid", "bSortable": false}, 
            {"title": "阅读权限", "data": "arcrank", "sName": "arcrank","value": grades, "edit": {"type": "select"}, "bSortable": false,"createdCell": function (td, data) {$(td).html(grades[data]);}}, 
            
            {"title": "标题", "data": "title", "sName": "title", "edit": {"type": "text", "rangelength": "[2, 50]"}, "bSortable": false}, 
            {"title": "内容", "data": "content", "sName": "content", "edit": {"type": "textarea", "rangelength": "[2, 500]"}, "bSortable": false}, 
			{"title": "图片", "data": "pic", "sName": "pic", "isHide": true, "edit": {"type": "file", options: {"id": "file","name": "UploadForm[pic]","input-name": "pic","input-type": "ace_file","file-name": "pic"}}, "bSortable": false}, 
			{"title": "视频", "data": "video", "sName": "video", "edit": {"type": "text", "rangelength": "[2, 500]"}, "bSortable": false}, 
            {"title": "评论数", "data": "num", "sName": "num",  "bSortable": false}, 
            {"title": "点赞数", "data": "likenum", "sName": "likenum", "bSortable": false}, 
            {"title": "发布人", "data": "mid", "sName": "mid",  "bSortable": false}, 
			{"title": "点击量", "data": "click", "sName": "click", "bSortable": false}, 
            {"title": "是否可查看", "data": "is_show", "sName": "is_show", "value": aStatus,"edit": {"type": "radio", "default": 10, "required": true, "number": true},"bSortable": false,"search": {"type": "select"}},
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