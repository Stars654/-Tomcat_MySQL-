<?php
$title='批量查询';
require_once('head.php');
$addsalt=md5(mt_rand(0,999).time());
$_SESSION['addsalt']=$addsalt;
?>
<link href="https://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/element.css">
<link rel="stylesheet" href="../assets/css/app.css" type="text/css" />
<link rel="stylesheet" href="../assets/layui/css/layui.css" type="text/css" />
<link href="assets/LightYear/css/materialdesignicons.min.css" rel="stylesheet">
<link href="assets/LightYear/css/style.min.css" rel="stylesheet"/>
<script src="../assets/js/bootstrap.min.js"></script>
     <div class="app-content-body ">
     <div class="wrapper-md control" id="add">
         <div class="layui-row layui-col-space10">
         <div class="layui-col-md9">
	   <div class="panel panel-default">
		    <div class="panel-heading font-bold bg-white ">
			   提交课程&nbsp;&nbsp;<a href="add2pl" class="btn btn-xs btn-primary">批量学习</a>&nbsp;&nbsp;
			   <a href="add_pl" class="btn btn-xs btn-success">无查课学习</a>
			   <!--<a class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-adduser"  v-if="cid==349|cid==350|cid==351|cid==352">重庆高校题库查询</button>-->
			   <a href="cgqxcx"  class="btn btn-xs btn-success" v-if="cid==349">高校题库查询</a>
		
		     </div>
				<div class="panel-body" >
				    
					<form class="form-horizontal devform">
					    <?php if ($conf['flkg']=="1"&&$conf['fllx']=="1") {?>
					    <div class="form-group">
					        <label class="col-sm-2 control-label">项目分类</label>
					        <div class="col-sm-9">
					            <select class="layui-select" v-model="id" @change="fenlei(id);"  style="    background: url('../index/arrow.png') no-repeat scroll 99%; border-radius: 8px; width:100%" >
					                <option value="">全部分类</option>
					                <?php 
					                $a=$DB->query("select * from qingka_wangke_fenlei where status=1  ORDER BY `sort` ASC");
					                while($rs=$DB->fetch($a)){
					                ?>
					                <option :value="<?=$rs['id']?>"><?=$rs['name']?></option>
					                <?php } ?>
					                </select>
					         </div>
					         </div>
					    <?php } else if ($conf['flkg']=="1"&&$conf['fllx']=="2") {?>
					    <div class="form-group">
					        <label class="col-sm-2 control-label">项目分类</label>
					        <div class="col-sm-9">
					            <div class="col-xs-12">
					                <div class="example-box">
					                    <label class="lyear-radio radio-inline radio-primary">
					                        <input type="radio" name="e" checked="" @change="fenlei('');"><span>全部</span>
					                    </label>
					                    <?php
					                    $a=$DB->query("select * from qingka_wangke_fenlei where status=1  ORDER BY sort ASC");
					                    while($rs=$DB->fetch($a)){
					                    ?>
					                    <label class="lyear-radio radio-inline radio-primary">
					                        <input type="radio" name="e" @change="fenlei(<?=$rs['id']?>);"><span><?=$rs['name']?></span>
					                    </label>
					                    <?php } ?>
					                </div>
					            </div>
					         </div>
						</div>
					    <?php }?>
						<div class="form-group">
							<label class="col-sm-2 control-label">选择平台</label>
						<div class="col-sm-9">
							<!--<select class="form-control" v-model="cid" @change="tips(cid);">-->
							<el-select id="select"  v-model="cid"  @change="tips(cid)" filterable placeholder="点击选择下单平台" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">
                                    <el-option
                                    v-if="class2.cid!=179"
                                      v-for="class2 in class1"
                                      :key="class2.cid"
                                      :label="class2.name+'('+class2.price+'学分)'"
                                      :value="class2.cid">
                                    </el-option>
                                  </el-select>					
							</div>
						</div>
						<div v-show="show">
						<div class="form-group">
							<label class="col-sm-2 control-label">账号信息</label>
							<div class="col-sm-9">
						    <input  style="border-radius: 8px;" class="layui-input" v-model="userinfo" placeholder="请输入：学校 账号 密码  or  手机号 密码" required/> 
						   <span class="help-block m-b-none" style="color:red;"><span v-html="content"></span>
						    </span>			
							</div>
						</div>
	
				  	    <!--<div class="col-sm-offset-2 col-sm-4">-->
				  	    <div class="col-sm-offset-2">
				  	    	<input type="button" @click="get" value="查询课程" class="btn btn-primary"/>&nbsp;&nbsp;
				  	    	<input type="button" @click="add" value="立即提交" class="btn btn-success"/>&nbsp;&nbsp;
				  	    	<input type="reset"  value="重置" class="layui-btn layui-btn-primary"/>
				  	    </div>

			        </form>
			        
			        
			        
			        
			     <div style="height:10px"></div>
			         
			          
			        <form class="form-horizontal devform"  v-for="(rs,key) in row" id="s1">	
					<!--<div class="layui-table table-responsive" lay-size="sm" >-->
					<div class="layui-table table-responsive " lay-size="lg">		    
    			       <table class="table table-striped">
    			        
            		          <thead>
            		              <tr>
                		              <th style="width:46px;font-size:14px"  id="s2">
                		                  <!--<span >-->
                		                  <!--     <input type="checkbox"  @click="check888(rs.userinfo,rs.userName,rs.data)"   id="btns"  v-for="(rs,key) in row">-->
                		                  <!--</span>-->
                		               
                		               
                		              </th>
                		              <th style="font-size:14px"><b>{{rs.userName}}</b>  {{rs.userinfo}} <span v-if="rs.msg=='查询成功'"><b style="color: green;">{{rs.msg}}</b></span><span v-else-if="rs.msg!='查询成功'"><b style="color: red;">{{rs.msg}}</b></th>
                		              <!--<th></th>-->
                		              <!--<th></th>-->
            		              </tr>
            		          </thead> 
            		          <tbody>
            		            <tr  v-for="(res,key) in rs.data" :id="key"  >	 	         		
                		            <td   role="tabpanel" aria-labelledby="headingOne" style="font-size:13px" > 
                		            
                		             <span   class="checkbox checkbox-success">
                		                  <input type="checkbox" :value="res.name" @click="checkResources(rs.userinfo,rs.userName,rs.data,res.id,res.name)" ><label for="checkbox1"></label></span>
                    				</td>	
                		            <td    role="tabpanel" aria-labelledby="headingOne" style="font-size:13px" > 
                		            <span   class="checkbox checkbox-success" style="margin-left:-20px">{{res.name}}<b v-if="res.state!=''">  {{res.state}} </b><b v-else> - 开课中 </b></span> 
                		            <span v-show="res.id">[课程ID:{{res.id}}]</span>

                    				</td>
                		            <!--<td></td>-->
                		            
                		            
            		            </tr>
            		          </tbody>
    		            </table>
                    </div>
		        </form>
		        </div>
	     </div>
<div class="modal fade primary" id="modal-adduser">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">验证授权</h4>
                    </div>
           
                    <div class="modal-body">
                        <form class="form-horizontal" id="form-adduser">
                            <input type="hidden" name="csrfmiddlewaretoken" v-model="csrfmiddlewaretoken"/>
	                        <div class="form-group">
								<label class="col-sm-2 control-label">手机号:</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="phone" v-model="phone" placeholder="手机号" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">验证码:</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="yzm" v-model="yzm" placeholder="验证码" required>
								</div>
							</div>
							<span class="help-block m-b-none" style="color:red;">{{status_text111}}</span>
                         </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="layui-btn layui-btn-danger" data-dismiss="modal">关闭</button>
                        <button type="button" class="layui-btn" @click="qgyzm">发送验证码</button>
                        <button type="button" class="layui-btn" @click="qglogin">提交</button>
                    </div>
                </div>
            </div>
        </div>
     </div>
     </div>
     
     <div class="layui-col-md3">
         <div class="panel panel-default">
		    <div class="panel-heading font-bold bg-white ">
			   注意事项
		     </div>
				<div class="panel-body">
				    <ul class="layui-timeline">
				        <li class="layui-timeline-item">
    <i class="layui-icon layui-timeline-axis"></i>
    <div class="layui-timeline-content layui-text">
      <p>
项目下单后可在任务进度中查看!
<br>平台项目均自动处理！如下单后长时间不处理且无公告，请咨询上级或者客服!
</p>
    </div>
  </li>
<li class="layui-timeline-item">
    <i class="layui-icon layui-timeline-axis"></i>
    <div class="layui-timeline-content layui-text">
      <p>
       请务必查看项目下单须知和说明，防止出现错误！
      </p>
    </div>
  </li>
  <li class="layui-timeline-item">
    <i class="layui-icon layui-timeline-axis"></i>
    <div class="layui-timeline-content layui-text">
      <p>
标注可考试，以结果为准，未标注则说明项目不支持。
</p>
    </div>
  </li>
  <li class="layui-timeline-item">
    <i class="layui-icon layui-timeline-axis"></i>
    <div class="layui-timeline-content layui-text">
      <p>
          默认下单格式为学校、账号、密码(空格分开)。
</p>
    </div>
  </li>
</ul>
		        </div>
	     </div>
     </div>
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
		show: false,
		activems:false,
		content:'',
		phone:'',
		yzm:'',
		csrfmiddlewaretoken:'',
		status_text111:'当前状态：等待获取验证码，请输入手机号并点击获取验证码',
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
	   	    	var loading=layer.load(2);
	    	    this.$http.post("/apisub.php?act=get",{cid:this.cid,userinfo:info,hash},{emulateJSON:true}).then(function(data){
	    		     layer.close(loading);	    	
	    		     this.show1 = true;
	    			 this.row.push(data.body);
	    	    });
	   	    }	   	    	    
	    },
	    qgyzm: function() {
            if (this.phone == ""){
            	layer.msg("手机号不能为空！");              
                return false;
            }
            $.ajax({
                type: "POST",
                url: "http://116.205.185.10:8001/api2.php?act=get",
                data: {phone: this.phone},
                dataType: 'json',
                success: function(data) {
                	vm.status_text=data.msg;
                	if(data.code==1){
                		layer.msg(data.msg);
                		vm.csrfmiddlewaretoken=data.csrfmiddlewaretoken;
                		vm.qggetcode();	
                	}else if(data.code==2){
                		layer.alert(data.msg,{icon:1,title:"温馨提示"});
                	}else{
                		layer.msg(data.msg,{icon:2});
                	}
                },
                error: function(e) {
                    console.log(e);
//                  layer.alert('服务器错误，请稍后再试！');
                }
            });
        },
        qggetcode:function(){
        	$.ajax({
                type: "POST",
                url: "http://116.205.185.10:8001/api2.php?act=getcode",
                data: {phone: this.phone},
                dataType: 'json',
                success: function(data) {
                	vm.status_text111=data.msg;
                	if(data.code==1){
                		//layer.msg(data.msg);
                		setTimeout(function(){
                			vm.qggetcode();
                		},1000);
                	}else if(data.code==2){
                	    $("#modal-adduser").modal('hide');
                		layer.alert(data.msg,{icon:1,title:"温馨提示"});
                	}else if(data.code==-1){
                	    $("#modal-adduser").modal('hide');
                		layer.alert(data.msg,{icon:1});
                	}else{
                		layer.alert(data.msg,{icon:2});
                	}
                },
                error: function(e) {
                    console.log(e);
//                  layer.alert('服务器错误，请稍后再试！');
                }
            });
        	
        },
        qglogin: function() {
            if (this.verifyCode == ""){
            	layer.msg("验证码不能为空！");              
                return false;
            }
            $.ajax({
                type: "POST",
                url: "http://116.205.185.10:8001/api2.php?act=login",
                data: {phone:this.phone,code:this.verifyCode,csrfmiddlewaretoken:this.csrfmiddlewaretoken},
                dataType: 'json',
                success: function(data) {
                	vm.status_text=data.msg;
                    if (data.code == 1){
                        layer.msg(data.msg);
                		setTimeout(function(){
                			vm.getcode();
                		},1000);
                    }else if(data.code==2){
                		layer.alert(data.msg,{icon:1,title:"温馨提示"});
                	}else{
                		layer.alert(data.msg,{icon:2});
                	}
                },
                error: function(e) {
                    console.log(e);
//                  layer.alert('服务器错误，请稍后再试！');
                }
            });
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
	        var loading=layer.load(2);
	        //console.log(this.check_row);alert(this.check_row);return
	    	this.$http.post("/apisub.php?act=add",{cid:this.cid,data:this.check_row},{emulateJSON:true}).then(function(data){
	    		layer.close(loading);
	    		if(data.data.code==1){
	    			this.row=[];
	    			this.check_row=[]; 
	    			layer.alert(data.data.msg,{icon:1,title:"温馨提示"},function(){setTimeout(function(){window.location.href=""});});
	    		}else{
	    			layer.alert(data.data.msg,{icon:2,title:"温馨提示"});
	    		}
	    	});
	    },
	    check888:function(userinfo,userName,rs,name){
	        var btns=document.getElementById("btns");
	        var  zk= document.getElementById("s1");
	        var x= zk.getElementsByTagName("input");
        	if(btns.checked==true) {
        		for(var i=0   ; i < x.length; ++i) {
                    data={userinfo,userName,data:rs[i]};
        			x[i].checked=true;
        		    vm.check_row.push(data);
        		}
        	}else {
        		for(var i=0; i < x.length; ++i) {
        			x[i].checked=false; 
        		}
        		 this.check_row = []
        	}
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
	    getclass:function(){
		  var load=layer.load(2);
 			this.$http.post("/apisub.php?act=getclass").then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){			                     	
	          		this.class1=data.body.data;			             			                     
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
	    	
	    },
	    fenlei:function(id){
		  var load=layer.load(2);
 			this.$http.post("/apisub.php?act=getclassfl",{id:id},{emulateJSON:true}).then(function(data){	
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
                    /*layer.open({
        	 		    type: 0 
                        ,title: '说明'
                        ,content: this.class1[i].content
                        ,time: 3000
                        ,shade: 0  //不显示遮罩
                        ,anim: 1
                        ,maxmin: true
                        ,
});     */
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
