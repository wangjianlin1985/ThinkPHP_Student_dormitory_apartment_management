<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"C:\xampp\htdocs\phpsystem\public/../application/back\view\sushe\sushe_add.html";i:1568719529;}*/ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/backcss/sushe.css" />
<div id="susheAddDiv">
	<form id="susheAddForm" enctype="multipart/form-data"  method="post">
		<div>
			<span class="label">宿舍名称:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="sushe_susheName" name="sushe_susheName" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">床位总数:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="sushe_totalBedNum" name="sushe_totalBedNum" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">已用床位:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="sushe_usedBedNum" name="sushe_usedBedNum" style="width:80px" />

			</span>

		</div>
		<div>
			<span class="label">宿舍管理员:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="sushe_guanliyuan" name="sushe_guanliyuan" style="width:200px" />

			</span>

		</div>
		<div>
			<span class="label">宿舍备注:</span>
			<span class="inputControl">
				<textarea id="sushe_beizhu" name="sushe_beizhu" rows="6" cols="80"></textarea>

			</span>

		</div>
		<div>
			<span class="label">创建时间:</span>
			<span class="inputControl">
				<input class="textbox" type="text" id="sushe_addTime" name="sushe_addTime" />

			</span>

		</div>
		<div class="operation">
			<a id="susheAddButton" class="easyui-linkbutton">添加</a>
			<a id="susheClearButton" class="easyui-linkbutton">重填</a>
		</div> 
	</form>
</div>
<script> var backURL = "__PUBLIC__/index.php/back/";</script>
<script src="__PUBLIC__/backjs/sushe/sushe_add.js"></script>
