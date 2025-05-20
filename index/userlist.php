<?php
$title='代理列表';
include('../confing/common.php');
if($userrow['uid']<'1'){exit("<script language='javascript'>window.location.href='/login.php';</script>");}
?>
   <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>用户列表</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="css/oksub.css">
	<script type="text/javascript" src="lib/loading/okLoading.js"></script>
</head>
<body>
<div class="ok-body">
	<!--模糊搜索区域-->
	<div class="layui-row">
		<form class="layui-form ok-search-form">
			<div class="layui-form-item">
			    <div class="layui-inline">
					<label class="layui-form-label">类型</label>
					<div class="layui-input-inline">
						<select name="type" lay-verify="" lay-search>
							<option value="1" selected>Uid</option>
							<option value="2">用户名</option>
				            <option value="3">邀请码</option>
				            <option value="4">昵称</option>
				            <option value="5">费率</option>
				            <option value="6">余额</option>
				            <option value="7">最后在线时间</option>
						</select>
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">内容</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" placeholder="请输入查询内容" autocomplete="off" name="qq">
					</div>
				</div>
				<div class="layui-inline">
					<div class="layui-input-inline">
						<button class="layui-btn" lay-submit="" lay-filter="search">
							<i class="layui-icon">&#xe615;</i>查询
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
<?php require_once("footer.php"); ?>

<script src="lib/layui/layui.js"></script>
<script src="assets/js/aes.js"></script>
<script src="js/vue.min.js"></script>
<script src="js/vue-resource.min.js"></script>
<script src="assets/layui/js/axios.min.js"></script>
<script>
	layui.use(["element", "jquery", "table", "form", "laydate", "okLayer", "okUtils", "okMock"], function () {
	    var element  = layui.element;
		let table = layui.table;
		let form = layui.form;
		let laydate = layui.laydate;
		let okLayer = layui.okLayer;
		let okUtils = layui.okUtils;
		let okMock = layui.okMock;
		let $ = layui.jquery;

		okLoading.close($);

		laydate.render({elem: "#startTime", type: "datetime"});
		laydate.render({elem: "#endTime", type: "datetime"});

		let userTable = table.render({
			elem: '#tableId',
			title:"用户列表",
			url: "../apisub.php?act=userlist",
			limit: 20,
			limits:[20,50,100,200,500,1000],
			page: true,
			toolbar: true,
			toolbar: "#toolbarTpl",
			size: "sm",
			text: {
			    none: '哦吼~ 没有数据哦！' //默认：无数据。
			},
			cols: [[
				{type: "checkbox", fixed: "left"},
				{field: "uid", title: "UID", align: "center", width: 60},
				{field: "uuid", title: "上级", align: "center", width: 60},
				{field: "name", title: "昵称", align: "center", width: 80},
				{field: "user", title: "账号", align: "center", width: 150},
				{field: "addprice", title: "费率", align: "center", width: 55, templet: "#addprice"},
				{field: "money", title: "余额", align: "center", width: 80},
				{field: "zcz", title: "总充值", align: "center", width: 60 },
				{field: "dd", title: "订单量", align: "center", width: 60 },
				{field: "yqm", title: "邀请码", align: "center", width: 110, templet: "#yqm" },
				{field: "key", title: "密钥", width: 80,align: "center", templet: "#statusTpl"},
				{field: "active", title: "状态", width: 80, align: "center", templet: "#process"},
				{field: "vip", title: "一键密价", width: 80, align: "center", templet: "#vip"},
				{field: "addtime", title: "添加时间", align: "center",},
				{field: "endtime", title: "最后登陆", align: "center"},
				{title: "操作", width: 230, align: "center", templet: "#operationTpl"}
			]],
			done: function (res, curr, count) {
				console.info(res, curr, count);
			}
		});
		table.on("toolbar(tableFilter)", function (obj) {
			switch (obj.event) {
				case "batchEnabled":
					 batchEnabled();
					break;
					case "khcz": // 添加这一行，监听 "khcz" 事件
            khcz();
            break;
			}
		});
		form.on("submit(search)", function (data) {
		    userTable.reload({
				where: data.field,
				page: {curr: 1}
			});
			return false;
		});

		table.on("tool(tableFilter)", function (obj) {
			let data = obj.data;
			switch (obj.event) {
				case "ktapi":
					ktapi(data.uid);
				break;
				case "ban":
					ban(data.uid,data.active);
				break;
				case "yqm":
					yqm(data.uid,data.name);
				break;
				case "ktvip":
					ktvip(data.uid,data.vip);
				break;
				
				case "userjk":
					userjk(data.uid,data.name);
				break;
				
				case "khcz":
					khcz(data.uid,data.name);
				break;
				case "czmm":
					czmm(data.uid);
				break;
				case "userkf":
					userkf(data.uid,data.name);
				break;
				case "userqy":
					userqy(data.uid,data.name);
				break;
				case "usergj":
					usergj(data.uid,data.user,data.addprice);
				break;
			}
		});
		function ktapi(uid) {
			layer.confirm('给下级开通API，将扣除5元余额', {title:'温馨提示',icon:1,
				  btn: ['确定','取消'] //按钮
				}, function(){
				  		var load=layer.load(2);
		     			axios.get("/apisub.php?act=ktapi&type=2&uid="+uid)
				          .then(function(data){	
				          	   	layer.close(load);
				          	if(data.data.code==1){		                     	
		                        layer.alert(data.data.msg,{icon:1,title:"温馨提示"});					
		                        userTable.reload({
			                     where: data.field
			                 }); 
				          	}else{
				                layer.msg(data.data.msg,{icon:2});
				          	}
				        });	
				
			    });
		}
		function batchEnabled() {
			layer.open({
    			type: 2,
    			title: '添加代理',
    			shadeClose: true,
    			shade: 0.8,
    			area: ['380px', '70%'],
    			content: 'adduser' //iframe的url
			}); 
		}
		function ban(uid,active) {
			var load=layer.load(2);
			$.post("/apisub.php?act=user_ban",{uid:uid,active:active},function (data) {
		 	     layer.close(load);
	             if (data.code==1){		             	 
	                layer.alert(data.msg,{icon:1});
	                userTable.reload({
	                    where: data.field
	                }); 
	             }else{
	                layer.msg(data.msg,{icon:2});
	             }	              
              });
		}
		
		 	function  ktvip (uid, active) {
      var load = layer.load(2)
      $.post('/apisub.php?act=user_vip', { uid:uid,active:active}, function (data) {
        layer.close(load)
        if (data.code ==1) {
         		             	 
	                layer.alert(data.msg,{icon:1});
	                 userTable.reload({
	                    where: data.field
	                 }); 
        } else {
         layer.msg(data.msg,{icon:2});
        }	              
              });
		}
		
	     
		
		function userjk(uid,name) {
			layer.prompt({title: '你将为<font color="red">'+name+'</font>充值请输入充值金额', formType: 3}, function(money, index){
			  layer.close(index);
	           var load=layer.load(2);
               $.post("/apisub.php?act=userjk",{uid:uid,money:money},function (data) {
		 	     layer.close(load);
	             if (data.code==1){		             	 
	                layer.alert(data.msg,{icon:1});
	                userTable.reload({
	                    where: data.field
	                }); 
	             }else{
	                layer.msg(data.msg,{icon:2});
	             }	              
              });            
		  });		
		}
		function khcz() {
    layer.prompt({title: '请输入对方UID，若错误无补救措施！', formType: 3}, function(uid, index) {
        layer.close(index);
        layer.prompt({title: '你将为<font color="red">' + uid + '</font>充值,请输入充值金额', formType: 3}, function(money, index) {
            layer.close(index);
            var load = layer.load();
            $.post("/apisub.php?act=rechargebyuid", {uid: uid, money: money}, function(data) {
                layer.close(load);
                if (data.code == 1) {
                     layer.alert(data.msg,{icon:1});
	                userTable.reload({
	                    where: data.field
	                }); 
                } else {
                    layer.msg(data.msg, {icon: 2});
                }
            });
        });
    });
}

		function usergj(uid,user,price) {
	           layer.open({
    			type: 2,
    			title: '修改费率',
    			shadeClose: true,
    			shade: 0.8,
    			area: ['380px', '70%'],
    			content: 'usergj.php?uid='+uid+'&user='+user+'&price='+price 
			}); 
		}
    <?php if($userrow['uid']==1){ ?>
		function yqm(uid,name) {
			layer.prompt({title: '你将为<font color="red">'+name+'</font>设置邀请码，邀请码最低4位数', formType: 3}, function(yqm, index){
			  layer.close(index);
	           var load=layer.load(2);
               $.post("/apisub.php?act=szyqm",{uid:uid,yqm:yqm},function (data) {
		 	     layer.close(load);
	             if (data.code==1){		             	 
	                layer.alert(data.msg,{icon:1});
	                userTable.reload({
	                    where: data.field
	                }); 
	             }else{
	                layer.msg(data.msg,{icon:2});
	             }	              
              });            
		  });		
		}
		
		function userqy(uid,name) {
			layer.prompt({title: '请输入要迁移的上级uid', formType: 3}, function(uuid, index){
			  layer.close(index);
	           var load=layer.load(2);
               $.post("/apisub.php?act=userqy",{uid:uid,uuid:uuid},function (data) {
		 	     layer.close(load);
	             if (data.code==1){		             	 
	                layer.msg(data.msg,{icon:1});
	                userTable.reload({
	                    where: data.field
	                }); 
	             }else{
	                layer.msg(data.msg,{icon:2});
	             }	              
              });            
		  });		
		}
		function userkf(uid,name) {
			layer.prompt({title: '你将扣除<font color="red">'+name+'</font>的余额 请输入扣除金额', formType: 3}, function(money, index){
			  layer.close(index);
	           var load=layer.load(2);
               $.post("/apisub.php?act=userkf",{uid:uid,money:money},function (data) {
		 	     layer.close(load);
	             if (data.code==1){		             	 
	                layer.msg(data.msg,{icon:1});
	                userTable.reload({
	                    where: data.field
	                }); 
	             }else{
	                layer.msg(data.msg,{icon:2});
	             }	              
              });            
		  });		
		}
		<?php } ?> 
		function czmm(uid) {
			layer.confirm('确定给下级重置密码？', {title:'温馨提示',icon:3,
				  btn: ['确定','取消'] //按钮
				}, function(){
	           var load=layer.load(2);
               $.post("/apisub.php?act=user_czmm",{uid:uid},function (data) {
		 	     layer.close(load);
	             if (data.code==1){		             	 
	                layer.alert(data.msg,{icon:1});
	                userTable.reload({
	                    where: data.field
	                }); 
	             }else{
	                layer.msg(data.msg,{icon:2});
	             }	              
              });            
		  });		
		}
	})
</script>
<!-- 头工具栏模板 -->
<script type="text/html" id="toolbarTpl">
	<div class="layui-btn-container">
		<button class="layui-btn layui-btn-sm layui-btn-normal" lay-event="batchEnabled">添加代理</button>
       <button class="layui-btn layui-btn-sm layui-btn-red" lay-event="khcz">跨户充值</button>
	</div>
	
</script>


<!-- 行工具栏模板 -->
<script type="text/html" id="operationTpl">
    <button class="layui-btn layui-btn-normal layui-btn-xs" lay-event="userjk">充值</button>
    <button class="layui-btn layui-btn-warm layui-btn-xs" lay-event="czmm">重置</button>
    <?php if($userrow['uid']==1){ ?>
    <button class="layui-btn layui-btn-danger layui-btn-xs" lay-event="userkf">扣款</button>
    <button class="layui-btn layui-btn-danger layui-btn-xs" lay-event="userqy">迁移</button>
    <?php } ?> 
</script>
<script type="text/html" id="statusTpl">
	{{# if(d.key == "1"){ }}
	<span class="layui-btn layui-btn-normal layui-btn-xs">已开通</span>
	{{#  } else if(d.key == "0") { }}
	<span class="layui-btn layui-btn-danger layui-btn-xs" lay-event="ktapi">未开通</span>
	{{#  } }}
</script>
<script type="text/html" id="process">
    {{# if(d.active == "1"){ }}
	<span class="layui-btn layui-btn-normal layui-btn-xs" lay-event="ban">正常</span>
	{{#  } else if(d.active == "0") { }}
	<span class="layui-btn layui-btn-danger layui-btn-xs" lay-event="ban">封禁</span>
	{{#  } }}
</script>

<script type="text/html" id="vip">
    {{# if(d.vip == "1"){ }}
	<span class="layui-btn layui-btn-normal layui-btn-xs" lay-event="ktvip">已开通</span>
	{{#  } else if(d.vip == "0") { }}
	<span class="layui-btn layui-btn-danger layui-btn-xs" lay-event="ktvip">未开通</span>
	{{#  } }}
</script>

<script type="text/html" id="yqm">
    {{# if(d.yqm != ""){ }}
	<span class="layui-btn layui-btn-normal layui-btn-xs" lay-event="yqm">{{d.yqm}}</span>
	{{#  } else { }}
	<span class="layui-btn layui-btn-danger layui-btn-xs" lay-event="yqm">未开通</span>
	{{#  } }}
</script>
<script type="text/html" id="addprice">
    {{# if(d.addprice != ""){ }}
	    <span lay-event="usergj" style="color: red;">{{d.addprice}}</span>
    {{#  } else { }}
	    没有
    {{#  } }}
</script>


</body>
</html>
