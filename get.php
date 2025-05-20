<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="icon" href="../favicon.ico" type="image/ico">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title><?=$title?></title>
        <meta name="keywords" content="<?=$title?>">
        <meta name="description" content="<?=$title?>">
        <link rel="stylesheet" href="assets/layui/css/layui.css" media="all">
        <link rel="stylesheet" href="index/assets/style/user.css" media="all">
        <link rel="stylesheet" href="index/assets/style/login.css" media="all">
</head>
<body>
    <div id="submit">
        <div class="layui-fluid">
            <div class="layui-row layui-col-space10">
                <div class="layui-col-md4">
                    <div class="layui-card">
                        <div class="layui-card-header">查询进度</div>
                        <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
                                <div class="layui-form-item">
                                    <label class="layadmin-user-login-icon layui-icon layui-icon-cellphone" for="LAY-user-login-cellphone"></label>
                                    <input type="text" name="phone" placeholder="学生账号" class="layui-input" v-model="user">
                                </div>
                                <div class="layui-form-item">
                                    <input type="button" @click="get" value="查询进度" class="layui-btn layui-btn-fluid"/>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md8">
                    <div class="layui-card">
                        <div class="layui-card-header">进度详情</div>
                        <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
                                <div class="layui-form-item" v-for="res in row.data">
                                        <blockquote class="layui-elem-quote">
                                            <div class="layui-card-body layui-bg-gray">
                                                <h3><b>[课程] {{res.kcname}}</b> <span class="layui-badge layui-bg-blue">{{res.process}}</span></h3><hr>
                                                <b>提交时间：</b>{{res.addtime}} <br>
                                                <b>订单状态：</b> {{res.status}} <br>
                                                <b>课程进度：</b> {{res.process}} <br>
                                                <b>任务备注：</b> {{res.remarks}} <br>
                                                <b>课程操作：</b> <button class="layui-btn layui-btn-xs" @click="fill1(res.id)">同步进度</button> <button class="layui-btn layui-btn-xs layui-btn-danger" @click="fill(res.id)">补刷课程</button>
                                             </div>
                                        </blockquote>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="assets/js/bootstrap.min.js"></script>
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="index/assets/layer/3.1.1/layer.js"></script>
<script src="https://cdn.staticfile.org/vue/2.6.11/vue.min.js"></script>
<script src="https://cdn.staticfile.org/vue-resource/1.5.1/vue-resource.min.js"></script>
<script src="https://cdn.staticfile.org/axios/0.18.0/axios.min.js"></script>
<script>
//注意：选项卡 依赖 element 模块，否则无法进行功能性操作
layui.use('element', function(){
  var element = layui.element;
  
  //…
});

</script>
<script>
var vm = new Vue({
        el: "#submit",
        data: {
            row:'',
            user:''
        },
        methods: {
            get:function(page){
                var load=layer.load(2);
                data={cx:this.cx,page}
                this.$http.post("api.php?act=chadan",{username:this.user},{emulateJSON:true}).then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){		
	          		this.row=data.body;			             			                     
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
		},fill:function(id){
                var load=layer.load(2);
                this.$http.post("/api.php?act=budan",{id:id},{emulateJSON:true}).then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){		
	          	    vm.get();
	          		layer.msg(data.data.msg,{icon:1});
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
		},
		fill1:function(id){
                var load=layer.load(2);
                this.$http.post("/api.php?act=upjd",{id:id},{emulateJSON:true}).then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){		
	          	    vm.get();
	          		layer.msg(data.data.msg,{icon:1});
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
		},
        }
    });
    </script>
</html>