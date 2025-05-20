<?php
$title='批量查询';
require_once('head.php');
$addsalt=md5(mt_rand(0,999).time());
$_SESSION['addsalt']=$addsalt;
?>
<link rel="stylesheet" href="assets/css/element.css">
<link rel="icon" href="assets/LightYear/favicon.ico" type="image/ico">
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
         <div class="layui-row layui-col-space10">
         <div class="layui-col-md9">
	   <div class="panel panel-default">
		    <div class="panel-heading font-bold bg-white ">
			   提交课程&nbsp;&nbsp;<a href="add2" class="btn btn-xs btn-primary">普通学习</a>&nbsp;&nbsp;
			   <!--<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-adduser"  v-if="cid==266">授权验证</button>-->
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
					                    $a=$DB->query("select * from qingka_wangke_fenlei where status=1  ORDER BY `sort` ASC");
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
						<!--div class="form-group" v-if="activems==true">
							<label class="col-sm-2 control-label" for="checkbox1">是否秒刷</label>
							<div class="col-sm-9">
								<div class="checkbox checkbox-success"  @change="tips2">
        				            <input type="checkbox" v-model="miaoshua">
        				            	<label for="checkbox1" id="miaoshua"></label>
							    </div>
							</div>							
						</div-->
						<div class="form-group">
							<label class="col-sm-2 control-label">信息填写</label>
							<div class="col-sm-9">
						    <textarea rows="5" class="layui-textarea" v-model="userinfo" placeholder="下单格式：学校（可为空） 账号 密码（用空格分隔）&#10多账号下单必须换行"   style="border-radius: 8px;"></textarea>	
						    <span class="help-block m-b-none" style="color:red;" id="warning">
						        <span v-html="content"></span>
						    </span>				
							</div>
						</div>
	
				  	    <div class="col-sm-offset-2 col-sm-12">
				  	    	<button type="button" @click="get" style="border-radius: 10px;" class="layui-btn layui-btn-sm"/> 查询课程 </button>
				  	    	<button type="button" @click="add" style="border-radius: 10px;" class="layui-btn layui-btn-sm layui-btn-normal"/> 立即提交 </button>
				  	    	<button type="reset" style="border-radius: 10px;" class="layui-btn layui-btn-sm layui-btn-primary"/> 重置 </button>
				  	    </div>
				  	    </div>
			        </form>
		        </div>
	     </div>
	     </div>
	     <div class="layui-col-md6" v-show="show1">
	    <div class="panel panel-default" style="border-radius: 10px;">
		     <div class="panel-heading font-bold bg-white" style="border-radius: 10px;">
			    查询结果
			    </div>
				<div class="panel-body">
					<form class="form-horizontal devform">		
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							  <div v-for="(rs,key) in row">
								  <div class="panel panel-default">
								    <div class="panel-heading" role="tab" id="headingOne">
								      <h4 class="panel-title">								
								        <a role="button" data-toggle="collapse" data-parent="#accordion" :href="'#'+key" aria-expanded="true" >
								         <b>{{rs.userName}}</b>  {{rs.userinfo}} <span v-if="rs.msg=='查询成功'"><b style="color: green;">{{rs.msg}}</b></span><span v-else-if="rs.msg!='查询成功'"><b style="color: red;">{{rs.msg}}</b></span>
								        </a>
								      </h4>
								    </div>
								    <div :id="key" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								      <div class="panel-body">
								      	  <div v-for="(res,key) in rs.data" class="checkbox checkbox-success">
								      	  	   <li><input type="checkbox" :value="res.name" @click="checkResources(rs.userinfo,rs.userName,rs.data,res.id,res.name)"><label for="checkbox1"></label><span>{{res.name}}</span><span v-if="res.id!=''">[课程ID:{{res.id}}]</span></li>
								      
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



 <script type="text/javascript">
    /* 鼠标特效 */
    var a_idx = 0;
    jQuery(document).ready(function($) {
        $("body").click(function(e) {
            var a = new Array("富强","民主","文明","和谐","自由","平等","公正","法治","爱国","敬业","诚信","友善");
            var $i = $("<span />").text(a[a_idx]);
            a_idx = (a_idx + 1) % a.length;
            var x = e.pageX
              , y = e.pageY;
            $i.css({
                "z-index": 999999999999999999999999999999999999999999999999999999999999999999999,
                "top": y - 20,
                "left": x,
                "position": "absolute",
                "font-weight": "bold",
                "color": "#ff6651"
            });
            $("body").append($i);
            $i.animate({
                "top": y - 180,
                "opacity": 0
            }, 1500, function() {
                $i.remove();
            });
        });
    });
</script>

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
	   	    	var loading=layer.load(2);
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
	        var loading=layer.load(2);
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
		  var id='<?php echo $id;?>';
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