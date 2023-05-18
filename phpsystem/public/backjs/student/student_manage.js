var student_manage_tool = null; 
$(function () { 
	initStudentManageTool(); //建立Student管理对象
	student_manage_tool.init(); //如果需要通过下拉框查询，首先初始化下拉框的值
	$("#student_manage").datagrid({
		url : backURL + getVisitPath("Student") + '/backList',
		fit : true,
		fitColumns : true,
		striped : true,
		rownumbers : true,
		border : false,
		pagination : true,
		pageSize : 5,
		pageList : [5, 10, 15, 20, 25],
		pageNumber : 1,
		sortName : "studentNo",
		sortOrder : "desc",
		toolbar : "#student_manage_tool",
		columns : [[
			{
				field : "studentNo",
				title : "学号",
				width : 140,
			},
			{
				field : "name",
				title : "姓名",
				width : 140,
			},
			{
				field : "sex",
				title : "性别",
				width : 140,
			},
			{
				field : "studentPhoto",
				title : "学生照片",
				width : "70px",
				height: "65px",
				formatter: function(val,row) {
					return "<img src='" + publicURL + val + "' width='65px' height='55px' />";
				}
 			},
			{
				field : "birthday",
				title : "生日",
				width : 140,
			},
			{
				field : "qq",
				title : "联系qq",
				width : 140,
			},
			{
				field : "mobile",
				title : "手机",
				width : 140,
			},
			{
				field : "classObj",
				title : "所在班级",
				width : 140,
			},
			{
				field : "susheObj",
				title : "所在宿舍",
				width : 140,
			},
			{
				field : "addTime",
				title : "添加时间",
				width : 140,
			},
		]],
	});

	$("#studentEditDiv").dialog({
		title : "修改管理",
		top: "50px",
		width : 700,
		height : 515,
		modal : true,
		closed : true,
		iconCls : "icon-edit-new",
		buttons : [{
			text : "提交",
			iconCls : "icon-edit-new",
			handler : function () {
				if ($("#studentEditForm").form("validate")) {
					//验证表单 
					if(!$("#studentEditForm").form("validate")) {
						$.messager.alert("错误提示","你输入的信息还有错误！","warning");
					} else {
						$("#studentEditForm").form({
						    url: backURL + getVisitPath("Student") + "/update",
						    onSubmit: function(){
								if($("#studentEditForm").form("validate"))  {
				                	$.messager.progress({
										text : "正在提交数据中...",
									});
				                	return true;
				                } else { 
				                    return false; 
				                }
						    },
						    success:function(data){
						    	$.messager.progress("close");
						    	console.log(data);
			                	var obj = jQuery.parseJSON(data);
			                    if(obj.success){
			                        $.messager.alert("消息","信息修改成功！");
			                        $("#studentEditDiv").dialog("close");
			                        student_manage_tool.reload();
			                    }else{
			                        $.messager.alert("消息",obj.message);
			                    } 
						    }
						});
						//提交表单
						$("#studentEditForm").submit();
					}
				}
			},
		},{
			text : "取消",
			iconCls : "icon-redo",
			handler : function () {
				$("#studentEditDiv").dialog("close");
				$("#studentEditForm").form("reset"); 
			},
		}],
	});
});

function initStudentManageTool() {
	student_manage_tool = {
		init: function() {
			$.ajax({
				url : backURL + getVisitPath("ClassInfo") + "/listAll",
				type : "post",
				dataType: "json",
				success : function (data, response, status) {
					$("#classObj_classNo_query").combobox({ 
					    valueField:"classNo",
					    textField:"className",
					    panelHeight: "200px",
				        editable: false, //不允许手动输入 
					});
					data.splice(0,0,{classNo:"",className:"不限制"});
					$("#classObj_classNo_query").combobox("loadData",data); 
				}
			});
			$.ajax({
				url : backURL + getVisitPath("Sushe") + "/listAll",
				type : "post",
				dataType: "json",
				success : function (data, response, status) {
					$("#susheObj_susheId_query").combobox({ 
					    valueField:"susheId",
					    textField:"susheName",
					    panelHeight: "200px",
				        editable: false, //不允许手动输入 
					});
					data.splice(0,0,{susheId:0,susheName:"不限制"});
					$("#susheObj_susheId_query").combobox("loadData",data); 
				}
			});
		},
		reload : function () {
			$("#student_manage").datagrid("reload");
		},
		redo : function () {
			$("#student_manage").datagrid("unselectAll");
		},
		search: function() {
			var queryParams = $("#student_manage").datagrid("options").queryParams;
			queryParams["studentNo"] = $("#studentNo").val();
			queryParams["name"] = $("#name").val();
			queryParams["birthday"] = $("#birthday").datebox("getValue"); 
			queryParams["qq"] = $("#qq").val();
			queryParams["mobile"] = $("#mobile").val();
			queryParams["classObj.classNo"] = $("#classObj_classNo_query").combobox("getValue");
			queryParams["susheObj.susheId"] = $("#susheObj_susheId_query").combobox("getValue");
			queryParams["addTime"] = $("#addTime").datebox("getValue"); 
			$("#student_manage").datagrid("options").queryParams=queryParams; 
			$("#student_manage").datagrid("load");
		},
		exportExcel: function() {
			$("#studentQueryForm").form({
			    url: backURL + getVisitPath("Student") + "/outToExcel",
			});
			//提交表单
			$("#studentQueryForm").submit();
		},
		remove : function () {
			var rows = $("#student_manage").datagrid("getSelections");
			if (rows.length > 0) {
				$.messager.confirm("确定操作", "您正在要删除所选的记录吗？", function (flag) {
					if (flag) {
						var studentNos = [];
						for (var i = 0; i < rows.length; i ++) {
							studentNos.push(rows[i].studentNo);
						}
						$.ajax({
							type : "POST",
							url :  backURL + getVisitPath("Student") + "/deletes",
							data : {
								studentNos : studentNos.join(","),
							},
							dataType: "json",
							beforeSend : function () {
								$("#student_manage").datagrid("loading");
							},
							success : function (data) {
								if (data.success) {
									$("#student_manage").datagrid("loaded");
									$("#student_manage").datagrid("load");
									$("#student_manage").datagrid("unselectAll");
									$.messager.show({
										title : "提示",
										msg : data.message
									});
								} else {
									$("#student_manage").datagrid("loaded");
									$("#student_manage").datagrid("load");
									$("#student_manage").datagrid("unselectAll");
									$.messager.alert("消息",data.message);
								}
							},
						});
					}
				});
			} else {
				$.messager.alert("提示", "请选择要删除的记录！", "info");
			}
		},
		edit : function () {
			var rows = $("#student_manage").datagrid("getSelections");
			if (rows.length > 1) {
				$.messager.alert("警告操作！", "编辑记录只能选定一条数据！", "warning");
			} else if (rows.length == 1) {
				$.ajax({
					url : backURL + getVisitPath("Student") + "/update",
					type : "get",
					data : {
						studentNo : rows[0].studentNo,
					},
					dataType: "json",
					beforeSend : function () {
						$.messager.progress({
							text : "正在获取中...",
						});
					},
					success : function (student, response, status) {
						$.messager.progress("close");
						if (student) { 
							$("#studentEditDiv").dialog("open");
							$("#student_studentNo_edit").val(student.studentNo);
							$("#student_studentNo_edit").validatebox({
								required : true,
								missingMessage : "请输入学号",
								editable: false
							});
							$("#student_name_edit").val(student.name);
							$("#student_name_edit").validatebox({
								required : true,
								missingMessage : "请输入姓名",
							});
							$("#student_sex_edit").val(student.sex);
							$("#student_sex_edit").validatebox({
								required : true,
								missingMessage : "请输入性别",
							});
							$("#student_studentPhoto").val(student.studentPhoto);
							$("#student_studentPhotoImg").attr("src", publicURL + student.studentPhoto);
							$("#student_birthday_edit").datebox({
								value: student.birthday,
							    required: true,
							    showSeconds: true,
							});
							$("#student_qq_edit").val(student.qq);
							$("#student_qq_edit").validatebox({
								required : true,
								missingMessage : "请输入联系qq",
							});
							$("#student_mobile_edit").val(student.mobile);
							$("#student_mobile_edit").validatebox({
								required : true,
								missingMessage : "请输入手机",
							});
							$("#student_classObj_classNo_edit").combobox({
							    url: backURL + getVisitPath("ClassInfo") + "/listAll",
							    dataType: "json",
							    valueField:"classNo",
							    textField:"className",
							    panelHeight: "auto",
						        editable: false, //不允许手动输入 
						        onLoadSuccess: function () { //数据加载完毕事件
									$("#student_classObj_classNo_edit").combobox("select", student.classObj);
									//var data = $("#student_classObj_classNo_edit").combobox("getData"); 
						            //if (data.length > 0) {
						                //$("#student_classObj_classNo_edit").combobox("select", data[0].classNo);
						            //}
								}
							});
							$("#student_susheObj_susheId_edit").combobox({
							    url: backURL + getVisitPath("Sushe") + "/listAll",
							    dataType: "json",
							    valueField:"susheId",
							    textField:"susheName",
							    panelHeight: "auto",
						        editable: false, //不允许手动输入 
						        onLoadSuccess: function () { //数据加载完毕事件
									$("#student_susheObj_susheId_edit").combobox("select", student.susheObj);
									//var data = $("#student_susheObj_susheId_edit").combobox("getData"); 
						            //if (data.length > 0) {
						                //$("#student_susheObj_susheId_edit").combobox("select", data[0].susheId);
						            //}
								}
							});
							$("#student_addTime_edit").datetimebox({
								value: student.addTime,
							    required: true,
							    showSeconds: true,
							});
						} else {
							$.messager.alert("获取失败！", "未知错误导致失败，请重试！", "warning");
						}
					}
				});
			} else if (rows.length == 0) {
				$.messager.alert("警告操作！", "编辑记录至少选定一条数据！", "warning");
			}
		},
	};
}
