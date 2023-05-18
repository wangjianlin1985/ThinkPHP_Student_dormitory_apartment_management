$(function () {
	$.ajax({
		url :  backURL + getVisitPath("Fangke") + "/update",
		type : "get",
		data : {
			fangkeId : $("#fangke_fangkeId_edit").val(),
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
				$(".messager-window").css("z-index",10000);
			}
		}
	});

	$("#fangkeModifyButton").click(function(){ 
		if ($("#fangkeEditForm").form("validate")) {
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
                	var obj = jQuery.parseJSON(data);
                    if(obj.success){
                        $.messager.alert("消息","信息修改成功！");
                        $(".messager-window").css("z-index",10000);
                        //location.href="frontlist";
                    }else{
                        $.messager.alert("消息",obj.message);
                        $(".messager-window").css("z-index",10000);
                    } 
			    }
			});
			//提交表单
			$("#fangkeEditForm").submit();
		} else {
			$.messager.alert("错误提示","你输入的信息还有错误！","warning");
			$(".messager-window").css("z-index",10000);
		}
	});
});
