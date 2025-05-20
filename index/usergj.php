<?php
include('../confing/common.php');
if($islogin!=1){exit("<script language='javascript'>window.location.href='login';</script>");  }
$uid=trim(strip_tags(daddslashes($_GET['uid'])));
$user=trim(strip_tags(daddslashes($_GET['user'])));
$price=trim(strip_tags(daddslashes($_GET['price'])));
if ($uid=='' || $user=='' || $price=='') { exit('所有项目不能为空'); }
// if($row['uuid']!=$userrow['uid'] && $userrow['uid']!=1){ exit("该用户你的不是你的下级,无法修改价格"); }
if($userrow['uid']==$uid && $userrow['uid']!=1){ exit("自己不能给自己改价哦"); }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>代理改价</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="css/oksub.css">
</head>
<body>
<div class="ok-body" id="add">
	<!--模糊搜索区域-->
	<div class="layui-row">
		<form id="form-usergj" class="layui-form ok-search-form">
			<div class="layui-form-item">
				<div class="layui-form-item">
					<label class="layui-form-label">代理UID</label>
					<div class="layui-input-inline">
					    <input type="hidden" name="uid" value="<?=$uid?>"/>
						<input type="text" class="layui-input" value="<?=$uid?>" disabled>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">代理账号</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="user" value="<?=$user?>" disabled>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">当前等级</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" name="price" value="<?=$price?>" disabled>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">修改等级</label>
					<div class="layui-input-inline">
						<select name="addpriceid" lay-search>
							<option value="" selected>请选择等级</option>
							<?php
							$a=$DB->query("select * from qingka_wangke_dengji where status=1 and rate>='{$userrow['addprice']}' ORDER BY `sort` ASC");
							while($row=$DB->fetch($a)){
							    echo '<option value="'.$row['id'].'">'.$row['name']." [费率:".$row['rate']."]".'</option>';
							}
							?>   
						</select>
					</div>
				</div>
				<div class="layui-form-item">
				    <label class="layui-form-label"></label>
				    <div class="layui-input-inline">
						<button class="layui-btn" type="button" @click="usergj()">
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
	layui.use(["form"], function () {
	})
</script>
<script>
	new Vue({
		el:"#add",
		data:{
		},
		methods:{
			usergj:function(){
	           var load=layer.load(2);
               $.post("/apisub?act=usergj",{data:$("#form-usergj").serialize()},function (data) {
		 	     layer.close(load);
	             if (data.code==1){    				
					layer.confirm(data.msg,{title: '温馨提示',icon: 3,btn: ['确定开通', '取消']}, function() {
    				var load = layer.load(2);
    				$.post("/apisub.php?act=usergj",{data:$("#form-usergj").serialize(),type:1}, {emulateJSON: true}).then(function(data) {
    					layer.close(load);
    					if (data.code == 1) {
    						layer.msg(data.msg, {icon: 1});
    					} else {
    						layer.msg(data.msg, {
    							icon: 2
    						});
    					}
    				});
				});								            
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
