<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"C:\xampp\htdocs\phpsystem\public/../application/back\view\student\student_query.html";i:1568719528;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/student.css" />

<div id="student_manage"></div>
<div id="student_manage_tool" style="padding:5px;">
	<div style="margin-bottom:5px;">
		<a href="#" class="easyui-linkbutton" iconCls="icon-edit-new" plain="true" onclick="student_manage_tool.edit();">修改</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-delete-new" plain="true" onclick="student_manage_tool.remove();">删除</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="true"  onclick="student_manage_tool.reload();">刷新</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="student_manage_tool.redo();">取消选择</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-export" plain="true" onclick="student_manage_tool.exportExcel();">导出到excel</a>
	</div>
	<div style="padding:0 0 0 7px;color:#333;">
		<form id="studentQueryForm" method="post">
			学号：<input type="text" class="textbox" id="studentNo" name="studentNo" style="width:110px" />
			姓名：<input type="text" class="textbox" id="name" name="name" style="width:110px" />
			生日：<input type="text" id="birthday" name="birthday" class="easyui-datebox" editable="false" style="width:100px">
			联系qq：<input type="text" class="textbox" id="qq" name="qq" style="width:110px" />
			手机：<input type="text" class="textbox" id="mobile" name="mobile" style="width:110px" />
			所在班级：<input class="textbox" type="text" id="classObj_classNo_query" name="classObj.classNo" style="width: auto"/>
			所在宿舍：<input class="textbox" type="text" id="susheObj_susheId_query" name="susheObj.susheId" style="width: auto"/>
			添加时间：<input type="text" id="addTime" name="addTime" class="easyui-datebox" editable="false" style="width:100px">
			<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="student_manage_tool.search();">查询</a>
		</form>	
	</div>
</div>

<div id="studentEditDiv">
	<form id="studentEditForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">学号:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="student_studentNo_edit" name="student_studentNo" style="width:200px" />
			</span>
		</div>
		<div>
			<span class="label">姓名:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="student_name_edit" name="student_name" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">性别:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="student_sex_edit" name="student_sex" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">学生照片:</span>
			<span class="inputControl">
				<img id="student_studentPhotoImg" width="200px" border="0px"/><br/>
    			<input type="hidden" id="student_studentPhoto" name="student_studentPhoto"/>
				<input id="studentPhotoFile" name="studentPhotoFile" type="file" size="50" />
			</span>
		</div>
		<div>
			<span class="label">生日:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="student_birthday_edit" name="student_birthday" />

			</span>

		</div>
		<div>
			<span class="label">联系qq:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="student_qq_edit" name="student_qq" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">手机:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="student_mobile_edit" name="student_mobile" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">所在班级:</span>
			<span class="inputControl">
				<input class="textbox"  id="student_classObj_classNo_edit" name="student_classObj_classNo" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">所在宿舍:</span>
			<span class="inputControl">
				<input class="textbox"  id="student_susheObj_susheId_edit" name="student_susheObj_susheId" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">添加时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="student_addTime_edit" name="student_addTime" />

			</span>

		</div>
	</form>
</div>
<script>
	var publicURL = "__PUBLIC__/";
	var backURL = "__PUBLIC__/index.php/back/";
</script>
<script type="text/javascript" src="__PUBLIC__/backjs/student/student_manage.js"></script>
