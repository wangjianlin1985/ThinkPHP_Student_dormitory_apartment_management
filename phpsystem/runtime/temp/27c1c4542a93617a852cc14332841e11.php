<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"C:\xampp\htdocs\phpsystem\public/../application/back\view\sushe\sushe_query.html";i:1568719529;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/sushe.css" />

<div id="sushe_manage"></div>
<div id="sushe_manage_tool" style="padding:5px;">
	<div style="margin-bottom:5px;">
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit-new" plain="true" onclick="sushe_manage_tool.edit();">修改</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-delete-new" plain="true" onclick="sushe_manage_tool.remove();">删除</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="true"  onclick="sushe_manage_tool.reload();">刷新</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="sushe_manage_tool.redo();">取消选择</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-export" plain="true" onclick="sushe_manage_tool.exportExcel();">导出到excel</a>
	</div>
	<div style="padding:0 0 0 7px;color:#333;">
		<form id="susheQueryForm" method="post">
			宿舍名称：<input type="text" class="textbox" id="susheName" name="susheName" style="width:110px" />
			宿舍管理员：<input type="text" class="textbox" id="guanliyuan" name="guanliyuan" style="width:110px" />
			创建时间：<input type="text" id="addTime" name="addTime" class="easyui-datebox" editable="false" style="width:100px">
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="sushe_manage_tool.search();">查询</a>
		</form>	
	</div>
</div>

<div id="susheEditDiv">
	<form id="susheEditForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">宿舍ID:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="sushe_susheId_edit" name="sushe_susheId" style="width:200px" />
			</span>
		</div>
		<div>
			<span class="label">宿舍名称:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="sushe_susheName_edit" name="sushe_susheName" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">床位总数:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="sushe_totalBedNum_edit" name="sushe_totalBedNum" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">已用床位:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="sushe_usedBedNum_edit" name="sushe_usedBedNum" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">宿舍管理员:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="sushe_guanliyuan_edit" name="sushe_guanliyuan" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">宿舍备注:</span>
			<span class="inputControl">
				<textarea id="sushe_beizhu_edit" name="sushe_beizhu" rows="8" cols="60"></textarea>

			</span>

		</div>
		<div>
			<span class="label">创建时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="sushe_addTime_edit" name="sushe_addTime" />

			</span>

		</div>
	</form>
</div>
<script>
	var publicURL = "__PUBLIC__/";
	var backURL = "__PUBLIC__/index.php/back/";
</script>
<script type="text/javascript" src="__PUBLIC__/backjs/sushe/sushe_manage.js"></script>
