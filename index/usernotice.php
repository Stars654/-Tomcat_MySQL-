<?php
include('../confing/common.php');
if($islogin!=1){exit("<script language='javascript'>window.location.href='login';</script>");  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>修改下级公告</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="css/oksub.css">
</head>
<body>
<div class="ok-body" id="add">
	<!--模糊搜索区域-->
	<div class="layui-row" id=>
		<form id="form-adduser">
			<div class="layui-form-item">
				<div class="layui-form-item">
					<label class="layui-form-label">公告内容</label>
					<div class="layui-input-inline">
						<textarea name="desc" placeholder="请输入内容" class="layui-textarea"><?=$userrow['notice']?></textarea>
					</div>
				</div>
				<div class="layui-form-item">
				    <label class="layui-form-label"></label>
				    <div class="layui-input-inline">
						<button class="layui-btn" type="button" @click="szgg()">
							<i class="layui-icon">&#xe606;</i>添加代理
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<!--数据表格-->
	<table class="layui-hide" id="tableId" lay-filter="tableFilter"></table>
</div>
<!--js逻辑-->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="layer/3.1.1/layer.js"></script>
<script src="https://cdn.staticfile.org/vue/2.6.11/vue.min.js"></script>
<script src="https://cdn.staticfile.org/vue-resource/1.5.1/vue-resource.min.js"></script>
<script src="https://cdn.staticfile.org/axios/0.18.0/axios.min.js"></script>
<script src="lib/layui/layui.js"></script>
<script>
	new Vue({
		el:"#add",
		data:{
		},
		methods:{
			szgg:function(){
            var load=layer.load(2);
			              $.post("/apisub.php?act=user_notice",{data:$("#form-adduser").serialize()},function (data) {
					 	     layer.close(load);
				             if (data.code==1){
				                layer.msg(data.msg,{icon:1});
				                parent.layer.close(index);
				             }else{
				                layer.msg(data.msg,{icon:2});
				             }
			              });
		},
		}
	});
	
</script>
<script>
okLoading.close();
</script>
</body>
</html>
