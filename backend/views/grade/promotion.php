<?php
use yii\helpers\Url;
// 定义标题和面包屑信息
$this->title = '升班';

?>

<div class="dropdown">
	<button type="button" class="btn dropdown-toggle" id="dropdownMenu1" 
			data-toggle="dropdown">
		主题
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
		<li role="presentation">
			<a role="menuitem" tabindex="-1" href="#">Java</a>
		</li>
		<li role="presentation">
			<a role="menuitem" tabindex="-1" href="#">数据挖掘</a>
		</li>
		<li role="presentation">
			<a role="menuitem" tabindex="-1" href="#">数据通信/网络</a>
		</li>
		<li role="presentation" class="divider"></li>
		<li role="presentation">
			<a role="menuitem" tabindex="-1" href="#">分离的链接</a>
		</li>
	</ul>
</div>
<hr>
<button class="btn btn-prev">
	<i class="ace-icon fa fa-arrow-left"></i>确认
</button>
<button class="btn btn-success btn-next">
	取消<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
</button>
