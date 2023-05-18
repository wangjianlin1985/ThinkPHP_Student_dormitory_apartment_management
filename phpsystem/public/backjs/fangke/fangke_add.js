$(function () {
	$("#fangke_fangkeName").validatebox({
		required : true, 
		missingMessage : '请输入访客姓名',
	});

	$("#fangke_studentObj_studentNo").combobox({
	    url: backURL + getVisitPath("Student") + '/listAll',
	    valueField: "studentNo",
	    textField: "name",
	    panelHeight: "auto",
        editable: false, //不允许手动输入
        required : true,
        onLoadSuccess: function () { //数据加载完毕事件
            var data = $("#fangke_studentObj_studentNo").combobox("getData"); 
            if (data.length > 0) {
                $("#fangke_studentObj_studentNo").combobox("select", data[0].studentNo);
            }
        }
	});
	$("#fangke_guanxi").validatebox({
		required : true, 
		missingMessage : '请输入关系',
	});

	$("#fangke_inTime").datetimebox({
	    required : true, 
	    showSeconds: true,
	    editable: false
	});

	$("#fangke_leaveTime").datetimebox({
	    required : true, 
	    showSeconds: true,
	    editable: false
	});

	$("#fangke_addTime").datetimebox({
	    required : true, 
	    showSeconds: true,
	    editable: false
	});

	//单击添加按钮
	$("#fangkeAddButton").click(function () {
		//验证表单 
		if(!$("#fangkeAddForm").form("validate")) {
			$.messager.alert("错误提示","你输入的信息还有错误！","warning");
			$(".messager-window").css("z-index",10000);
		} else {
			$("#fangkeAddForm").form({
			    url: backURL + getVisitPath("Fangke") + "/add",
			    onSubmit: function(){
					if($("#fangkeAddForm").form("validate"))  { 
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
                    //此处data={"Success":true}是字符串
                	var obj = jQuery.parseJSON(data); 
                    if(obj.success){ 
                        $.messager.alert("消息","保存成功！");
                        $(".messager-window").css("z-index",10000);
                        $("#fangkeAddForm").form("clear");
                    }else{
                        $.messager.alert("消息",obj.message);
                        $(".messager-window").css("z-index",10000);
                    }
			    }
			});
			//提交表单
			$("#fangkeAddForm").submit();
		}
	});

	//单击清空按钮
	$("#fangkeClearButton").click(function () { 
		$("#fangkeAddForm").form("clear"); 
	});
});
