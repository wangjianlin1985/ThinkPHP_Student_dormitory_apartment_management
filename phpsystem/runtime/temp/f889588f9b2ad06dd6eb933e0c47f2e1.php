<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"C:\xampp\htdocs\phpsystem\public/../application/back\view\fangke\fangke_query.html";i:1568719529;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/fangke.css" />

<div id="fangke_manage"></div>
<div id="fangke_manage_tool" style="padding:5px;">
	<div style="margin-bottom:5px;">
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit-new" plain="true" onclick="fangke_manage_tool.edit();">修改</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-delete-new" plain="true" onclick="fangke_manage_tool.remove();">删除</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="true"  onclick="fangke_manage_tool.reload();">刷新</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="fangke_manage_tool.redo();">取消选择</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-export" plain="true" onclick="fangke_manage_tool.exportExcel();">导出到excel</a>
	</div>
	<div style="padding:0 0 0 7px;color:#333;">
		<form id="fangkeQueryForm" method="post">
			访客姓名：<input type="text" class="textbox" id="fangkeName" name="fangkeName" style="width:110px" />
			受访学生：<input class="textbox" type="text" id="studentObj_studentNo_query" name="studentObj.studentNo" style="width: auto"/>
			进入时间：<input type="text" id="inTime" name="inTime" class="easyui-datebox" editable="false" style="width:100px">
			离开时间：<input type="text" id="leaveTime" name="leaveTime" class="easyui-datebox" editable="false" style="width:100px">
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="fangke_manage_tool.search();">查询</a>
		</form>	
	</div>
</div>

<div id="fangkeEditDiv">
	<form id="fangkeEditForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">访客ID:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="fangke_fangkeId_edit" name="fangke_fangkeId" style="width:200px" />
			</span>
		</div>
		<div>
			<span class="label">访客姓名:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="fangke_fangkeName_edit" name="fangke_fangkeName" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">受访学生:</span>
			<span class="inputControl">
				<input class="textbox"  id="fangke_studentObj_studentNo_edit" name="fangke_studentObj_studentNo" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">关系:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="fangke_guanxi_edit" name="fangke_guanxi" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">进入时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="fangke_inTime_edit" name="fangke_inTime" />

			</span>

		</div>
		<div>
			<span class="label">离开时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="fangke_leaveTime_edit" name="fangke_leaveTime" />

			</span>

		</div>
		<div>
			<span class="label">创建时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="fangke_addTime_edit" name="fangke_addTime" />

			</span>

		</div>
	</form>
</div>
<script>
	var publicURL = "__PUBLIC__/";
	var backURL = "__PUBLIC__/index.php/back/";
</script>
<script type="text/javascript" src="__PUBLIC__/backjs/fangke/fangke_manage.js"></script>
