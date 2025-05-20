<?php
require_once('head.php');
if($islogin!=1){exit("<script language='javascript'>window.location.href='login';</script>");  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>日志列表</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<script type="text/javascript" src="assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/main.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/Chart.js"></script>
<script src="assets/js/aes.js"></script>
<script src="assets/js/vue.min.js"></script>
<script src="assets/js/vue-resource.min.js"></script>
<script src="assets/cdn/axios.min.js"></script>
	<script type="text/javascript" src="lib/loading/okLoading.js"></script>
</head>
<body>
<div class="ok-body">
	<!--模糊搜索区域-->
	<div class="layui-row">
		<form class="layui-form ok-search-form">
			<div class="layui-form-item">
			    <div class="layui-inline">
					<label class="layui-form-label">类型1</label>
					<div class="layui-input-inline">
						<select name="type" lay-verify="" lay-search>
							<option value="">请选择类型1</option>
							<option value="登录">登录</option>
							<option value="添加任务">添加任务</option>
				            <option value="批量提交">批量提交</option>
				            <option value="API添加任务">API添加任务</option>
				            <option value="上级充值">上级充值</option>
				            <option value="代理充值">代理充值</option>
				            <option value="修改费率">修改费率</option>
				            <option value="查课">查课</option>
		                     <option value="邀请码注册商户">邀请码注册商户</option>
		                      <option value="返利">返利</option>
			            <option value="签到成功">签到成功</option>
				            <option value="API查课">API查课</option>
				            <option value="开通接口">开通接口</option>
				            <option value="在线充值">在线充值</option>
				            <option value="订单退款">订单退款</option>
				            <option value="查课扣费">查课扣费</option>
						</select>
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">类型2</label>
					<div class="layui-input-inline">
						<select name="types" lay-verify="" lay-search>
							<option value="">请选择类型2</option>
							<option value="1">UID</option>
							<option value="2">余额变动</option>
				            <option value="3">操作时间</option>
				            <option value="4">操作内容</option>
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
			url: "../apisub?act=loglist",
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
				{field: "id", title: "UID", align: "center", width: 80},
				{field: "uid", title: "操作人", align: "center", width: 80},
				{field: "type", title: "类型", width: 150, align: "center", templet: "#type"},
				{field: "money", title: "余额变动", align: "center", width: 80},
				{field: "smoney", title: "余额", align: "center", width: 80},
				{field: "text", title: "操作内容", align: "center", width: 300 },
				{field: "addtime", title: "操作时间", align: "center"},
				{field: "ip", title: "操作IP", align: "center", width: 110}
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

	})
</script>
<!-- 行工具栏模板 -->
<script type="text/html" id="operationTpl">
    <button class="layui-btn layui-btn-normal layui-btn-xs" lay-event="userjk">充值</button>
    <button class="layui-btn layui-btn-danger layui-btn-xs" lay-event="czmm">重置密码</button>
</script>


</body>
</html>
