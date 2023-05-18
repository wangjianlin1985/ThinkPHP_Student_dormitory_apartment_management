<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"C:\xampp\htdocs\phpsystem\public/../application/front\view\sushe\sushe_frontlist.html";i:1568719529;s:77:"C:\xampp\htdocs\phpsystem\public/../application/front\view\common\header.html";i:1568720732;s:77:"C:\xampp\htdocs\phpsystem\public/../application/front\view\common\footer.html";i:1538061378;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1 , user-scalable=no">
<title>宿舍查询</title>
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

	<div class="row"> 
		<div class="col-md-9 wow fadeInDown" data-wow-duration="0.5s">
			<div>
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
			    	<li><a href="__PUBLIC__/index.php">首页</a></li>
			    	<li role="presentation" class="active"><a href="#susheListPanel" aria-controls="susheListPanel" role="tab" data-toggle="tab">宿舍列表</a></li>
			    	<li role="presentation" ><a href="<?php echo url('Sushe/frontAdd'); ?>" style="display:none;">添加宿舍</a></li>
				</ul>
			  	<!-- Tab panes -->
			  	<div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="susheListPanel">
				    		<div class="row">
				    			<div class="col-md-12 top5">
				    				<div class="table-responsive">
				    				<table class="table table-condensed table-hover">
				    					<tr class="success bold"><td>序号</td><td>宿舍ID</td><td>宿舍名称</td><td>床位总数</td><td>已用床位</td><td>宿舍管理员</td><td>创建时间</td><td>操作</td></tr>
				    					<?php
				    						/*计算起始序号*/
				    	            		$startIndex = ($currentPage-1) * $rows;
				    	            		$currentIndex = $startIndex+1;
				    	            		/*遍历记录*/
				    					if(is_array($susheRs) || $susheRs instanceof \think\Collection): $i = 0; $__LIST__ = $susheRs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sushe): $mod = ($i % 2 );++$i;?>
 										<tr>
 											<td><?php echo $currentIndex++; ?></td>
 											<td><?php echo $sushe['susheId']; ?></td>
 											<td><?php echo $sushe['susheName']; ?></td>
 											<td><?php echo $sushe['totalBedNum']; ?></td>
 											<td><?php echo $sushe['usedBedNum']; ?></td>
 											<td><?php echo $sushe['guanliyuan']; ?></td>
 											<td><?php echo $sushe['addTime']; ?></td>
 											<td>
 												<a href="<?php echo url('Sushe/frontshow',array('susheId'=>$sushe['susheId'])); ?>"><i class="fa fa-info"></i>&nbsp;查看</a>&nbsp;
 												<a href="#" onclick="susheEdit('<?php echo $sushe['susheId']; ?>');" style="display:none;"><i class="fa fa-pencil fa-fw"></i>编辑</a>&nbsp;
 												<a href="#" onclick="susheDelete('<?php echo $sushe['susheId']; ?>');" style="display:none;"><i class="fa fa-trash-o fa-fw"></i>删除</a>
 											</td> 
 										</tr>
 										<?php endforeach; endif; else: echo "" ;endif; ?>
				    				</table>
				    				</div>
				    			</div>
				    		</div>

				    		<div class="row">
					            <div class="col-md-12">
						            <nav class="pull-left">
						                <ul class="pagination">
						                    <li><a href="#" onclick="GoToPage(<%=currentPage-1 %>,<%=totalPage %>);" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
						                     <?php
						                    	$startPage = $currentPage - 5;
						                    	$endPage = $currentPage + 5;
						                    	if($startPage < 1) $startPage=1;
						                    	if($endPage > $totalPage) $endPage = $totalPage;
						                    	for($i=$startPage;$i<=$endPage;$i++) {
						                    ?>
						                    <li class="<?php echo $currentPage==$i?"active":""; ?>"><a href="#"  onclick="GoToPage(<?php echo $i; ?>,<?php echo $totalPage; ?>);"><?php echo $i; ?></a></li>
						                    <?php } ?>
						                    <li><a href="#" onclick="GoToPage(<?php echo $currentPage + 1; ?>,<?php echo $totalPage; ?>);"><span aria-hidden="true">&raquo;</span></a></li>
						                </ul>
						            </nav>
						            <div class="pull-right" style="line-height:75px;" >共有<?php echo $recordNumber; ?>条记录，当前第<?php echo $currentPage; ?>/<?php echo $totalPage; ?>页</div>
					            </div>
				            </div> 
				    </div>
				</div>
			</div>
		</div>
	<div class="col-md-3 wow fadeInRight">
		<div class="page-header">
    		<h1>宿舍查询</h1>
		</div>
		<form name="susheQueryForm" id="susheQueryForm" action="<?php echo url('Sushe/frontlist'); ?>" class="mar_t15" method="post">
			<div class="form-group">
				<label for="susheName">宿舍名称:</label>
				<input type="text" id="susheName" name="susheName" value="<?php echo $susheName; ?>" class="form-control" placeholder="请输入宿舍名称">
			</div>
			<div class="form-group">
				<label for="guanliyuan">宿舍管理员:</label>
				<input type="text" id="guanliyuan" name="guanliyuan" value="<?php echo $guanliyuan; ?>" class="form-control" placeholder="请输入宿舍管理员">
			</div>
			<div class="form-group">
				<label for="addTime">创建时间:</label>
				<input type="text" id="addTime" name="addTime" class="form-control"  placeholder="请选择创建时间" value="<?php echo $addTime; ?>" onclick="SelectDate(this,'yyyy-MM-dd')" />
			</div>
            <input type=hidden name=currentPage id="currentPage" value="<%=currentPage %>" />
            <button type="submit" class="btn btn-primary" onclick="$('#currentPage').val(1);return true;">查询</button>
        </form>
	</div>

		</div>
	</div> 
<div id="susheEditDialog" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;宿舍信息编辑</h4>
      </div>
      <div class="modal-body" style="height:450px; overflow: scroll;">
      	<form class="form-horizontal" name="susheEditForm" id="susheEditForm" enctype="multipart/form-data" method="post"  class="mar_t15">
		  <div class="form-group">
			 <label for="sushe_susheId_edit" class="col-md-3 text-right">宿舍ID:</label>
			 <div class="col-md-9"> 
			 	<input type="text" id="sushe_susheId_edit" name="sushe.susheId" class="form-control" placeholder="请输入宿舍ID" readOnly>
			 </div>
		  </div> 
		  <div class="form-group">
		  	 <label for="sushe_susheName_edit" class="col-md-3 text-right">宿舍名称:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="sushe_susheName_edit" name="sushe_susheName" class="form-control" placeholder="请输入宿舍名称">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="sushe_totalBedNum_edit" class="col-md-3 text-right">床位总数:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="sushe_totalBedNum_edit" name="sushe_totalBedNum" class="form-control" placeholder="请输入床位总数">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="sushe_usedBedNum_edit" class="col-md-3 text-right">已用床位:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="sushe_usedBedNum_edit" name="sushe_usedBedNum" class="form-control" placeholder="请输入已用床位">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="sushe_guanliyuan_edit" class="col-md-3 text-right">宿舍管理员:</label>
		  	 <div class="col-md-9">
			    <input type="text" id="sushe_guanliyuan_edit" name="sushe_guanliyuan" class="form-control" placeholder="请输入宿舍管理员">
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="sushe_beizhu_edit" class="col-md-3 text-right">宿舍备注:</label>
		  	 <div class="col-md-9">
			    <textarea id="sushe_beizhu_edit" name="sushe_beizhu" rows="8" class="form-control" placeholder="请输入宿舍备注"></textarea>
			 </div>
		  </div>
		  <div class="form-group">
		  	 <label for="sushe_addTime_edit" class="col-md-3 text-right">创建时间:</label>
		  	 <div class="col-md-9">
                <div class="input-group date sushe_addTime_edit col-md-12" data-link-field="sushe_addTime_edit">
                    <input class="form-control" id="sushe_addTime_edit" name="sushe_addTime" size="16" type="text" value="" placeholder="请选择创建时间" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
		  	 </div>
		  </div>
		</form> 
	    <style>#susheEditForm .form-group {margin-bottom:5px;}  </style>
      </div>
      <div class="modal-footer"> 
      	<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      	<button type="button" class="btn btn-primary" onclick="ajaxSusheModify();">提交</button>
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
    document.susheQueryForm.currentPage.value = currentPage;
    document.susheQueryForm.submit();
}

/*可以直接跳转到某页*/
function changepage(totalPage)
{
    var pageValue=document.susheQueryForm.pageValue.value;
    if(pageValue>totalPage) {
        alert('你输入的页码超出了总页数!');
        return ;
    }
    document.susheQueryForm.currentPage.value = pageValue;
    documentsusheQueryForm.submit();
}

/*弹出修改宿舍界面并初始化数据*/
function susheEdit(susheId) {
	$.ajax({
		url :  "<?php echo url('Sushe/update'); ?>?susheId=" + susheId ,
		type : "get",
		dataType: "json",
		success : function (sushe, response, status) {
			if (sushe) {
				$("#sushe_susheId_edit").val(sushe.susheId);
				$("#sushe_susheName_edit").val(sushe.susheName);
				$("#sushe_totalBedNum_edit").val(sushe.totalBedNum);
				$("#sushe_usedBedNum_edit").val(sushe.usedBedNum);
				$("#sushe_guanliyuan_edit").val(sushe.guanliyuan);
				$("#sushe_beizhu_edit").val(sushe.beizhu);
				$("#sushe_addTime_edit").val(sushe.addTime);
				$('#susheEditDialog').modal('show');
			} else {
				alert("获取信息失败！");
			}
		}
	});
}

/*删除宿舍信息*/
function susheDelete(susheId) {
	if(confirm("确认删除这个记录")) {
		$.ajax({
			type : "POST",
			url: "<?php echo url('Sushe/deletes'); ?>",
			data : {
				susheIds : susheId,
			},
			dataType: "json",
			success : function (obj) {
				if (obj.success) {
					alert("删除成功");
					$("#susheQueryForm").submit();
					//location.href="<?php echo url('Sushe/frontlist'); ?>";
				}
				else 
					alert(obj.message);
			},
		});
	}
}

/*ajax方式提交宿舍信息表单给服务器端修改*/
function ajaxSusheModify() {
	$.ajax({
		url :  "<?php echo url('Sushe/update'); ?>",
		type : "post",
		dataType: "json",
		data: new FormData($("#susheEditForm")[0]),
		success : function (obj, response, status) {
            if(obj.success){
                alert("信息修改成功！");
                $("#susheQueryForm").submit();
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

    /*创建时间组件*/
    $('.sushe_addTime_edit').datetimepicker({
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

