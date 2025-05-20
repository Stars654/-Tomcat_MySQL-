<?php
$title='批量交单';
require_once('head.php');
$addsalt=md5(mt_rand(0,999).time());
$_SESSION['addsalt']=$addsalt;
?>

<link rel="stylesheet" href="assets/css/element.css">
<meta name="author" content="qingka">
<link rel="stylesheet" href="../assets/css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="../assets/css/app.css" type="text/css" />
<link rel="stylesheet" href="../assets/layui/css/layui.css" type="text/css" />
<link href="assets/LightYear/css/materialdesignicons.min.css" rel="stylesheet">
<link href="assets/LightYear/css/style.min.css" rel="stylesheet"/>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//cdn.staticfile.org/layer/2.3/layer.js"></script>
<link rel="stylesheet" href="/assets/elm/element.css">
 <link rel="stylesheet" type="text/css" href="https://element.eleme.cn/docs.10df231.css">
<link rel="stylesheet" href="https://element.eleme.cn/element-ui.91647e9.css">
<link href="./assets/css/tailwind.min.css" rel="stylesheet">
<script src="https://at.alicdn.com/t/font_1185698_xknqgkk0oph.js?spm=a313x.7781069.1998910419.40&file=font_1185698_xknqgkk0oph.js"></script>
     
     <div class="app-content-body ">
        <div class="wrapper-md control" id="add">
        <div class="row">	
        <div class="col-sm-12">
	    <div class="card panel-default" style="box-shadow: 8px 8px 15px #d1d9e6, -18px -18px 30px #fff; border-radius:8px;">
		      <div class="panel-heading font-bold  bg-white">批量交单</div>
				<div class="panel-body">
					<form class="form-horizontal devform">
						<div class="form-group">
							<label class="col-sm-2 control-label">选择平台</label>
						<div class="col-sm-9">
							<el-select id="select" v-model="cid" filterable @change="tips(cid)" popper-class="lioverhide" :popper-append-to-body ="false" placeholder="点击选择下单平台" style=" scroll 99%;   width:100%">
                                    <el-option
                                      v-for="class2 in class1"
                                      :key="class2.cid"
                                      :label="class2.name+'('+class2.price+'积分)'"
                                      :value="class2.cid">
                                    </el-option>
                                  </el-select>					
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">账号信息:</label>
							<div class="col-sm-9">
						    <textarea rows="8" class="layui-textarea" v-model="userinfo" placeholder="账号 密码 课程名字&#13;&#10;账号 密码 课程名字&#13;&#10;账号 密码 课程名字"></textarea>
						    <div style="height:5px"></div>
                          
							</div>
							
						</div>
	                    <!--<div class="col-sm-offset-2 col-sm-4">-->
				  	    <div class="col-sm-offset-2  ">
				  	    		<button style="margin-left: 6px; font-size: 13px;" type="button" @click="add" value="立即提交" class="el-button el-button--primary is-round"/><i class="glyphicon glyphicon-ok"></i>  立即提交</button>
				  	    		<button style="margin-left: 6px; font-size: 13px;" type="reset" value="清空数据" class="el-button el-button--primary is-round"/><i class="mdi mdi-delete-empty"></i>  清空数据</button>
				  	    		<!--<button class="btn btn-label btn-round btn-warning" type="reset"  value="清空数据"><label><i class="mdi mdi-delete-empty"></i></label> 清空数据</button>-->
				  	    	
				  	    </div>

			        </form>
		        </div>
	        </div>
	        
	        
	        
	        
	    </div> 
	     
        
	   </div> 
	     
		 
       </div>
        <div  class="wrapper-md control" id="loglist"  style="margin-top:-35px" >
        <div  class="panel panel-default"  style="box-shadow: 8px 8px 15px #d1d9e6, -18px -18px 30px #fff; border-radius:8px;">
		     <div class="panel-heading font-bold bg-white">提交结果</div>
				 <div class="panel-body">
		      <div class="table-responsive">
		        <table class="table table-striped">
		          <thead>
		              <tr>
		                  <th>ID</th>
		                  <th>UID</th>
		                  <th>平台 学校 账号 密码 课程名称</th>
		                  <th>预计扣费</th>
		                  <th>余额</th>
		                  <th>操作时间</th>
		              </tr>
		          </thead>
		          <tbody>
		            <tr v-for="res in row.data">
		            	<td>{{res.id}}</td>		  
		            	<td>{{res.uid}}</td>	
		            	<td>{{res.text}}</td>
		            	<td>{{res.money}}</td>
		            	<td>{{res.smoney}}</td>
		            	<td>{{res.addtime}}</td>
		            </tr>
		          </tbody>
		        </table>
		      </div>
		      
			     <ul class="pagination" v-if="row.last_page>1"><!--by 青卡 Vue分页 -->
			         <li class="disabled"><a @click="get(1)">首页</a></li>
			         <li class="disabled"><a @click="row.current_page>1?get(row.current_page-1):''">&laquo;</a></li>
		            <li  @click="get(row.current_page-3)" v-if="row.current_page-3>=1"><a>{{ row.current_page-3 }}</a></li>
						    <li  @click="get(row.current_page-2)" v-if="row.current_page-2>=1"><a>{{ row.current_page-2 }}</a></li>
						    <li  @click="get(row.current_page-1)" v-if="row.current_page-1>=1"><a>{{ row.current_page-1 }}</a></li>
						    <li :class="{'active':row.current_page==row.current_page}" @click="get(row.current_page)" v-if="row.current_page"><a>{{ row.current_page }}</a></li>
						    <li  @click="get(row.current_page+1)" v-if="row.current_page+1<=row.last_page"><a>{{ row.current_page+1 }}</a></li>
						    <li  @click="get(row.current_page+2)" v-if="row.current_page+2<=row.last_page"><a>{{ row.current_page+2 }}</a></li>
						    <li  @click="get(row.current_page+3)" v-if="row.current_page+3<=row.last_page"><a>{{ row.current_page+3 }}</a></li>		       			     
			         <li class="disabled"><a @click="row.last_page>row.current_page?get(row.current_page+1):''">&raquo;</a></li>
			         <li class="disabled"><a @click="get(row.last_page)">尾页</a></li>	    
			     </ul>      
		    </div>
		  </div>
		  </div>
       
    </div>
    
    

<script type="text/javascript" src="assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/main.min.js"></script>
<script src="assets/js/aes.js"></script>
<script src="https://cdn.staticfile.org/vue/2.6.11/vue.min.js"></script>
<script src="https://cdn.staticfile.org/vue-resource/1.5.1/vue-resource.min.js"></script>
<script src="https://cdn.staticfile.org/axios/0.18.0/axios.min.js"></script>
<script src="./assets/js/element.js"></script>
<script>

var vm=new Vue({
	el:"#add",
	data:{	
	    row:[],
	    check_row:[],
		userinfo:'',
		cid:'',
		miaoshua:'',
		class1:'',
		class3:'',
		activems:false,
	},
 		
	methods:{
	    add:function(){	 
			if(!this.cid){
				layer.msg("请先选择平台");return false;
			}
			if(!this.userinfo){
				layer.msg("请填写信息");return false;
			}
			userinfo=this.userinfo.replace(/\r\n/g, "[br]").replace(/\n/g, "[br]").replace(/\r/g, "[br]");
			userinfo=userinfo.split('[br]');//分割
			 
			
			for(var i=0;this.class1.length>i;i++){
				if(this.class1[i].cid==this.cid){
					var price=this.class1[i].price	 		
				}        	 	
			}
			
				
			kofei=price*userinfo.length;
			
			num = userinfo.length
			
			console.log(userinfo)
		 
			layer.confirm("检测到有<b style='color:red'>"+userinfo.length+"</b>条账号信息，具体扣费以提交结果为准", {title:'温馨提示',icon:3,btn: ['确定交单','取消']}, function(){
				var loading=layer.load(2);
				vm.$http.post("/apisub.php?act=add_pl",{cid:vm.cid,userinfo:userinfo,num:num},{emulateJSON:true}).then(function(data){
					layer.close(loading);
					if(data.data.code==1){
					    //layer.alert(data.data.msg,{icon:1,title:"提交结果"});
				 		layer.alert(data.data.msg,{icon:1,title:"提交结果"},function(){setTimeout(function(){window.location.href=""});});
					}else{
						layer.alert(data.data.msg,{icon:2,title:"提交结果"});
					}
				},function(){
					layer.close(loading);
					layer.alert("服务器错误");
				});
				
			  } 	 
			);	
	    },
	    getclass:function(){
		  var load=layer.load(2);
 			this.$http.post("/apisub.php?act=getclass_pl").then(function(data){	
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
                    layer.open({
        	 		    type: 0 
                        ,title: '说明'
                        ,content: this.class1[i].content
                        ,time: 9000
                        ,shade: 0  //不显示遮罩
                        ,anim: 1
                        ,maxmin: true
                        ,
});     
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
        	layer.tips('秒刷几分钟干完，但不包平时分等内容，慎重选择', '#miaoshua',{tips:1});      	  
		  
        }    
	},
	mounted(){
		//this.scsz(100,1000,600);
		this.getclass();
	}
});


</script>

<script>

new Vue({
	el:"#loglist",
	data:{
		row:null,
		type:'' ,
		types:'',
		qq:''
	},
	methods:{
		get:function(page,a){
		  var load=layer.load(2);
		  data={page:page,type:this.type,types:this.types,qq:this.qq}
 			this.$http.post("/apisub.php?act=loglist1",data,{emulateJSON:true}).then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){			                     	
	          		this.row=data.body;			             			                     
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
		}
	},
	mounted(){
		this.get(1);
	}
});
</script>
