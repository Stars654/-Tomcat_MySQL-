<?php
include('../confing/common.php');
if($islogin!=1){exit("<script language='javascript'>window.location.href='login';</script>");  }
if($userrow['uid']!=1){exit("<script language='javascript'>window.location.href='login.php';</script>");}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>一键对接</title>
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
					<label class="layui-form-label">对接平台</label>
					<div class="layui-input-inline">
						<select name="hid" lay-verify="" lay-search>
							<option value="" selected>请选择平台</option>
							<?php
							$a=$DB->query("select * from qingka_wangke_huoyuan ");
							while($row=$DB->fetch($a)){
							    echo '<option value="'.$row['hid'].'">'.$row['name'].'</option>';
							}
							?>   
						</select>
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">对接类型</label>
					<div class="layui-input-inline">
						<select name="type" lay-verify="" lay-search>
							<option value="" selected>请选择类型</option>
							<?php
							$a=djname();
							foreach($a as $key => $value){
							    echo	'<option value="'.$key.'">'.$value.'</option>';
							}
							?>
						</select>
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">上架分类</label>
					<div class="layui-input-inline">
						<select name="fenlei" lay-verify="" lay-search>
							<option value="" selected>请选择类型</option>
							<?php
							$a=$DB->query("select * from qingka_wangke_fenlei ORDER BY `sort` ASC");
							while($b=$DB->fetch($a)){
							    echo '<option value="'.$b['id'].'">'.$b['name'].'</option>';
							}
							?>
						</select>
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">倍数算法</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" placeholder="不会就留空" autocomplete="off" name="cb">
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">添加前缀</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" placeholder="项目名字前缀，不会留空" autocomplete="off" name="name">
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">排序开始数</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" placeholder="排序从哪个数开始" autocomplete="off" name="sort">
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">对接分类</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" placeholder="输入对接平台分类的id" autocomplete="off" name="djfl">
					</div>
				</div>
				<div class="layui-inline">
					<div class="layui-input-inline">
						<button class="layui-btn" lay-submit="" lay-filter="search">
							<i class="layui-icon">&#xe615;</i>查询对接站商品
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
<script src="lib/layui/layui.js"></script>
<script src="assets/js/aes.js"></script>
<script src="https://cdn.staticfile.org/vue/2.6.11/vue.min.js"></script>
<script src="https://cdn.staticfile.org/vue-resource/1.5.1/vue-resource.min.js"></script>
<script src="https://cdn.staticfile.org/axios/0.18.0/axios.min.js"></script>
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
			title:"订单列表",
			url: "../apisub?act=yjdj",
			limit: 20,
			limits:[99999999],
			page: true,
			toolbar: true,
			toolbar: "#toolbarTpl",
			size: "sm",
			text: {
			    none: '哦吼~ 没有数据哦！' //默认：无数据。
			},
			cols: [[
				{type: "checkbox", fixed: "left"},
				{title: "操作", width: 100, align: "center", templet: "#operationTpl"},
				{field: "sort", title: "排序", align: "center", sort: true, width:60},
				{field: "cid", title: "ID", align: "center", sort: true, width:100},
				{field: "name", title: "项目名字", align: "left", width:200},
				{field: "content", title: "项目说明", align: "left", width:370},
				{field: "price1", title: "对接平台倍数", align: "center", width:80},
				{field: "price", title: "上架价格倍数", align: "center", width:80},
				{field: "price2", title: "当前上架倍数", align: "center", width:80, templet: "#price2"},
				{field: "kcid", title: "课程ID", align: "center", width:80, templet: "#kcid"},
				{field: "status", title: "上架状态", align: "center", templet: "#statusTpl", width:100}
			]],
			done: function (res, curr, count) {
				console.info(res, curr, count);
			}
		});

		form.on("submit(search)", function (data) {
		    userTable.reload({
				where: data.field,
				page: {curr: 1}
			});
			return false;
		});

		table.on("toolbar(tableFilter)", function (obj) {
		    var checkStatus = table.checkStatus(obj.config.id);
		    var othis = lay(this);
			switch (obj.event) {
				case "plsj":
					 var sex = checkStatus.data;
					 plsj(sex);
				break;
				case "pltb":
					 var sex = checkStatus.data;
					 pltb(sex);
				break;
			}
		});

		table.on("tool(tableFilter)", function (obj) {
			let data = obj.data;
			switch (obj.event) {
				case "yjsj":
					yjsj(data);
				break;
				case "tbjg":
					tbjg(data);
				break;
			}
		});

		function plsj(sex) {
			if(this.sex==''){layer.msg("请先选择订单！");return false;}
			    layer.confirm('是否确定批量上架', {title: '温馨提示',icon: 3,btn: ['确认', '取消']}, function() {
    				var load = layer.load(2);
    				$.post("/apisub.php?act=plsj",{sex:sex}, {emulateJSON: true}).then(function(data) {
    					layer.close(load);
    					if (data.code == 1) {
    					    layer.open({
    					        title: '批量上架提示'
    					        ,content: data.msg
    					    });    
    					    userTable.reload({where: data.field});
    					} else {
    						layer.msg(data.msg, {
    							icon: 2
    						});
    					}
    				});
				});
		}
		function pltb(sex) {
			if(this.sex==''){layer.msg("请先选择订单！");return false;}
			    layer.confirm('是否确定批量同步价格', {title: '温馨提示',icon: 3,btn: ['确认', '取消']}, function() {
    				var load = layer.load(2);
    				$.post("/apisub.php?act=pltb",{sex:sex}, {emulateJSON: true}).then(function(data) {
    					layer.close(load);
    					if (data.code == 1) {
    					    layer.open({
    					        title: '批量同步提示'
    					        ,content: data.msg
    					    });    
    					    userTable.reload({where: data.field});
    					} else {
    						layer.msg(data.msg, {
    							icon: 2
    						});
    					}
    				});
				});
		}
		function yjsj(data) {
			var load=layer.load(2);
          $.post("/apisub.php?act=yjadd",{data:data}, {emulateJSON: true}).then(function(data) {
    					layer.close(load);
    					if (data.code == 1) {
    						layer.msg(data.msg, {icon: 1});
    						userTable.reload({where: data.field});
    					} else {
    						layer.msg(data.msg, {
    							icon: 2
    						});
    					}
    				});
		}
		function tbjg(data) {
			var load=layer.load(2);
          $.post("/apisub.php?act=yjtbjg",{data:data}, {emulateJSON: true}).then(function(data) {
    					layer.close(load);
    					if (data.code == 1) {
    						layer.msg(data.msg, {icon: 1});
    						userTable.reload({where: data.field});
    					} else {
    						layer.msg(data.msg, {
    							icon: 2
    						});
    					}
    				});
		}

	})
</script>
<!-- 头工具栏模板 -->
<script type="text/html" id="toolbarTpl">
	<div class="layui-btn-container">
		<button class="layui-btn layui-btn-sm layui-btn-normal" lay-event="plsj">批量上架</button>
		<button class="layui-btn layui-btn-sm " lay-event="pltb">批量同步价格</button>
	</div>
</script>
<!-- 行工具栏模板 -->
<script type="text/html" id="operationTpl">
    {{# if(d.status == "0"){ }}
    <button class="layui-btn layui-btn-normal layui-btn-xs" lay-event="yjsj">一键上架</button>
	{{#  } else if(d.status == "1") {  if(d.price2 != d.price) { }}
	<span class="layui-btn layui-btn-xs" lay-event="tbjg"> 同步价格 </span>
	{{#  } } }}
</script>
<script type="text/html" id="statusTpl">
    {{# if(d.status == "0"){ }}
	<span class="layui-btn layui-btn-danger layui-btn-xs"> 未上架 </span>
	{{#  } else if(d.status == "1") { }}
	<span class="layui-btn layui-btn-xs"> 已上架 </span>
	{{#  } }}
</script>
<script type="text/html" id="kcid">
    {{# if(d.kcid == "0"){ }}
	<span class="layui-btn layui-btn-xs"> 不需要 </span>
	{{#  } else if(d.kcid == "1") { }}
	<span class="layui-btn layui-btn-xs layui-btn-danger"> 需要 </span>
	{{#  } else { }}
	未知
	{{#  } }}
</script>
<script type="text/html" id="price2">
    {{# if(d.status == "0"){ }}
	还未上架
	{{#  } else if(d.status == "1") { if(d.price2 == d.price) { }}
	<span class="layui-btn layui-btn-xs"> {{ d.price2 }} </span>
	{{#  }else{  }}
	<span class="layui-btn layui-btn-danger layui-btn-xs"> {{ d.price2 }} </span>
	{{#  } } }}
</script>
<script type="text/html" id="process">
<div class="layui-progress layui-progress-big" lay-showpercent="true">
  <div class="layui-progress-bar" lay-percent="70%"></div>
</div>

</script>


</body>
</html>
