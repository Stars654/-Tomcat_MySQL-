<?php
$title='提交订单';
// include('../confing/common.php');
require_once('head.php');
$addsalt=md5(mt_rand(0,999).time());
$_SESSION['addsalt']=$addsalt;
?>
<!DOCTYPE html>
<html lang="zh">
<head>

<meta name="author" content=" ">
<link rel="stylesheet" href="assets/css/element.css">
<link rel="stylesheet" href="assets/css/apps.css" type="text/css" />
<link rel="stylesheet" href="assets/css/app.css" type="text/css" />
<link href="//cdn.staticfile.org/layui/2.9.3/css/layui.css" rel="stylesheet">
<!--<link href="assets/layui/layui.css" rel="stylesheet">-->
<link rel="stylesheet" href="assets/LightYear/js/bootstrap-multitabs/multitabs.min.css">
<link href="assets/LightYear/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/LightYear/css/style.min.css" rel="stylesheet">
<link href="assets/LightYear/css/materialdesignicons.min.css" rel="stylesheet">
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="layer/3.1.1/layer.js"></script>

</head>
<body>
    
    <style>
    
    .red-text {
    color: red;
}

    </style>
    
<!--别偷代码啊！偷代码去死啊！-->
<!--别偷代码啊！偷代码去死啊！-->
<!--别偷代码啊！偷代码去死啊！-->
<!--别偷代码啊！偷代码去死啊！-->
<!--别偷代码啊！偷代码去死啊！-->
<!--别偷代码啊！偷代码去死啊！-->
<!--别偷代码啊！偷代码去死啊！-->
<!--别偷代码啊！偷代码去死啊！-->
<!--别偷代码啊！偷代码去死啊！-->
<!--别偷代码啊！偷代码去死啊！-->
<!--别偷代码啊！偷代码去死啊！-->
<!--别偷代码啊！偷代码去死啊！-->
<!--别偷代码啊！偷代码去死啊！-->

     <div class="app-content-body ">

        <div class="wrapper-md control" id="add">
            <div class="layui-row layui-col-space10">
            <div class="layui-col-md100">
	       <div class="panel panel-default" style="border-radius: 20px;">

    
	    <div class="panel-heading font-bold bg-white">课程学习 &nbsp;
	    <div style="float:right;margin-right:20px"><el-link type="primary"><a href="./list3">进度查询</a><li class="el-icon-arrow-right"></li></el-link></div>
	    <button type="button" class="layui-btn layui-btn-primary layui-border-red layui-btn layui-btn layui-btn-xs" data-toggle="modal" data-target="#modal-tj">下前必看</button> 
          <!--<a class="multitabs" href="plcx"><button class="layui-btn layui-btn-primary layui-border-blue layui-btn layui-btn layui-btn-xs">批量学习</button> </a>-->
          <a class="multitabs" href="add"><button class="layui-btn layui-btn-primary layui-border-green layui-btn layui-btn layui-btn-xs">手机便捷下单</button> </a>
          <!--<a class="multitabs" href="sc"><button class="layui-btn layui-btn-primary layui-border-green layui-btn layui-btn layui-btn-xs">控分系列(测试中)</button> </a>-->
	   </div>
				 
	

		<div class="panel-body" >
				    <form class="form-horizontal devform">

					    					    <div class="panel-body" >
					    	<form class="form-horizontal devform">
					    <div class="form-group">
					         <label class="col-sm-2 control-label">项目分类</label>
					        <div class="col-sm-9">
					            <div class="col-xs-14">
					                <div class="example-box">
					                    
					                    
					                    
					              
	
	
	
	<label role="radio" tabindex="0" class="el-radio-button el-radio-button--small is-active" aria-checked="true">
					                        <input  type="radio" tabindex="-1" autocomplete="off" class="el-radio-button__orig-radio"  name="e" checked="" @change="fenlei('');"><span class="el-radio-button__inner" >全部</span></label>
                     
                            <?php
                            $a=$DB->query("select * from qingka_wangke_fenlei where status=1  ORDER BY `sort` ASC");
                            while($rs=$DB->fetch($a)){
                            ?>
                            <div role="radiogroup" class="el-radio-group">
		    <label role="radio" tabindex="0" class="el-radio-button el-radio-button--small is-active" aria-checked="true">
					        <input type="radio" tabindex="-1" autocomplete="off" class="el-radio-button__orig-radio" name="e" @change="fenlei(<?=$rs['id']?>);"><span class="el-radio-button__inner"><?=$rs['name']?></label>			 </div>		        
          
                          <?php } ?>
                          
                          
                        </div> 
               </div>
					      
					  </div>
                          
  
				
						
				<!--<div style="text-align:center;"><h4><b><strong><span style="color:#9933E5;font-size:14px;">自主售后端<查进度、绑IP>：<a href="/shouhou" target="_blank">点击进入</a></span></strong></b></h4></div> -->
					    						<div class="form-group">
            <label class="col-sm-2 control-label">网课平台</label>
            <div class="col-sm-9">
                <el-select id="select" v-model="cid" filterable @change="tips(cid)" popper-class="lioverhide" :popper-append-to-body ="false" placeholder="点击选择下单平台" style="scroll 99%; width:100%">
                    <el-option v-for="class2 in class1" :label="class2.name+'→'+class2.price+'M币'" :value="class2.cid">
                        <span style="float: left">{{ class2.name }}</span>
                        <span style="float: right; color: #8492a6; font-size: 13px">{{ class2.price }}M币</span>
                    </el-option>
                </el-select>
            </div>
        </div>

						<!--下单页面折叠代码可选择关闭(下方代码截切到此处即可)-->
						<div v-show="show">
		               <!---------------------------分割线--------------------------->
		               
						 <!--has-success 为边框颜色 error info succecc warning 红蓝绿黄-->
					 <div class="form-group">
                           <label class="col-sm-2 control-label">填写账号</label>
                           <div class="col-sm-9">
                              <textarea rows="5" class="layui-textarea" v-model="userinfo" placeholder="填写：学校 (手机号/学号) 密码/手机号 密码" style="border-radius: 8px;">
                              </textarea>
						</div>
							</div>
							

                       <div class="form-group">
							<label class="col-sm-2 control-label">商品介绍</label>
							<div class="col-sm-9">
							    <b>
							<span class="help-block m-b-none" style="color:blue;">项目对接ID：<span v-html="duijieid"></span>
						    <span class="help-block m-b-none" style="color: rgb(54, 154, 255);"><span v-html="content"></span>
						    
						    </span>
						    </b>
							</div>
						</div>
				
	
		 				 <div class="col-sm-offset-2 col-sm-12">
	<button style="border-radius: 8px; background-color: rgb(136, 93, 255); border: 0px;" type="button" @click="get" value="立即查询" class="el-button el-button--primary"/>
	<i class="bi bi-search"></i> 查询课程</button>
	
	<button style="border-radius: 8px;" type="button" @click="add" value="立即提交" class="el-button el-button--primary"/>
	<i class="bi bi-send-fill"></i> 立即提交</button>
	<!--<button style="margin-left: 6px; font-size: 10px;" type="reset"     class="el-button el-button--info"/>-->
	<!--<i class="bi bi-search"></i> 信息重置</button>-->
				  	    </div>
				  	    </div>
		  
	     <div class="layui-col-md100" v-show="show1">
	    <div class="panel panel-default" style="border-radius: 10px;">
		     <div class="panel-heading font-bold bg-white" style="border-radius: 10px;">
			    查询结果
			    </div>
				<div class="panel-body">
					<form class="form-horizontal">		
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							  <div v-for="(rs,key) in row">
								  <div class="panel panel-default">
								    <div class="panel-heading" role="tab" id="headingOne">
								      <h4 class="panel-title">								
								        <a role="button" data-toggle="collapse" data-parent="#accordion" :href="'#'+key" aria-expanded="true" >
								            
								         <b>{{rs.userName}}</b>  {{rs.userinfo}} <span v-if="rs.msg=='查询成功'"><b style="color: green;">{{rs.msg}}</b>
								         </span><span v-else-if="rs.msg!='查询成功'"><b style="color: red;">{{rs.msg}}</b></span>
								        </a>
								      </h4>
								    </div>
								    <div :id="key" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								      <div class="panel-body">
								      	  <div v-for="(res,key) in rs.data">
								         <label class="lyear-checkbox checkbox-success m-t-10">
			   <li><input type="checkbox" :value="res.name" @click="checkResources(rs.userinfo,rs.userName,rs.data,res.id,res.name)"><label for="checkbox1"></label>
			   <span :class="{ 'red-text': res.state === '' }">{{ res.name }} <b v-if="res.state !== ''">{{ res.state }}</b><b v-else> - 开课中 </b></span><br>

			   <!--<span>{{res.name}} <b v-if="res.state!=''">  {{ res.state }} </b><b v-else> - 开课中 </b></span>-->
			   <!--<br>-->
			   <!--<span v-if="res.id!=''">[课程ID:{{res.id}}|{{res.classld}}|{{res.cpi}}]</span>-->
			    <span v-show="res.id">[课程ID:{{ res.id }}]</span>
								      
									      </div>
								      </div>
								    </div>
								  </div>
							</div>
					</div>			
			        </form>
		        </div>
	     </div>
	     </div>
	     </div>	
	     </div>
  <div class="layui-col-md100">
            <div class="panel panel-default" style="border-radius: 10px;">
   
    
      <div class="panel-heading font-bold bg-white" style="border-radius: 10px;">下单通知 &nbsp;<button type="button" class="layui-btn layui-btn-primary layui-border-green layui-btn layui-btn layui-btn-xs" data-toggle="modal" data-target="#modal-tz">客户查询地址<i class="layui-icon"></i></button> </h3>
      </div>
      <div class="layui-timeline-content layui-text">
      <i class="mdi mdi-bullhorn mdi-18px" aria-hidden="true">&nbsp;</i>项目分类显示的均是可以正常下单的项目<br>
    <i class="mdi mdi-bullhorn mdi-18px" aria-hidden="true">&nbsp;</i>智慧树推荐小沐，学习通推荐自营<br> 
    
    <i class="mdi mdi-bullhorn mdi-18px" aria-hidden="true">&nbsp;</i><span style="color: red;">国家开放大学推荐小沐</span> <br> 
   

    </div>
</div>
</div>

 <div class="modal fade primary" id="modal-tj">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">推荐下单</h4>
                    </div>
           
                    <div class="modal-body">
 <blockquote class="layui-elem-quote">
 学习通推荐分类:自营 专业课选修无敌
</blockquote>
<blockquote class="layui-elem-quote">
 智慧树推荐分类：小沐
</blockquote>
<blockquote class="layui-elem-quote">
中国大学推荐：小沐
</blockquote>
 </div>
    </div>
      </div>
        </div>
        
 <div class="modal fade primary" id="modal-tz">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title"></h4>
                    </div>
           
                    <div class="modal-body">

<blockquote class="layui-elem-quote">
<h4><b><strong><span style="color:#6495ED;font-size:14px;">客户自主售后端①<a href="http://w.wmv.life/get" target="_blank">点击进入</a></span></strong></b></h4>
</blockquote>
<blockquote class="layui-elem-quote">
<h4><b><strong><span style="color:#6495ED;font-size:14px;">客户自主售后端②<a href="http://ck.wmv.life/" target="_blank">点击进入</a></span></strong></b></h4>
</blockquote>
<blockquote class="layui-elem-quote">
 <h4><b><strong><span style="color:#FF0000;font-size:14px;">以上地址均可发给客户</span></strong></b></h4>
</blockquote>
 </div>
    </div>
      </div>
        </div>

</script>
<script type="text/javascript" src="assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/main.min.js"></script>
<script src="assets/js/aes.js"></script>
<script src="assets/js/vue.min.js"></script>
<script src="assets/js/vue-resource.min.js"></script>
<script src="assets/js/axios.min.js"></script>
<script src="assets/layui/layui.js"></script>
<script src="js/element.js"></script>
<!--<script src="assets/js/sy.js"></script>-->
<!--<script src="assets/layui/layui.js"></script>-->
<script type="text/javascript" src="assets/LightYear/js/bootstrap-multitabs/multitabs.js"></script>
<script type="text/javascript" src="assets/LightYear/js/index.min.js"></script>
<script src="assets/js/sy.js"></script>
<script src="js/sweetalert.js"></script>


<script src="https://cdn.bootcss.com/sweetalert/2.1.0/sweetalert.min.js"></script>

</script>
<script>
//     layer.alert('各位爱卿，下单之前请查看下方下单通知以及商品的详细介绍！<br><b><span style="color:red;">本平台运营模式为赠送模式</span></b><br>成本＝商品价格÷赠送倍率，不要无脑说价格贵，再次谢谢');
// </script>


<script>
var vm=new Vue({
	el:"#add",
	data:{	
	    row:[],
	    check_row:[],
		userinfo:'',
		cid:'',
		id:'',
		miaoshua:'',
		class1:'',
		class3:'',
		duijieid:'',
		show: false,
		show1: false,
		content:'',
		activems:false
	},
	methods:{
	    get:function(){
	    	if(this.cid=='' || this.userinfo==''){
	    		layer.msg("所有项目不能为空");
	    		return false;
	    	}
		    userinfo=this.userinfo.replace(/\r\n/g, "[br]").replace(/\n/g, "[br]").replace(/\r/g, "[br]");      	           	    
	   	    userinfo=userinfo.split('[br]');//分割
	   	    this.row=[];
	   	    this.check_row=[];    	
	   	    for(var i=0;i<userinfo.length;i++){	
	   	    	info=userinfo[i]
	   	    	var hash=getENC('<?php echo $addsalt;?>');
	   	    	var loading=layer.load(5);
	    	    this.$http.post("/apisub.php?act=get",{cid:this.cid,userinfo:info,hash},{emulateJSON:true}).then(function(data){
	    		     layer.close(loading);	    	
	    		     this.show1 = true;
	    			 this.row.push(data.body);
	    	    });
	   	    }	   	    	    
	    },
	    add:function(){
	    	if(this.cid==''){
	    		layer.msg("请先查课");
	    		return false;
	    	} 	
	    	if(this.check_row.length<1){
	    		layer.msg("请先选择课程");
	    		return false;
	    	} 	
	    	//console.log(this.check_row);
	        var loading=layer.load();
	        score = $("#range_02").val();
shichang = $("#range_01").val();
	    	this.$http.post("/apisub.php?act=add",{cid:this.cid,data:this.check_row,shichang: shichang,score: score,shu:this.shu,bei:this.bei,userinfo:this.userinfo,nochake:this.nochake},{emulateJSON:true}).then(function(data){
	    		layer.close(loading);
	    		if(data.data.code==1){
	    		    var submittedCoursesCount = this.check_row.length; // 获取提交的课程数量
	    			this.row=[];
	    			this.check_row=[]; 
	    			/*this.$message({type: 'success', showClose: true,message: data.data.msg});*/
    //     	    	layer.msg('提交成功',{icon:1,time:500}, function(){
    //                 setTimeout('window.location.reload()',500);
    //                 });
	   // 		}else{
	   // 			this.$message({type: 'error', showClose: true,message: data.data.msg});
	   // 		}
	   // 	});
	   // },
	    // 显示提交成功的消息，并包含提交的课程数量
            layer.msg('提交成功' + submittedCoursesCount + '门课程', {icon: 1, time: 2000});
        } else {
            this.$message({type: 'error', showClose: true, message: data.data.msg});
            
            layer.alert(data.data.msg, {icon: 2, title: "温馨提示"});
        }
        
       
        
    });
},
	    
	    
	    checkResources:function(userinfo,userName,rs,id,name){
	        for(i=0;i<rs.length;i++){
	            if(id==""){
	                if(rs[i].name==name){
	                    aa=rs[i]
	                }
	            }else{
	                if(rs[i].id==id && rs[i].name==name){
	                    aa=rs[i]
	                }
	            }
	    	}
	    	data={userinfo,userName,data:aa}
	    	if(this.check_row.length<1){
	    		vm.check_row.push(data); 
	    	}else{
	    	    var a=0;
		    	for(i=0;i<this.check_row.length;i++){		    		
		    		if(vm.check_row[i].userinfo==data.userinfo && vm.check_row[i].data.name==data.data.name){		    			
	            		var a=1;
	            		vm.check_row.splice(i,1);	
		    		}	    		
		    	}	    	   	    	               
               if(a==0){
               	   vm.check_row.push(data);
               }
	    	} 
	    },
	    fenlei:function(id){
		  var load=layer.load(5);
 			this.$http.post("/apisub.php?act=getclassfl",{id:id},{emulateJSON:true}).then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){			                     	
	          		this.class1=data.body.data;			             			                     
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
	    	
	    },
	    getclass:function(){
		  var load=layer.load(5);
 			this.$http.post("/apisub.php?act=getclass").then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){			                     	
	          		this.class1=data.body.data;			             			                     
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
	    	
	    },
        tips: function (message) {
        	 for(var i=0;this.class1.length>i;i++){
        	 	if(this.class1[i].cid==message){
        	 	    this.show = true;
        	 	    this.content = this.class1[i].content;
        	 	      this.duijieid = this.class1[i].cid;
	    		return false;	
        	 		if(this.class1[i].miaoshua==1){
					   	 this.activems=true;
					   }else{
					   	 this.activems=false;
					   }
        	 		return false;
        	 		
        	 	}
        	 	
        	 }
	
        },
        tips2: function () {
        	layer.tips('开启秒刷将额外收0.05的费用', '#miaoshua');      	  
		  
        }    
	},
	mounted(){
		this.getclass();		
	}
	

});
</script>

<!--别偷代码啊！偷代码去死啊！-->
<!--别偷代码啊！偷代码去死啊！-->
<!--别偷代码啊！偷代码去死啊！-->
<!--别偷代码啊！偷代码去死啊！-->
<!--别偷代码啊！偷代码去死啊！-->
<!--别偷代码啊！偷代码去死啊！-->