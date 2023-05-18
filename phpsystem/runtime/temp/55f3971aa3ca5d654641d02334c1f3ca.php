<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:89:"C:\xampp\htdocs\phpsystem\public/../application/front\view\student\student_frontlist.html";i:1568719528;s:77:"C:\xampp\htdocs\phpsystem\public/../application/front\view\common\header.html";i:1568720732;s:77:"C:\xampp\htdocs\phpsystem\public/../application/front\view\common\footer.html";i:1538061378;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1 , user-scalable=no">
<title>学生查询</title>
<link href="__PUBLIC__/plugins/bootstrap.css" rel="stylesheet">
<link href="__PUBLIC__/plugins/bootstrap-dashen.css" rel="stylesheet">
<link href="__PUBLIC__/plugins/font-awesome.css" rel="stylesheet">
<link href="__PUBLIC__/plugins/animate.css" rel="stylesheet">
<link href="__PUBLIC__/plugins/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body style="margin-top:70px;">
<div class="container">
<!--导航开始-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!--小屏幕导航按钮和logo-->
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="__PUBLIC__/index.php" class="navbar-brand">宿舍管理系统</a>
        </div>
        <!--小屏幕导航按钮和logo-->
        <!--导航-->
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="__PUBLIC__/index.php">首页</a></li>
                <li><a href="<?php echo url('Student/frontlist'); ?>">学生</a></li>
                <li><a href="<?php echo url('ClassInfo/frontlist'); ?>">班级</a></li>
                <li><a href="<?php echo url('Sushe/frontlist'); ?>">宿舍</a></li>
                <li><a href="<?php echo url('Fangke/frontlist'); ?>">访客</a></li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php if(\think\Session::get('user_name') == null): ?>
                <li><a href="#" onclick="register();" style="display:none;"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;注册</a></li>
                <li><a href="#" onclick="login();" style="display:none;"><i class="fa fa-user"></i>&nbsp;&nbsp;登录</a></li>
                    <?php else: ?>
                <li class="dropdown">
                    <a id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo \think\Session::get('user_name'); ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                        <li><a href="__PUBLIC__/index.php"><span class="glyphicon glyphicon-screenshot"></span>&nbsp;&nbsp;首页</a></li>
                        <li><a href="<?php echo url('BookType/frontlist'); ?>"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;发布信息</a></li>
                        <li><a href="<?php echo url('Book/frontlist'); ?>"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;我发布的信息</a></li>
                        <li><a href="<?php echo url('Book/frontlist'); ?>"><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;修改个人资料</a></li>
                        <li><a href="<?php echo url('Book/frontlist'); ?>"><span class="glyphicon glyphicon-heart"></span>&nbsp;&nbsp;我的收藏</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo url('Index/logout'); ?>"><span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;退出</a></li>
                <?php endif; ?>
            </ul>

        </div>
        <!--导航-->
    </div>
</nav>
<!--导航结束-->


<div id="loginDialog" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-key"></i>&nbsp;系统登录</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" name="loginForm" id="loginForm" enctype="multipart/form-data" method="post"  class="mar_t15">

                    <div class="form-group">
                        <label for="userName" class="col-md-3 text-right">用户名:</label>
                        <div class="col-md-9">
                            <input type="text" id="userName" name="userName" class="form-control" placeholder="请输入用户名">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-3 text-right">密码:</label>
                        <div class="col-md-9">
                            <input type="password" id="password" name="password" class="form-control" placeholder="登录密码">
                        </div>
                    </div>

                </form>
                <style>#bookTypeAddForm .form-group {margin-bottom:10px;}  </style>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="ajaxLogin();">登录</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





<div id="registerDialog" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-sign-in"></i>&nbsp;用户注册</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" name="registerForm" id="registerForm" enctype="multipart/form-data" method="post"  class="mar_t15">



                </form>
                <style>#bookTypeAddForm .form-group {margin-bottom:10px;}  </style>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="ajaxRegister();">注册</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->






<script>

    function register() {
        $("#registerDialog input").val("");
        $("#registerDialog textarea").val("");
        $('#registerDialog').modal('show');
    }
    function ajaxRegister() {
        $("#registerForm").data('bootstrapValidator').validate();
        if(!$("#registerForm").data('bootstrapValidator').isValid()){
            return;
        }

        jQuery.ajax({
            type : "post" ,
            url : basePath + "UserInfo/add",
            dataType : "json" ,
            data: new FormData($("#registerForm")[0]),
            success : function(obj) {
                if(obj.success){
                    alert("注册成功！");
                    $("#registerForm").find("input").val("");
                    $("#registerForm").find("textarea").val("");
                }else{
                    alert(obj.message);
                }
            },
            processData: false,
            contentType: false,
        });
    }


    function login() {
        $("#loginDialog input").val("");
        $('#loginDialog').modal('show');
    }
    function ajaxLogin() {
        $.ajax({
            url : "<?php echo url('Index/frontLogin'); ?>",
            type : 'post',
            dataType: "json",
            data : {
                "userName" : $('#userName').val(),
                "password" : $('#password').val(),
            },
            success : function (obj, response, status) {
                if (obj.success) {
                    location.href = "__PUBLIC__/index.php";
                } else {
                    alert(obj.message);
                }
            }
        });
    }


</script>

	<div class="col-md-9 wow fadeInLeft">
		<ul class="breadcrumb">
  			<li><a href="__PUBLIC__/index.php">首页</a></li>
  			<li><a href="<?php echo url('Student/frontlist'); ?>">学生信息列表</a></li>
  			<li class="active">查询结果显示</li>
  			<a class="pull-right" href="<?php echo url('Student/frontAdd'); ?>" style="display:none;">添加学生</a>
		</ul>
		<div class="row">
			<?php
				/*计算起始序号*/
				$startIndex = ($currentPage-1) * $rows;
				$currentIndex = $startIndex+1;
				/*遍历记录*/
			if(is_array($studentRs) || $studentRs instanceof \think\Collection): $i = 0; $__LIST__ = $studentRs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$student): $mod = ($i % 2 );++$i;
				$clearLeft = "";
				if(($i-1)%4 == 0) $clearLeft = "style=\"clear:left;\"";
			?>
			<div class="col-md-3 bottom15" <?php echo $clearLeft; ?>>
			  <a  href="<?php echo url('Student/frontshow',array('studentNo'=>$student['studentNo'])); ?>"><img class="img-responsive" src="__PUBLIC__/<?php echo $student['studentPhoto']; ?>" /></a>
			     <div class="showFields">
			     	<div class="field">
	            		学号:<?php echo $student['studentNo']; ?>
			     	</div>
			     	<div class="field">
	            		姓名:<?php echo $student['name']; ?>
			     	</div>
			     	<div class="field">
	            		性别:<?php echo $student['sex']; ?>
			     	</div>
			     	<div class="field">
	            		生日:<?php echo $student['birthday']; ?>
			     	</div>
			     	<div class="field">
	            		联系qq:<?php echo $student['qq']; ?>
			     	</div>
			     	<div class="field">
	            		手机:<?php echo $student['mobile']; ?>
			     	</div>
			     	<div class="field">
	            		所在班级:<?php echo $student['classObjF']['className']; ?>
			     	</div>
			     	<div class="field">
	            		所在宿舍:<?php echo $student['susheObjF']['susheName']; ?>
			     	</div>
			     	<div class="field">
	            		添加时间:<?php echo $student['addTime']; ?>
			     	</div>
			        <a class="btn btn-primary top5" href="<?php echo url('Student/frontshow',array('studentNo'=>$student['studentNo'])); ?>">详情</a>
			        <a class="btn btn-primary top5" onclick="studentEdit('<?php echo $student['studentNo']; ?>');" style="display:none;">修改</a>
			        <a class="btn btn-primary top5" onclick="studentDelete('<?php echo $student['studentNo']; ?>');" style="display:none;">删除</a>
			     </div>
			</div>
			<?php endforeach; endif; else: echo "" ;endif; ?>

			<div class="row">
				<div class="col-md-12">
					<nav class="pull-left">
						<ul class="pagination">
							<li><a href="#" onclick="GoToPage(<?php echo $currentPage-1; ?>,<?php echo $totalPage; ?>);" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
							<?php
								$startPage = $currentPage - 5;
								$endPage = $currentPage + 5;
								if($startPage < 1) $startPage=1;
								if($endPage > $totalPage) $endPage = $totalPage;
								for($i=$startPage;$i<=$endPage;$i++) {
							?>
							<li class="<?php echo $currentPage==$i?"active":""; ?>"><a href="#"  onclick="GoToPage(<?php echo $i; ?>,<?php echo $totalPage; ?>);"><?php echo $i; ?></a></li>
							<?php } ?>
							<li><a href="#" onclick="GoToPage(<?php echo $currentPage+1; ?>,<?php echo $totalPage; ?>);"><span aria-hidden="true">&raquo;</span></a></li>
						</ul>
					</nav>
					<div class="pull-right" style="line-height:75px;" >共有<?php echo $recordNumber; ?>条记录，当前第 <?php echo $currentPage; ?>/<?php echo $totalPage; ?>  页</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-3 wow fadeInRight">
		<div class="page-header">
    		<h1>学生查询</h1>
		</div>
		<form name="studentQueryForm" id="studentQueryForm" action="<?php echo url('Student/frontlist'); ?>" class="mar_t15" method="post">
			<div class="form-group">
				<label for="studentNo">学号:</label>
				<input type="text" id="studentNo" name="studentNo" value="<?php echo $studentNo; ?>" class="form-control" placeholder="请输入学号">
			</div>
			<div class="form-group">
				<label for="name">姓名:</label>
				<input type="text" id="name" name="name" value="<?php echo $name; ?>" class="form-control" placeholder="请输入姓名">
			</div>
			<div class="form-group">
				<label for="birthday">生日:</label>
				<input type="text" id="birthday" name="birthday" class="form-control"  placeholder="请选择生日" value="<?php echo $birthday; ?>" onclick="SelectDate(this,'yyyy-MM-dd')" />
			</div>
			<div class="form-group">
				<label for="qq">联系qq:</label>
				<input type="text" id="qq" name="qq" value="<?php echo $qq; ?>" class="form-control" placeholder="请输入联系qq">
			</div>
			<div class="form-group">
				<label for="mobile">手机:</label>
				<input type="text" id="mobile" name="mobile" value="<?php echo $mobile; ?>" class="form-control" placeholder="请输入手机">
			</div>
            <div class="form-group">
            	<label for="classObj_classNo">所在班级：</label>
                <select id="classObj_classNo" name="classObj_classNo" class="form-control">
                	<option value="">不限制</option>
	 				<?php
	 				foreach($classInfoList as $classInfo) {
	 					$selected = "";
 					if($classObj['classNo'] == $classInfo['classNo'])
 						$selected = "selected";
	 				?>
 				 <option value="<?php echo $classInfo['classNo']; ?>" <?php echo $selected; ?>><?php echo $classInfo['className']; ?></option>
	 				<?php
	 				}
	 				?>
 			</select>
            </div>
            <div class="form-group">
            	<label for="susheObj_susheId">所在宿舍：</label>
                <select id="susheObj_susheId" name="susheObj_susheId" class="form-control">
                	<option value="0">不限制</option>
	 				<?php
	 				foreach($susheList as $sushe) {
	 					$selected = "";
 					if($susheObj['susheId'] == $sushe['susheId'])
 						$selected = "selected";
	 				?>
 				 <option value="<?php echo $sushe['susheId']; ?>" <?php echo $selected; ?>><?php echo $sushe['susheName']; ?></option>
	 				<?php
	 				}
	 				?>
 			</select>
            </div>
			<div class="form-group">
				<label for="addTime">添加时间:</label>
				<input type="text" id="addTime" name="addTime" class="form-control"  placeholder="请选择添加时间" value="<?php echo $addTime; ?>" onclick="SelectDate(this,'yyyy-MM-dd')" />
			</div>
            <input type=hidden name=currentPage id="currentPage" value="<?php echo $currentPage; ?>" />
            <button type="submit" class="btn btn-primary" onclick="$('#currentPage').val(1);return true;">查询</button>
        </form>
	</div>

		</div>
</div>
<div id="studentEditDialog" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;学生信息编辑</h4>
      </div>
      <div class="modal-body" style="height:450px; overflow: scroll;">
      	<form class="form-horizontal" name="studentEditForm" id="studentEditForm" enctype="multipart/form-data" method="post"  class="mar_t15">
		  <div class="form-group">
			 <label for="student_studentNo_edit" class="col-md-3 text-right">学号:</label>
			 <div class="col-md-9"> 
			 	<input type="text" id="student_studentNo_edit" name="student.studentNo" class="form-control" placeholder="请输入学号" readOnly>
			 </div>
		  </div> 
		  <div class="form-group">
		  	 <label for="student_name_edit" class="col-md-3 text-right">姓名:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="student_name_edit" name="student_name" class="form-control" placeholder="请输入姓名">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="student_sex_edit" class="col-md-3 text-right">性别:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="student_sex_edit" name="student_sex" class="form-control" placeholder="请输入性别">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="student_studentPhoto_edit" class="col-md-3 text-right">学生照片:</label>
		  	 <div class="col-md-9">
			    <img  class="img-responsive" id="student_studentPhotoImg" border="0px"/><br/>
			    <input type="hidden" id="student_studentPhoto_edit" name="student_studentPhoto"/>
			    <input id="studentPhotoFile" name="studentPhotoFile" type="file" size="50" />
		  	 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="student_birthday_edit" class="col-md-3 text-right">生日:</label>
		  	 <div class="col-md-9">
                <div class="input-group date student_birthday_edit col-md-12" data-link-field="student_birthday_edit" data-link-format="yyyy-mm-dd">
                    <input class="form-control" id="student_birthday_edit" name="student_birthday" size="16" type="text" value="" placeholder="请选择生日" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
		  	 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="student_qq_edit" class="col-md-3 text-right">联系qq:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="student_qq_edit" name="student_qq" class="form-control" placeholder="请输入联系qq">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="student_mobile_edit" class="col-md-3 text-right">手机:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="student_mobile_edit" name="student_mobile" class="form-control" placeholder="请输入手机">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="student_classObj_classNo_edit" class="col-md-3 text-right">所在班级:</label>
		  	 <div class="col-md-9">
			    <select id="student_classObj_classNo_edit" name="student_classObj_classNo" class="form-control">
			    </select>
		  	 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="student_susheObj_susheId_edit" class="col-md-3 text-right">所在宿舍:</label>
		  	 <div class="col-md-9">
			    <select id="student_susheObj_susheId_edit" name="student_susheObj_susheId" class="form-control">
			    </select>
		  	 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="student_addTime_edit" class="col-md-3 text-right">添加时间:</label>
		  	 <div class="col-md-9">
                <div class="input-group date student_addTime_edit col-md-12" data-link-field="student_addTime_edit">
                    <input class="form-control" id="student_addTime_edit" name="student_addTime" size="16" type="text" value="" placeholder="请选择添加时间" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
		  	 </div>
		  </div>
		</form> 
	    <style>#studentEditForm .form-group {margin-bottom:5px;}  </style>
      </div>
      <div class="modal-footer"> 
      	<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      	<button type="button" class="btn btn-primary" onclick="ajaxStudentModify();">提交</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--footer-->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="http://www.baidu.com" target=_blank>© 大神开发网 from 2020</a> |
                <a href="http://www.baidu.com">本站招聘</a> |
                <a href="http://www.baidu.com">联系站长</a> |
                <a href="http://www.baidu.com">意见与建议</a> |
                <a href="http://www.baidu.com" target=_blank>蜀ICP备0343346号</a> |
                <a href="__PUBLIC__/back/login">后台登录</a>
            </div>
        </div>
    </div>
</footer>
<!--footer-->





<script src="__PUBLIC__/plugins/jquery.min.js"></script>
<script src="__PUBLIC__/plugins/bootstrap.js"></script>
<script src="__PUBLIC__/plugins/wow.min.js"></script>
<script src="__PUBLIC__/plugins/bootstrap-datetimepicker.min.js"></script>
<script src="__PUBLIC__/plugins/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jsdate.js"></script>
<script>
/*跳转到查询结果的某页*/
function GoToPage(currentPage,totalPage) {
    if(currentPage==0) return;
    if(currentPage>totalPage) return;
    document.studentQueryForm.currentPage.value = currentPage;
    document.studentQueryForm.submit();
}

/*可以直接跳转到某页*/
function changepage(totalPage)
{
    var pageValue=document.studentQueryForm.pageValue.value;
    if(pageValue>totalPage) {
        alert('你输入的页码超出了总页数!');
        return ;
    }
    document.studentQueryForm.currentPage.value = pageValue;
    documentstudentQueryForm.submit();
}

/*弹出修改学生界面并初始化数据*/
function studentEdit(studentNo) {
	$.ajax({
		url :  "<?php echo url('Student/update'); ?>?studentNo=" + studentNo ,
		type : "get",
		dataType: "json",
		success : function (student, response, status) {
			if (student) {
				$("#student_studentNo_edit").val(student.studentNo);
				$("#student_name_edit").val(student.name);
				$("#student_sex_edit").val(student.sex);
				$("#student_studentPhoto_edit").val(student.studentPhoto);
				$("#student_studentPhotoImg").attr("src", "__PUBLIC__/" + student.studentPhoto);
				$("#student_birthday_edit").val(student.birthday);
				$("#student_qq_edit").val(student.qq);
				$("#student_mobile_edit").val(student.mobile);
				$.ajax({
					url: "<?php echo url('ClassInfo/listAll'); ?>",
					type: "get",
					dataType: "json",
					success: function(classInfos,response,status) { 
						$("#student_classObj_classNo_edit").empty();
						var html="";
		        		$(classInfos).each(function(i,classInfo){
		        			html += "<option value='" + classInfo.classNo + "'>" + classInfo.className + "</option>";
		        		});
		        		$("#student_classObj_classNo_edit").html(html);
		        		$("#student_classObj_classNo_edit").val(student.classObj);
					}
				});
				$.ajax({
					url: "<?php echo url('Sushe/listAll'); ?>",
					type: "get",
					dataType: "json",
					success: function(sushes,response,status) { 
						$("#student_susheObj_susheId_edit").empty();
						var html="";
		        		$(sushes).each(function(i,sushe){
		        			html += "<option value='" + sushe.susheId + "'>" + sushe.susheName + "</option>";
		        		});
		        		$("#student_susheObj_susheId_edit").html(html);
		        		$("#student_susheObj_susheId_edit").val(student.susheObj);
					}
				});
				$("#student_addTime_edit").val(student.addTime);
				$('#studentEditDialog').modal('show');
			} else {
				alert("获取信息失败！");
			}
		}
	});
}

/*删除学生信息*/
function studentDelete(studentNo) {
	if(confirm("确认删除这个记录")) {
		$.ajax({
			type : "POST",
			url: "<?php echo url('Student/deletes'); ?>",
			data : {
				studentNos : studentNo,
			},
			dataType: "json",
			success : function (obj) {
				if (obj.success) {
					alert("删除成功");
					$("#studentQueryForm").submit();
					//location.href= "<?php echo url('Student/frontlist'); ?>";
				}
				else 
					alert(obj.message);
			},
		});
	}
}

/*ajax方式提交学生信息表单给服务器端修改*/
function ajaxStudentModify() {
	$.ajax({
		url :  "<?php echo url('Student/update'); ?>",
		type : "post",
		dataType: "json",
		data: new FormData($("#studentEditForm")[0]),
		success : function (obj, response, status) {
            if(obj.success){
                alert("信息修改成功！");
                $("#studentQueryForm").submit();
            }else{
                alert(obj.message);
            } 
		},
		processData: false,
		contentType: false,
	});
}

$(function(){
	/*小屏幕导航点击关闭菜单*/
    $('.navbar-collapse a').click(function(){
        $('.navbar-collapse').collapse('hide');
    });
    new WOW().init();

    /*生日组件*/
    $('.student_birthday_edit').datetimepicker({
    	language:  'zh-CN',  //语言
    	format: 'yyyy-mm-dd',
    	minView: 2,
    	weekStart: 1,
    	todayBtn:  1,
    	autoclose: 1,
    	minuteStep: 1,
    	todayHighlight: 1,
    	startView: 2,
    	forceParse: 0
    });
    /*添加时间组件*/
    $('.student_addTime_edit').datetimepicker({
    	language:  'zh-CN',  //语言
    	format: 'yyyy-mm-dd hh:ii:ss',
    	weekStart: 1,
    	todayBtn:  1,
    	autoclose: 1,
    	minuteStep: 1,
    	todayHighlight: 1,
    	startView: 2,
    	forceParse: 0
    });
})
</script>
</body>
</html>

