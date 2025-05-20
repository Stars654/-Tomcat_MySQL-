<?php
include('../confing/common.php');
if($islogin!=1){exit("<script language='javascript'>window.location.href='login';</script>");  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>价格列表</title>
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
					<label class="layui-form-label">分类</label>
					<div class="layui-input-inline">
						<select name="fenlei" lay-verify="" lay-search>
							<option value="" selected>请选择分类</option>
							<?php
							$a=$DB->query("select * from qingka_wangke_fenlei where status=1 ORDER BY `sort` ASC");
							while($row=$DB->fetch($a)){
							    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
							}
							?>   
						</select>
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">项目名称</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" placeholder="项目名称模糊查询" autocomplete="off" name="name">
					</div>
				</div>
				<div class="layui-inline">
					<div class="layui-input-inline">
						<button class="layui-btn" lay-submit="" lay-filter="search">
							<i class="layui-icon">&#xe615;</i>搜索项目
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
			title:"价格列表",
			url: "../apisub?act=myprice",
			limit: 999999,
			limits:[999999],
			page: true,
			toolbar: true,
			toolbar: "#toolbarTpl",
			size: "sm",
			scrollPos: 'fixed',
			text: {
			    none: '哦吼~ 没有数据哦！' //默认：无数据。
			},
			cols: [[
				{type: "checkbox", fixed: "left"},
				{field: "cid", title: "ID", align: "center", sort: true, width: 60},
				{field: "name", title: "项目名称", align: "center", width: 220},
	
				{field: "my", title: "我的价格", align: "center", width: 80},
				{field: "beishu", title: "价格倍数", align: "center", width: 150},
				<?php
				$a=$DB->query("select * from qingka_wangke_dengji where status=1 and rate>='{$userrow['addprice']}' ORDER BY `sort` ASC");
				while($row=$DB->fetch($a)){
				    echo '{field: "'.$row['id'].'", title: "'.$row['name'].'", align: "center", width: 80},';
				}
				?>   
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





</body>
</html>
