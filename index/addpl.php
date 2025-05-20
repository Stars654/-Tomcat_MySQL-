<?php
$title = '提交订单';
include '../confing/common.php';
$addsalt = md5(mt_rand(0, 999) . time());
$_SESSION['addsalt'] = $addsalt;
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
<!--<link href="./assets/css/tailwind.min.css" rel="stylesheet">-->
<script src="https://at.alicdn.com/t/font_1185698_xknqgkk0oph.js?spm=a313x.7781069.1998910419.40&file=font_1185698_xknqgkk0oph.js"></script>
<style>
    /* 在屏幕宽度小于768px时，使用这个CSS类隐藏元素 */
    @media screen and (max-width: 767px) {
        .hide-on-mobile {
            display: none;
        }
    }

    /* 颜色类合并 */
    .color-blue { color: #3498db; }
    .color-red { color: #e74c3c; }
    .color-green { color: #2ecc71; }
    .color-purple { color: #9b59b6; }
    .color-yellow { color: #f1c40f; }
    .color-navy { color: #34495e; }
    .color-teal { color: #1abc9c; }
    .color-orange { color: #d35400; }
    .color-grey { color: #7f8c8d; }

    /* 图标类合并 */
    .susuicon, .susuicon2, .flex, .flex2 {
        position: absolute;
        vertical-align: -0.15em;
        fill: currentColor;
        overflow: hidden;
    }

    .susuicon {
        left: 21px;
        top: 14px;
        width: 1.3em;
        height: 1.3em;
    }

    .susuicon2, .flex2 {
        top: 50%;
        right: 20px;
        margin-top: -7px;
        transition: transform .3s;
        width: 1.1em;
        height: 1.1em;
    }

    .flex {
        bottom: 7px;
        left: 5px;
        width: 2em;
        height: 2em;
    }

    .flex2 {
        float: left;
        margin-top: 2px;
        margin-right: 5px;
        width: 1.4em;
        height: 1.4em;
    }

    .malet {
        padding-left: 20px;
        font-size: 11px;
    }

    .nav>li:hover {
        background-color: #f8f8ff;
    }

    hr {
        height: 1px;
        margin: 4px;
    }

    /* 表单样式合并 */
    .frosss, .frosss2 {
        height: 38px;
        border-radius: 8px !important;
        border: 2px solid #ebebeb;
        padding: 5px 12px;
        line-height: inherit;
        transition: 0.2s linear;
        box-shadow: none;
    }

    .frosss2 {
        display: block;
        width: 100%;
    }

    .table>thead>tr>th {
        padding: 20px;
    } /* 修复了缺少闭合括号的问题 */

    /* 响应式布局 */
    .column-container {
        columns: 1;
        -webkit-columns: 1;
        -moz-columns: 1;
    }

    .column-item {
        break-inside: avoid;
        page-break-inside: avoid;
        -webkit-column-break-inside: avoid;
    }

    @media (min-width: 768px) {
        .column-container {
            columns: 2;
            -webkit-columns: 2;
            -moz-columns: 2;
        }
    }

    /* Element UI样式覆盖 */
    .form-group .el-textarea .el-textarea__inner {
        color: blue !important;
    }

    .lioverhide {
        width: 300px;
    }

    .flex-row {
        display: flex;
        align-items: stretch;
    }

    @media (min-width: 992px) {
        .col-md-7 {
            flex: 0 0 70%;
            max-width: 70%;
        }

        .col-md-3 {
            flex: 0 0 30%;
            max-width: 30%;
        }
    }

    .custom-notification-list {
        list-style: none;
        padding: 0;
    }

    .custom-notification-list li {
        position: relative;
        padding-left: 20px;
        margin-bottom: 10px;
    }

    .custom-notification-list li:before {
        content: "";
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #3498db;
    }

    .notification-number {
        font-weight: bold;
        color: #3498db;
        margin-right: 5px;
    }
    @media (max-width: 767px) {
  .layui-col-xs12.layui-col-md4 {
    padding-left: 0 !important;
  }
}
.layui-row {
  display: flex;
  flex-wrap: wrap; /* 允许元素在必要时换行 */
}

.layui-col-xs12 {
  display: flex;
  flex-direction: column; /* 让子元素垂直排列 */
}

.panel {
  display: flex;
  flex-direction: column; /* 让.panel内的元素垂直排列 */
  flex: 1; /* 让.panel元素伸展并占据父元素的全部高度 */
}

.panel-body {
  flex-grow: 1; /* 让.panel-body元素在有多余空间时伸展 */
}
.panel-body img {
  max-height: 300px; /* 设置图片的最大高度，根据需要调整 */
  object-fit: cover; /* 如果您希望图片覆盖整个区域，可以使用这个属性 */
  /* 其他样式根据需要添加 */
}
</style>
<style>
  /* 在宽度小于768px的设备上不显示该元素 */
  @media only screen and (max-width: 768px) {
    .hide-on-mobile {
      display: none;
    }
  }
</style>
   <div class="app-content-body ">
        <div class="wrapper-md control" id="add">
             <div class="layui-row">
      <div class="layui-col-xs12 layui-col-md8" style="padding-right: 1px; box-sizing: border-box;">
    <div class="grid-demo grid-demo-bg1">
         
	       <div class="panel panel-default" style="box-shadow: 8px 8px 15px #d1d9e6, -18px -18px 30px #fff; border-radius:8px;">
		    <div class="panel-heading font-bold " style="border-top-left-radius: 8px; border-top-right-radius: 8px;background-color:#fff;">
		    <div style="float:right;margin-right:20px;"><el-link type="primary"></el-link></div>
			    订单提交
		     </div>
				<div class="panel-body" style="margin-left:0;">
					<el-form class="form-horizontal devform">
					    <?php if ($conf['flkg'] == "1" && $conf['fllx'] == "1") { ?>
					    <div class="form-group">
					        <label class="col-sm-2 control-label">项目分类</label>
					        <div class="col-sm-9">
					            <select class="layui-select" v-model="id" @change="fenlei(id);"  style="scroll 99%; border-radius: 8px; width:100%" >
					                <option value="">全部分类</option>
					                <?php
                     $a = $DB->query(
                         "select * from qingka_wangke_fenlei where status=1  ORDER BY `sort` ASC"
                     );
                     while ($rs = $DB->fetch($a)) { ?>
					                <option :value="<?= $rs['id'] ?>"><?= $rs['name'] ?></option>
					                <?php }
                     ?>
					                </select>
					         </div>
					         </div>
					    <?php } elseif ($conf['flkg'] == "1" && $conf['fllx'] == "2") { ?>
					    <div class="form-group">
					        <label class="col-sm-2 control-label">项目分类</label>
					        <div class="col-sm-9">
					            <div class="col-xs-12">
					                <div class="example-box">
					                    <label class="lyear-radio radio-inline radio-info">
					                        <input type="radio" name="e" checked="" @change="fenlei('');"><span style="color: #333333;">全部</span>
					                    </label>
					                    <?php
                         $a = $DB->query(
                             "select * from qingka_wangke_fenlei where status=1  ORDER BY `sort` ASC"
                         );
                         while ($rs = $DB->fetch($a)) { ?>
					                    <label class="lyear-radio radio-inline radio-info">
					                        <input type="radio" name="e" @change="fenlei(<?= $rs[
                                 'id'
                             ] ?>);"><span style="color: #333333;"><?= $rs[
    'name'
] ?></span>
					                    </label>
					                    <?php }
                         ?>
					                </div>
					            </div>
					         </div>
						</div>
					    <?php } ?>
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
  <label class="col-sm-2 control-label">信息填写</label>
  <div class="col-sm-9">
    <textarea rows="5" class="frosss2" style="height:120px;" v-model="userinfo" placeholder="账号 密码&#13;&#10;账号 密码"></textarea>
  </div>
</div>
						<div class="form-group">
    <label class="col-sm-2 control-label">网课说明</label>
    <div class="col-sm-9">
        <el-input
            type="textarea"
            :rows="4"
            placeholder="请选择商品查看说明"
            v-model="content"
            disabled>
        </el-input>
    </div>
</div>
				  	    <div class="col-sm-offset-2">
				  	    	<el-button type="primary" @click="get" icon="el-icon-search" round>立即查询</el-button>
				  	    	<el-button type="primary" @click="add" icon="el-icon-circle-check" round>提交订单</el-button>&nbsp;&nbsp;&nbsp;
				  	        <!-- 按钮的HTML代码 -->
<button class="btn btn-label btn-round btn-warning hide-on-mobile" type="reset" value="清空数据">
    <label><i class="mdi mdi-delete-empty"></i></label> 清空数据
</button>
 	        
		       </div>
			 </el-form>
		   </div>
	     </div>
	    </div>
	  </div>
	   
	  <div class="layui-col-xs12 layui-col-md4 hide-on-mobile" style="padding-left: 10px; box-sizing: border-box;">
  <div class="panel panel-default" style="box-shadow: 8px 8px 15px #d1d9e6, -18px -18px 30px #fff; border-radius:8px;">
    <div class="panel-heading font-bold" style="border-top-left-radius: 8px; border-top-right-radius: 8px;background-color:#fff;">
      最新通知
    </div>
    <div class="panel-body" style="margin-left:0;">
      <img src="http://damie.bio/assets/images/1.jpg" alt="最新通知" style="width: 100%; height: auto; border-radius: 8px;">
      <p style="text-align: center; margin-top: 10px; font-weight: bold; color: blue;">欢迎老板们下单</p>
    </div>
  </div>
</div>
	   
	   
 </div>
	     

<div class="row">
    <div class="col-xs-12">
	    <div class="panel panel-default" style="box-shadow: 8px 8px 15px #d1d9e6, -18px -18px 30px #fff; border-radius:8px;">
  <div class="panel-heading font-bold" style="border-top-left-radius: 8px; border-top-right-radius: 8px;background-color:#fff;">
    查询结果 &nbsp;
    <a class="el-button el-button--primary is-plain el-button--mini" style="padding: 4px 10px;" @click="selectAll()">全选</a>
  </div>
  <div class="panel-body">
    <form class="form-horizontal devform">    
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div v-for="(rs, key) in row">
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title">                
                <a role="button" data-toggle="collapse" data-parent="#accordion" :href="'#'+key" aria-expanded="true" >
                  <b>{{ rs.userName }}</b>  {{ rs.userinfo }} <span v-if="rs.msg=='查询成功'"><b style="color: green;">{{ rs.msg }}</b></span><span v-else-if="rs.msg!='查询成功'"><b style="color: red;">{{ rs.msg }}</b></span>
                </a>
              </h4>
            </div>
            <div :id="key" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">
                <!-- Column container -->
                <div class="column-container">
                  <!-- Column items -->
                  <div v-for="(res, key) in rs.data" class="column-item">
                    <label class="layui-table lyear-checkbox checkbox-inline checkbox-success">
                      <li>
                        <input style="margin-left: 0px;" :checked="checked" name="checkbox" type="checkbox" :value="res.name" @click="checkResources(rs.userinfo, rs.userName, rs.data, res.id, res.name)">
                        <span>{{ res.name }} <b v-if="res.state!=''">  {{ res.state }} </b><b v-else> - 开课中 </b> </span><br>
                        <span v-show="res.id">[课程ID:{{ res.id }}]</span>
                      </li>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>      
    </form>
  </div>
</div>

        <div class="panel panel-default" style="box-shadow: 8px 8px 15px #d1d9e6, -18px -18px 30px #fff; border-radius:8px;">
    <div class="panel-heading font-bold bg-white" style="border-radius: 10px; color: #3498db;">注意事项</div>
    <div class="panel-body">
        <ul class="layui-timeline">
            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis" style="color: #e74c3c;"></i>
                <div class="layui-timeline-content layui-text" style="color: #2ecc71;">
                    <p>请务必查看项目下单须知和说明，防止出现错误！</p>
                </div>
            </li>
            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis" style="color: #9b59b6;"></i>
                <div class="layui-timeline-content layui-text" style="color: #f1c40f;">
                    <p>同商品重复下单，请修改密码后再下！</p>
                </div>
            </li>
            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis" style="color: #34495e;"></i>
                <div class="layui-timeline-content layui-text" style="color: #1abc9c;">
                    <p>默认下单格式为学校、账号、密码(空格分开)！</p>
                </div>
            </li>
            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis" style="color: #d35400;"></i>
                <div class="layui-timeline-content layui-text" style="color: #7f8c8d;">
                    <p>查课出问题及时反馈！</p>
                </div>
            </li>
        </ul>
    </div>
</div>
    </div>
<script>
    
$(document).ready(function(){
 $("#btn4").click(function(){ 
$("input[name='checkbox']").each(function(){ 
if($(this).attr("checked")) 
{ 
$(this).removeAttr("checked"); 
} 
else
{ 
$(this).attr("checked","true"); 
} 
}) 
}) 




}); 
</script>


<script type="text/javascript" src="assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/main.min.js"></script>
<script src="assets/js/aes.js"></script>
<script src="../assets/js/vue.min.js"></script>
<script src="https://cdn.staticfile.org/vue-resource/1.5.1/vue-resource.min.js"></script>
<script src="https://cdn.staticfile.org/axios/0.18.0/axios.min.js"></script>
<script src="./assets/js/element.js"></script>




<script>
var vm=new Vue({
	el:"#add",
	data:{	
	    row:[],
	    shu:'',
	    bei:'',
	    nochake:0,
	    check_row:[],
		userinfo:'',
		cid:'',
		miaoshua:'',
		class1:'',
		class3:'',
		activems:false,
		checked:false,
		content:''
		
		
	},
	methods:{
	    get: function(salt) {
    if (this.cid == '' || this.userinfo == '') {
        layer.msg("所有项目不能为空");
        return false;
    }
    userinfo = this.userinfo.replace(/\r\n/g, "[br]").replace(/\n/g, "[br]").replace(/\r/g, "[br]");
    userinfo = userinfo.split('[br]'); //分割
    this.row = [];
    this.check_row = [];
    this.checked = false; // Reset the checked status when performing a new query
    for (var i = 0; i < userinfo.length; i++) {
        info = userinfo[i]
        if (info == '') { continue; }
        var hash = getENC('<?php echo $addsalt; ?>');
        var loading = layer.load(1);
        this.$http.post("/apisub.php?act=get", {
            cid: this.cid,
            userinfo: info,
            hash
        }, {
            emulateJSON: true
        }).then(function(data) {
            layer.close(loading);
            if (data.body.code == -7) {
                salt = getENC(data.body.msg);
                vm.get(salt);
            } else {
                this.row.push(data.body);
            }
        });
    }
},
	    add: function() {
    if (this.cid == '') {
        if (this.nochake != 1) {
            layer.msg("请先查课");
            return false;
        }
    }
    if (this.check_row.length < 1) {
        if (this.nochake != 1) {
            layer.msg("请先选择课程");
            return false;
        }
    }
    //console.log(this.check_row);
    var loading = layer.load(1);
    this.$http.post("/apisub.php?act=add", {
        cid: this.cid,
        data: this.check_row,
        shu: this.shu,
        bei: this.bei,
        userinfo: this.userinfo,
        nochake: this.nochake
    }, {
        emulateJSON: true
    }).then(function(data) {
        layer.close(loading);
        if (data.data.code == 1) {
            var submittedCoursesCount = this.check_row.length; // 获取提交的课程数量
            this.row = [];
            this.check_row = [];
            // 显示提交成功的消息，并包含提交的课程数量
            layer.msg('提交成功' + submittedCoursesCount + '门课程', {icon: 1, time: 2000});
        } else {
            this.$message({type: 'error', showClose: true, message: data.data.msg});
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
	    selectAll:function () {            
            if(this.cid==''){
	    		layer.msg("请先查课");
	    		return false;
	    	} 	
	    	this.checked=!this.checked;  
	    	if(this.check_row.length<1){
		    	for(i=0;i<vm.row.length;i++){
		    		console.log(i);
		    		userinfo=vm.row[i].userinfo
		    		userName=vm.row[i].userName
		    		rs=vm.row[i].data
		            for(a=0;a<rs.length;a++){
			    		aa=rs[a]
			    		data={userinfo,userName,data:aa}
			    		vm.check_row.push(data);
			        } 				    	
				}     	          
            }else{
            	vm.check_row=[]
            }   	    
	    	console.log(vm.check_row);                            
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
		  var load=layer.load(1);
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
		  var load=layer.load(1);
 			this.$http.post("/apisub.php?act=getclass").then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){			                     	
	          		this.class1=data.body.data;			             			                     
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
	    	
	    },
	    getnock:function(cid){
 			this.$http.post("/apisub.php?act=getnock").then(function(data){	
	          	if(data.data.code==1){			                     	
	          		this.nock=data.body.data;	
	          		for(i=0;this.nock.length>i;i++){
	          		    if(cid==this.nock[i].cid){
	          		        this.nochake=1;
	          		        break;
	          		    }else{
	          		        this.nochake=0;
	          		    }
	          		}
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
	    	
	    },tips: function (message) {
        	 for(var i=0;this.class1.length>i;i++){
        	 	if(this.class1[i].cid==message){
        	 	    this.show = true;
        	 	    this.content = this.class1[i].content;
                    /*layer.open({
                	 		    type: 0 
                                ,title: '商品说明'
                                ,content: this.class1[i].content
                                ,time: 5000
                                ,shade: 0  //不显示遮罩
                                ,anim: 1
                                ,maxmin: true
                                ,
                            });*/
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