<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"C:\xampp\htdocs\phpsystem\public/../application/back\view\fangke\fangke_add.html";i:1568719529;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/fangke.css" />
<div id="fangkeAddDiv">
	<form id="fangkeAddForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">访客姓名:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="fangke_fangkeName" name="fangke_fangkeName" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">受访学生:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="fangke_studentObj_studentNo" name="fangke.studentObj.studentNo" style="width: auto"/>
			</span>
		</div>
		<div>
			<span class="label">关系:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="fangke_guanxi" name="fangke_guanxi" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">进入时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="fangke_inTime" name="fangke_inTime" />

			</span>

		</div>
		<div>
			<span class="label">离开时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="fangke_leaveTime" name="fangke_leaveTime" />

			</span>

		</div>
		<div>
			<span class="label">创建时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="fangke_addTime" name="fangke_addTime" />

			</span>

		</div>
		<div class="operation">
			<a id="fangkeAddButton" class="easyui-linkbutton">添加</a>
			<a id="fangkeClearButton" class="easyui-linkbutton">重填</a>
		</div> 
	</form>
</div>
<script> var backURL = "__PUBLIC__/index.php/back/";</script>
<script src="__PUBLIC__/backjs/fangke/fangke_add.js"></script>
