$(function () {
	$.ajax({
		url :  backURL + getVisitPath("Student") + "/update",
		type : "get",
		data : {
			studentNo : $("#student_studentNo_edit").val(),
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
				$(".messager-window").css("z-index",10000);
			}
		}
	});

	$("#studentModifyButton").click(function(){ 
		if ($("#studentEditForm").form("validate")) {
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
			$("#studentEditForm").submit();
		} else {
			$.messager.alert("错误提示","你输入的信息还有错误！","warning");
			$(".messager-window").css("z-index",10000);
		}
	});
});
