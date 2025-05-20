<?php
include('../confing/common.php');
if($islogin!=1){exit("<script language='javascript'>window.location.href='login';</script>");  }
if($userrow['uid']!=1){ alert("你来错地方了","index.php"); }
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title><?=$conf['sitename']?></title>
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="keywords" content="ok-admin v2.0,ok-admin网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
   <meta name="description" content="ok-admin v2.0，顾名思义，很赞的后台模版，它是一款基于Layui框架的轻量级扁平化且完全免费开源的网站后台管理系统模板，适合中小型CMS后台系统。">
   <meta name="renderer" content="webkit">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <meta name="apple-mobile-web-app-status-bar-style" content="black">
   <meta name="apple-mobile-web-app-capable" content="yes">
   <meta name="format-detection" content="telephone=no">
   <link rel="stylesheet" href="css/oksub.css" media="all"/>
   <script type="text/javascript" src="lib/loading/okLoading.js"></script>
   <script type="text/javascript" src="lib/echarts/echarts.min.js"></script>
   <script type="text/javascript" src="lib/echarts/echarts.themez.js"></script>
   <script src="assets/LightYear/js/jquery.min.js"></script>
   <script src="layer/3.1.1/layer.js"></script>
</head>
<body class="console console1 ok-body-scroll">
<div class="ok-body home">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-xs6 layui-col-md3">
			<div class="layui-card">
				<div class="ok-card-body">
					<div class="img-box" ok-pc-in-show>
						<img src="images/home-03.png" alt="none"/>
					</div>
					<div class="cart-r">
						<div class="stat-text incomes-num">
						<?php 
						$zcz=0;
						$a=$DB->query("select * from qingka_wangke_order where addtime>'$jtdate'  ");
						while($c=$DB->fetch($a)){
						    $zcz+=$c['fees'];
						}
						echo $zcz;
						?>元</div>
						<div class="stat-heading">今日销售</div>
					</div>
				</div>
			</div>
		</div>
        <div class="layui-col-xs6 layui-col-md3">
			<div class="layui-card">
				<div class="ok-card-body">
					<div class="img-box" ok-pc-in-show>
						<img src="images/home-03.png" alt="none"/>
					</div>
					<div class="cart-r">
						<div class="stat-text incomes-num">
						<?php 
						$a=$DB->query("select * from qingka_wangke_pay where status='1' and addtime>'$jtdate'  ");
						$jrcz=0;
						while($c=$DB->fetch($a)){
						    $jrcz+=$c['money'];
						}
						echo $jrcz;
						?>元</div>
						<div class="stat-heading">今日充值</div>
					</div>
				</div>
			</div>
		</div>
        <div class="layui-col-xs6 layui-col-md3">
			<div class="layui-card">
				<div class="ok-card-body">
					<div class="img-box" ok-pc-in-show>
						<img src="images/home-03.png" alt="none"/>
					</div>
					<div class="cart-r">
						<div class="stat-text incomes-num">
						<?php 
						$a=$DB->count("select count(*) from qingka_wangke_order where addtime>'$jtdate'  ");
						echo $a;
						?>单</div>
						<div class="stat-heading">今日订单</div>
					</div>
				</div>
			</div>
		</div>
        <div class="layui-col-xs6 layui-col-md3">
			<div class="layui-card">
				<div class="ok-card-body">
					<div class="img-box" ok-pc-in-show>
						<img src="images/home-03.png" alt="none"/>
					</div>
					<div class="cart-r">
						<div class="stat-text incomes-num">
						<?php 
						$a=$DB->count("select count(*) from qingka_wangke_order   ");
						echo $a;
						?>单</div>
						<div class="stat-heading">全部订单</div>
					</div>
				</div>
			</div>
		</div>
        <div class="layui-col-xs6 layui-col-md3">
			<div class="layui-card">
				<div class="ok-card-body">
					<div class="img-box" ok-pc-in-show>
						<img src="images/home-03.png" alt="none"/>
					</div>
					<div class="cart-r">
						<div class="stat-text incomes-num">
						<?php 
						$a=$DB->count("select count(*) from qingka_wangke_user where addtime>'$jtdate'  ");	
						echo $a;
						?>位</div>
						<div class="stat-heading">新增代理</div>
					</div>
				</div>
			</div>
		</div>
        <div class="layui-col-xs6 layui-col-md3">
			<div class="layui-card">
				<div class="ok-card-body">
					<div class="img-box" ok-pc-in-show>
						<img src="images/home-03.png" alt="none"/>
					</div>
					<div class="cart-r">
						<div class="stat-text incomes-num">
						<?php 
						$a=$DB->count("select count(*) from qingka_wangke_user ");
						echo $a;
						?>位</div>
						<div class="stat-heading">全部代理</div>
					</div>
				</div>
			</div>
		</div>
        <div class="layui-col-xs6 layui-col-md3">
			<div class="layui-card">
				<div class="ok-card-body">
					<div class="img-box" ok-pc-in-show>
						<img src="images/home-03.png" alt="none"/>
					</div>
					<div class="cart-r">
						<div class="stat-text incomes-num">
						<?php 
						$dldl=$DB->count("select count(uid) from qingka_wangke_user where endtime>'$jtdate' ");
						echo $dldl;
						?>位</div>
						<div class="stat-heading">今日上线</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="lib/layui/layui.js"></script>
<script type="text/javascript" src="js/console1.js"></script>