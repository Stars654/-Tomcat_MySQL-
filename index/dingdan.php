<?php
include('../confing/common.php');
if($islogin!=1){exit("<script language='javascript'>window.location.href='login';</script>");  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>订单列表</title>
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
					<label class="layui-form-label">平台</label>
					<div class="layui-input-inline">
						<select name="cid" lay-verify="" lay-search>
							<option value="" selected>请选择平台</option>
							<?php
							$a=$DB->query("select * from qingka_wangke_class where status=1 ORDER BY `sort` ASC");
							while($row=$DB->fetch($a)){
							    echo '<option value="'.$row['cid'].'">'.$row['name'].'</option>';
							}
							?>   
						</select>
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">状态</label>
					<div class="layui-input-inline">
						<select name="status_text" lay-verify="" lay-search>
							<option value="" selected>请选择状态</option>
							<option value="待处理">待处理</option> 
							<option value="进行中">进行中</option> 
							<option value="队列中">队列中</option> 
							<option value="已完成">已完成</option> 
						 
						</select>
					</div>
				</div>
	
			
		
				
		
				<div class="layui-inline">
					<label class="layui-form-label">课程名</label>
					<div class="layui-input-inline">
						<input type="text" class="layui-input" placeholder="课程名模糊查询" autocomplete="off" name="kcname">
					</div>
				</div>
				<div class="layui-inline">
					<div class="layui-input-inline">
						<button class="layui-btn" lay-submit="" lay-filter="search">
							<i class="layui-icon">&#xe615;</i>搜索订单
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
			url: "../apisub?act=orderall",
			limit: 20,
			limits:[20,50,100,200,500,1000],
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
				// {field: "oid", title: "ID", align: "center", sort: true},
				{field: "ptname", title: "平台", align: "center", width: 150},
				// {field: "school", title: "学校", align: "center", width: 100},
				// {field: "user", title: "账号", align: "center", width: 100},
				// {field: "pass", title: "密码", align: "center", width: 100},
				{field: "kcname", title: "课程名", align: "center", width: 180 },
				{field: "status", title: "任务状态", width: 90,align: "center", templet: "#statusTpl"},
				{field: "process", title: "进度", width: 100, align: "center"},
				{field: "remarks", title: "备注", width: 420, align: "center"},
				{title: "操作", width: 100, align: "center", templet: "#operationTpl"},
				// {field: "fees", title: "单价", align: "center", width: 55},
				<?php if($userrow['uid']==1){ ?>
				// {field: "dockstatus", title: "处理状态", align: "center", width: 100, templet: "#dockstatus"},
				// {field: "uid", title: "UID", align: "center", width: 60},
				<?php } ?> 
				// {title: "取消", width: 60, align: "center", templet: "#quxiao"},
				// {title: "更多", width: 60, align: "center", templet: "#ms"},
				{field: "addtime", title: "下单时间", align: "center", width: 200}
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
				case "batchEnabled":
					 var sex = checkStatus.data;
					 batchEnabled(sex);
				break;
				case "rwztxg":
					 var sex = checkStatus.data;
					 rwztxg(sex);
				break;
				case "clztxg":
					 var sex = checkStatus.data;
					 clztxg(sex);
				break;
				
				case "tk":
					 var sex = checkStatus.data;
					 tk(sex);
				break;
				case "delorder":
					 var sex = checkStatus.data;
					 delorder(sex);
				break;
			}
		});

		table.on("tool(tableFilter)", function (obj) {
			let data = obj.data;
			switch (obj.event) {
				case "update":
					uporder(data.oid);
				break;
				
			}
		});

	
		function uporder(oid) {
			var load=layer.load(2);
				layer.msg("正在努力获取中....",{icon:3});
          $.get("/apisub?act=uporder&oid="+oid,function (data) {
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
		}

		
		
		
		
	
	})
</script>



<script type="text/html" id="operationTpl">
    <button class="layui-btn layui-btn-normal layui-btn-xs" lay-event="update">更新</button>
 
   
</script>





<script type="text/html" id="statusTpl">
	{{# if(d.status == "待处理"){ }}
	<span class="layui-btn layui-btn-normal layui-btn-xs"> {{d.status}} </span>
	{{#  } else if(d.status == "已完成") { }}
	<span class="layui-btn layui-btn-xs"> {{d.status}} </span>
	{{#  } else if(d.status == "异常") { }}
	<span class="layui-btn layui-btn-danger layui-btn-xs"> {{d.status}} </span>
	{{#  } else if(d.status == "进行中") { }}
	<span class="layui-btn layui-btn-warm layui-btn-xs"> {{d.status}} </span>
	{{#  } else if(d.status == "已取消") { }}
	<span class="layui-btn layui-btn-warm layui-btn-xs"> {{d.status}} </span>
	{{#  } else { }}
	<span class="layui-btn layui-btn-warm layui-btn-xs"> {{d.status}} </span>
	{{#  } }}
</script>


<script type="text/html" id="process">
<div class="layui-progress layui-progress-big" lay-showpercent="true">
  <div class="layui-progress-bar" lay-percent="70%"></div>
</div>

</script>


</body>
</html>
