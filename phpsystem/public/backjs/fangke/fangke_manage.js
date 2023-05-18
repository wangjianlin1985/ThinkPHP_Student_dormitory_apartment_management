var fangke_manage_tool = null; 
$(function () { 
	initFangkeManageTool(); //建立Fangke管理对象
	fangke_manage_tool.init(); //如果需要通过下拉框查询，首先初始化下拉框的值
	$("#fangke_manage").datagrid({
		url : backURL + getVisitPath("Fangke") + '/backList',
		fit : true,
		fitColumns : true,
		striped : true,
		rownumbers : true,
		border : false,
		pagination : true,
		pageSize : 5,
		pageList : [5, 10, 15, 20, 25],
		pageNumber : 1,
		sortName : "fangkeId",
		sortOrder : "desc",
		toolbar : "#fangke_manage_tool",
		columns : [[
			{
				field : "fangkeId",
				title : "访客ID",
				width : 70,
			},
			{
				field : "fangkeName",
				title : "访客姓名",
				width : 140,
			},
			{
				field : "studentObj",
				title : "受访学生",
				width : 140,
			},
			{
				field : "guanxi",
				title : "关系",
				width : 140,
			},
			{
				field : "inTime",
				title : "进入时间",
				width : 140,
			},
			{
				field : "leaveTime",
				title : "离开时间",
				width : 140,
			},
			{
				field : "addTime",
				title : "创建时间",
				width : 140,
			},
		]],
	});

	$("#fangkeEditDiv").dialog({
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
				if ($("#fangkeEditForm").form("validate")) {
					//验证表单 
					if(!$("#fangkeEditForm").form("validate")) {
						$.messager.alert("错误提示","你输入的信息还有错误！","warning");
					} else {
						$("#fangkeEditForm").form({
						    url: backURL + getVisitPath("Fangke") + "/update",
						    onSubmit: function(){
								if($("#fangkeEditForm").form("validate"))  {
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
			                        $("#fangkeEditDiv").dialog("close");
			                        fangke_manage_tool.reload();
			                    }else{
			                        $.messager.alert("消息",obj.message);
			                    } 
						    }
						});
						//提交表单
						$("#fangkeEditForm").submit();
					}
				}
			},
		},{
			text : "取消",
			iconCls : "icon-redo",
			handler : function () {
				$("#fangkeEditDiv").dialog("close");
				$("#fangkeEditForm").form("reset"); 
			},
		}],
	});
});

function initFangkeManageTool() {
	fangke_manage_tool = {
		init: function() {
			$.ajax({
				url : backURL + getVisitPath("Student") + "/listAll",
				type : "post",
				dataType: "json",
				success : function (data, response, status) {
					$("#studentObj_studentNo_query").combobox({ 
					    valueField:"studentNo",
					    textField:"name",
					    panelHeight: "200px",
				        editable: false, //不允许手动输入 
					});
					data.splice(0,0,{studentNo:"",name:"不限制"});
					$("#studentObj_studentNo_query").combobox("loadData",data); 
				}
			});
		},
		reload : function () {
			$("#fangke_manage").datagrid("reload");
		},
		redo : function () {
			$("#fangke_manage").datagrid("unselectAll");
		},
		search: function() {
			var queryParams = $("#fangke_manage").datagrid("options").queryParams;
			queryParams["fangkeName"] = $("#fangkeName").val();
			queryParams["studentObj.studentNo"] = $("#studentObj_studentNo_query").combobox("getValue");
			queryParams["inTime"] = $("#inTime").datebox("getValue"); 
			queryParams["leaveTime"] = $("#leaveTime").datebox("getValue"); 
			$("#fangke_manage").datagrid("options").queryParams=queryParams; 
			$("#fangke_manage").datagrid("load");
		},
		exportExcel: function() {
			$("#fangkeQueryForm").form({
			    url: backURL + getVisitPath("Fangke") + "/outToExcel",
			});
			//提交表单
			$("#fangkeQueryForm").submit();
		},
		remove : function () {
			var rows = $("#fangke_manage").datagrid("getSelections");
			if (rows.length > 0) {
				$.messager.confirm("确定操作", "您正在要删除所选的记录吗？", function (flag) {
					if (flag) {
						var fangkeIds = [];
						for (var i = 0; i < rows.length; i ++) {
							fangkeIds.push(rows[i].fangkeId);
						}
						$.ajax({
							type : "POST",
							url :  backURL + getVisitPath("Fangke") + "/deletes",
							data : {
								fangkeIds : fangkeIds.join(","),
							},
							dataType: "json",
							beforeSend : function () {
								$("#fangke_manage").datagrid("loading");
							},
							success : function (data) {
								if (data.success) {
									$("#fangke_manage").datagrid("loaded");
									$("#fangke_manage").datagrid("load");
									$("#fangke_manage").datagrid("unselectAll");
									$.messager.show({
										title : "提示",
										msg : data.message
									});
								} else {
									$("#fangke_manage").datagrid("loaded");
									$("#fangke_manage").datagrid("load");
									$("#fangke_manage").datagrid("unselectAll");
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
			var rows = $("#fangke_manage").datagrid("getSelections");
			if (rows.length > 1) {
				$.messager.alert("警告操作！", "编辑记录只能选定一条数据！", "warning");
			} else if (rows.length == 1) {
				$.ajax({
					url : backURL + getVisitPath("Fangke") + "/update",
					type : "get",
					data : {
						fangkeId : rows[0].fangkeId,
					},
					dataType: "json",
					beforeSend : function () {
						$.messager.progress({
							text : "正在获取中...",
						});
					},
					success : function (fangke, response, status) {
						$.messager.progress("close");
						if (fangke) { 
							$("#fangkeEditDiv").dialog("open");
							$("#fangke_fangkeId_edit").val(fangke.fangkeId);
							$("#fangke_fangkeId_edit").validatebox({
								required : true,
								missingMessage : "请输入访客ID",
								editable: false
							});
							$("#fangke_fangkeName_edit").val(fangke.fangkeName);
							$("#fangke_fangkeName_edit").validatebox({
								required : true,
								missingMessage : "请输入访客姓名",
							});
							$("#fangke_studentObj_studentNo_edit").combobox({
							    url: backURL + getVisitPath("Student") + "/listAll",
							    dataType: "json",
							    valueField:"studentNo",
							    textField:"name",
							    panelHeight: "auto",
						        editable: false, //不允许手动输入 
						        onLoadSuccess: function () { //数据加载完毕事件
									$("#fangke_studentObj_studentNo_edit").combobox("select", fangke.studentObj);
									//var data = $("#fangke_studentObj_studentNo_edit").combobox("getData"); 
						            //if (data.length > 0) {
						                //$("#fangke_studentObj_studentNo_edit").combobox("select", data[0].studentNo);
						            //}
								}
							});
							$("#fangke_guanxi_edit").val(fangke.guanxi);
							$("#fangke_guanxi_edit").validatebox({
								required : true,
								missingMessage : "请输入关系",
							});
							$("#fangke_inTime_edit").datetimebox({
								value: fangke.inTime,
							    required: true,
							    showSeconds: true,
							});
							$("#fangke_leaveTime_edit").datetimebox({
								value: fangke.leaveTime,
							    required: true,
							    showSeconds: true,
							});
							$("#fangke_addTime_edit").datetimebox({
								value: fangke.addTime,
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
