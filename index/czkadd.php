<?php
include('../confing/common.php');
if($islogin!=1){exit("<script language='javascript'>window.location.href='login';</script>");  }
if($userrow['uid']!=1){exit("<script language='javascript'>window.location.href='login.php';</script>");}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>添加卡密</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="css/oksub.css">
</head>
<body>
<div class="ok-body" id="add">
	<div class="layui-row">
		<form id="form-adduser" class="layui-form ok-search-form">
			<div class="layui-form-item">
				<div class="layui-form-item">
					<label class="layui-form-label">卡密前缀</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" placeholder="请输入卡密前缀" autocomplete="off" name="qianzhui">
						<div class="layui-form-mid layui-word-aux">例如：xm</div>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">卡密面值</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" placeholder="请输入卡密面值" autocomplete="off" name="money">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">生成数量</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" placeholder="请重新输入生成数量" autocomplete="off" name="num">
					</div>
				</div>
				
				<div class="layui-form-item">
               <label class="layui-form-label">卡密批次ID</label>
                <div class="layui-input-inline">
                 <input type="text" class="layui-input" placeholder="请输入批次ID" autocomplete="off" name="batch_id" >
                 </div>
                  </div>
				
				
				<div class="layui-form-item">
					<label class="layui-form-label">到期时间</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" placeholder="请选择到期时间" autocomplete="off" name="endtime">
						<div class="layui-form-mid layui-word-aux">格式：xxxx-xx-xx xx:xx:xx，输入0为永久</div>
					</div>
				</div>
				<div class="layui-form-item">
				    <label class="layui-form-label"></label>
				    <div class="layui-input-inline">
						<button class="layui-btn" type="button" @click="addczk()">
							<i class="layui-icon">&#xe606;</i>添加卡密
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!--js逻辑-->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="layer/3.1.1/layer.js"></script>
<script src="https://cdn.staticfile.org/vue/2.6.11/vue.min.js"></script>
<script src="https://cdn.staticfile.org/vue-resource/1.5.1/vue-resource.min.js"></script>
<script src="https://cdn.staticfile.org/axios/0.18.0/axios.min.js"></script>
<script src="lib/layui/layui.js"></script>
<script>
	layui.use(["form"], function () {
		let form = layui.form;
	})
</script>
<script>
	new Vue({
		el:"#add",
		data:{
		     
		},
		methods:{
			addczk:function(){
	           var load=layer.load(2);
               $.post("/apisub?act=addczk",{data:$("#form-adduser").serialize()},function (data) {
		 	     layer.close(load);
	             if (data.code == 1) {	
	                 layer.open({
	                     type: 1, 
	                     title:'卡密',
	                     content: '<div style="padding: 20px; line-height: 22px; #fff; font-weight: 300;">'+data.data+'</div>' ,
	                     btn:'关闭',
	                     btnAlign: 'c',
	                     shade: 0 ,
	                 });
	             } else {
	                 layer.msg(data.msg, {icon: 2});
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
