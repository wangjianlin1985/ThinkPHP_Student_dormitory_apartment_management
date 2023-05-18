<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"C:\xampp\htdocs\phpsystem\public/../application/back\view\student\student_add.html";i:1568720345;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/student.css" />
<div id="studentAddDiv">
	<form id="studentAddForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">学号:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="student_studentNo" name="student_studentNo" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">姓名:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="student_name" name="student_name" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">性别:</span>
			<span class="inputControl">
				<select id="student_sex" name="student_sex" style="width:200px;">
                	<option value="男">男</option>
                    <option value="女">女</option>
                </select>
			</span>

		</div>
		<div>
			<span class="label">学生照片:</span>
			<span class="inputControl">
				<input id="studentPhotoFile" name="studentPhotoFile" type="file" size="50" />
			</span>
		</div>
		<div>
			<span class="label">生日:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="student_birthday" name="student_birthday" />

			</span>

		</div>
		<div>
			<span class="label">联系qq:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="student_qq" name="student_qq" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">手机:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="student_mobile" name="student_mobile" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">所在班级:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="student_classObj_classNo" name="student.classObj.classNo" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">所在宿舍:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="student_susheObj_susheId" name="student.susheObj.susheId" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">添加时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="student_addTime" name="student_addTime" />

			</span>

		</div>
		<div class="operation">
			<a id="studentAddButton" class="easyui-linkbutton">添加</a>
			<a id="studentClearButton" class="easyui-linkbutton">重填</a>
		</div> 
	</form>
</div>
<script> var backURL = "__PUBLIC__/index.php/back/";</script>
<script src="__PUBLIC__/backjs/student/student_add.js"></script>
