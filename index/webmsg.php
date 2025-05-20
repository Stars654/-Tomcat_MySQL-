<?php
include('../confing/common.php');
if($islogin!=1){exit("<script language='javascript'>window.location.href='login';</script>");  }
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
<div class="ok-body home" id="update">
   <div class="layui-row layui-col-space15">
       
      <div class="layui-col-sm12 layui-col-md6 layui-col-xs12">
            <div class="layui-card">
                <div class="layui-card-header">
                    推荐对接站
                </div>
                    <div class="ok-card-body clearfix">
                        <div v-for="res1 in row.recommend" class="layui-col-md12">
                            <div class="layui-elem-quote">
                                <h3><b>{{res1.webname}}</b></h3><hr>
                                <b>网站地址：</b> <a @click="tz(res1.url)">{{res1.url}}</a></button> <br>
                                <b>联系方式：</b>{{res1.webqq}} <br>
                                <b>认证金额：</b>{{res1.money}}元 <br>
                                <b>平台说明：</b>{{res1.introduction}} <br>
                                <b>认证时间：</b>{{res1.addtime}} <br>
                            </div>
                        </div>
                   </div>
            </div>
            <div class="layui-card">
                <div class="layui-card-header">
                    系统公告
                </div>
                    <div class="ok-card-body clearfix">
                         <div class="layui-row layui-col-space10">
                         <div v-for="res in row.data" class="layui-col-md12">
                             <div class="layui-card">
                                 <div class="layui-card-header"><b>{{res.title}}</b></div>
                                 <div class="layui-card-body">
                                     <p><span v-html="res.content"></span></p><div class="layui-btn layui-btn-normal layui-btn-xs">{{res.time}}</div>
                                 </div>
                             </div>
							</div>
				  	    </div>
                   </div>
            </div>
        </div>
      <div class="layui-col-sm12 layui-col-md6 layui-col-xs12">
          
            <div class="layui-card">
                <div class="layui-card-header">
                    版本列表
                </div>
                <div class="ok-card-body clearfix">
                    <ul class="layui-timeline">
                        <li class="layui-timeline-item" v-for="res2 in row.version_list">
                            <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                            <div class="layui-timeline-content layui-text">
                                <h3 class="layui-timeline-title">{{res2.version}} <span type="button" class="layui-btn layui-btn-xs layui-btn-primary layui-border-blue">{{res2.add_time}}</span></h3>
                                <p>
                                    <span v-html="res2.content"></span>
                                </p>
                            </div>
                        </li>
                        <li class="layui-timeline-item">
                            <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                            <div class="layui-timeline-content layui-text">
                                <div class="layui-timeline-title">过去</div>
                            </div>
                            <b>完整包下载：</b><button type="button" class="layui-btn layui-btn-xs" @click="tz(res2.complete_file)">点击下载</button><br>
                            <b>更新包下载：</b><button type="button" class="layui-btn layui-btn-xs  layui-btn-normal" @click="tz(res2.update_file)">点击下载</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
      <div class="layui-col-sm12 layui-col-md6 layui-col-xs12">
            <div class="layui-card">
                <div class="layui-card-header">
                    系统信息
                </div>
                
				<div class="ok-card-body map-body">
					<div class="progress-box ">
						<div class="pro-data">
							<h4 class="por-title">系统名称</h4>
							<div class="por-txt pro-d">{{row.app_name}}</div>
						</div>
					</div>
					<div class="progress-box ">
						<div class="pro-data">
							<h4 class="por-title">系统作者</h4>
							<div class="por-txt pro-d">{{row.app_author}}</div>
						</div>
					</div>
					<div class="progress-box ">
						<div class="pro-data">
							<h4 class="por-title">当前版本</h4>
							<div class="por-txt pro-d">{{row.app_version}}</div>
						</div>
					</div>
					<div class="progress-box ">
						<div class="pro-data">
							<h4 class="por-title">服务器域名/IP</h4>
							<div class="por-txt pro-d">{{row.url}}/{{row.ip}}</div>
						</div>
					</div>
					<div class="progress-box ">
						<div class="pro-data">
							<h4 class="por-title">PHP版本</h4>
							<div class="por-txt pro-d"><?=phpversion();?></div>
						</div>
					</div>
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
<script src="assets/js/aes.js"></script>
<script src="https://cdn.staticfile.org/vue/2.6.11/vue.min.js"></script>
<script src="https://cdn.staticfile.org/vue-resource/1.5.1/vue-resource.min.js"></script>
<script src="https://cdn.staticfile.org/axios/0.18.0/axios.min.js"></script>
 <script type="text/javascript">
		    var vm=new Vue({
		     	el: "#update",
		    	data: {
		      		row:null,
		        },
		      	methods:{
		      	    gglist:function(){
		     			this.$http.post("/apisub.php?act=upgg")
				          .then(function(data){	
				          	if(data.data.code==1){
				          		this.row=data.data
				          	}else{
				                layer.alert(data.data.msg,{icon:2});
				          	}
				          });	
		    		},
		      	    tz:function(url){
		     			window.location.href=url;	
		    		},
		     	},
		     	mounted(){
		     		this.gglist();
		     	}
		      });
       </script>