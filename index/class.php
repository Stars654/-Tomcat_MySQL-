<?php
$title='编辑平台网课';
require_once('head.php');
if($userrow['uid']!=1){exit("<script language='javascript'>window.location.href='login.php';</script>");}
?>







     <div class="app-content-body ">
        <div class="wrapper-md control" id="orderlist">
        	
	    <div class="panel panel-default" >
		    <div class="panel-heading font-bold bg-white">平台列表&nbsp;<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-add">添加</button>&nbsp;<button type="button"  class="btn btn-xs btn-success" @click="yjxj">一键下架</button>&nbsp;<button type="button"  class="btn btn-xs btn-success" @click="yjsj">一键上架</button>&nbsp;<button class="btn btn-xs btn-success" @click="yjflsj">按分类上架</button>&nbsp;<button class="btn btn-xs btn-success" @click="yjflxj">按分类下架</button>
		  <font style="color:yellow; background-color:red">(密价【会员价】必须要设置，否则前端用户会看到价格为0，不过也不会撸你的余额，一样扣，只是显示有点问题)</font></div>
<!--<div class="panel-body">-->
    <!-- 搜索表单 -->
    <form class="form-inline" @submit.prevent="searchPlatform">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <input type="text" class="form-control" v-model="searchKeyword" placeholder="输入平台名字或 ID">
                </div>
                <button type="submit" class="btn btn-primary">搜索</button>
            </div>
        </div>
    </form>
<!--</div>-->






		  
		  
		  
		  
		  
		  
				 <div class="panel-body">
		      <div class="table-responsive">
		        <table class="table table-striped">
		          <thead><tr><th>操作</th><th>ID</th><th>排序</th><th>平台名字</th><th>定价</th><th>密价【会员价】</th><th>查课扣费</th><th>查询接口</th><th>交单接口</th><th>查询参数</th><th>对接参数</th><th>下单计算</th><th>所在分类</th><th>状态</th><th>添加时间</th></tr></thead>
		          <tbody>
		            <tr v-for="res in row.data">
		                <td><button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-update" @click="storeInfo=res">编辑</button></td>   
		            	<td>{{res.cid}}</td>
		            	<td>{{res.sort}}</td>
		            	<td>{{res.name}}</td>
		            	<td>{{res.price}}</td>
		            	<td>{{res.vipprice}}</td>
		            	<td>{{res.ckkf}}</td>
		            	<td>{{res.cx_name}}</td>
		            	<td>{{res.add_name}}</td>
		            	<td>{{res.getnoun}}</td>
		            	<td>{{res.noun}}</td>
		            	<td>{{res.yunsuan=='*'?"乘法":"加法"}}</td>
		            		<td><span class="btn btn-xs btn-success">{{res.fenlei_name}}</span></td>
		            	<td><span class="btn btn-xs btn-success" v-if="res.status==1">上架中</span><span class="btn btn-xs btn-danger" v-else-if="res.status==0">已下架</span></td>
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
        <div class="modal fade primary" id="modal-update">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">平台修改</h4>
                    </div>
           
                    <div class="modal-body">
                        <form class="form-horizontal" id="form-update">
                            <input type="hidden" name="action" value="update"/>
                            <input type="hidden" name="cid" :value="storeInfo.cid"/>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">排序</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="sort" class="layui-input" :value="storeInfo.sort" placeholder="输入数字,商品排序从小到大">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">平台名字</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="name" class="layui-input" :value="storeInfo.name" placeholder="输入平台名字">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">定价</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="price" class="layui-input" :value="storeInfo.price" placeholder="输入价格">
                               </div>
                            </div>
                             <div class="form-group">
                               <label class="col-sm-3 control-label">密价【会员价】</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="vipprice" class="layui-input" :value="storeInfo.vipprice" placeholder="密价【会员价】">
                               </div>
                            </div>
                            
                               <div class="form-group">
                               <label class="col-sm-3 control-label">查课扣费</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="ckkf" class="layui-input" :value="storeInfo.ckkf" placeholder="要乘以我的价格">
                               </div>
                            </div>
                            
                            
                            
                            
                            <div class="form-group">
                               <label class="col-sm-3 control-label">查询参数</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="getnoun" class="layui-input" :value="storeInfo.getnoun" placeholder="输入标识">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">对接参数</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="noun" class="layui-input" :value="storeInfo.noun" placeholder="输入标识">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">说明</label>
                                <div class="col-sm-9"> 
                                  <textarea name="content" class="layui-textarea" rows="3" :value="storeInfo.content"></textarea>           
                               </div>
                            </div>
                            <div class="form-group">
                             	<label class="col-sm-3 control-label">查询平台</label>
                             	<div class="col-sm-9">   
	                            <select name="queryplat" :value="storeInfo.queryplat" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">
	                            	<option value="0">自营</option>
	                            	<?php
	                            		   	 $a=$DB->query("select * from qingka_wangke_huoyuan");
	                            		   	 while($b=$DB->fetch($a)){	            
	                            		   	 	echo '<option value="'.$b['hid'].'">'.$b['name'].'</option>';	
	                            		   	 }
	 
									?>
	                            </select>
	                            </div>
                            </div>
                           <div class="form-group">
                             	<label class="col-sm-3 control-label">交单平台</label>
                             	<div class="col-sm-9">   
	                            <select name="docking" :value="storeInfo.docking" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">	
	                            	<option value="0">自营</option>                            	                            	
	                            	<?php
	                            		   	 $a=$DB->query("select * from qingka_wangke_huoyuan");
	                            		   	 while($b=$DB->fetch($a)){
	                            		   	 	echo '<option value="'.$b['hid'].'">'.$b['name'].'</option>';	
	                            		   	 }
									?>
	                            </select>
	                            </div>
                            </div>
                            <div class="form-group">
                             	<label class="col-sm-3 control-label">代理下单算法</label>
                             	<div class="col-sm-9">   
	                            <select name="yunsuan" :value="storeInfo.yunsuan" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">	                            	                            	
	                               <option value="*">乘法</option>
	                               <option value="+">加法</option>
	                            </select>
	                            </div>
                            </div>
                            <div class="form-group">
                            	<label class="col-sm-3 control-label">状态</label>
                            	<div class="col-sm-9">   
	                            <select name="status" :value="storeInfo.status" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">
	                                <option value="1">上架</option>
	                                <option value="0">下架</option>
	                            </select>
	                            </div>
                            </div>
                            <div class="form-group">
                             	<label class="col-sm-3 control-label">分类</label>
                             	<div class="col-sm-9">   
	                            <select name="fenlei" :value="storeInfo.fenlei" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">	
	                            	<option value="">无</option>
	                            	<?php
	                            		   	 $a=$DB->query("select * from qingka_wangke_fenlei ORDER BY `sort` ASC");
	                            		   	 while($b=$DB->fetch($a)){
	                            		   	 	echo '<option value="'.$b['id'].'">'.$b['name'].'</option>';	
	                            		   	 }
									?>
									<option value="wck">无查课</option>
	                            </select>
	                            </div>
                            </div>
                            
                            
                            
                            
                            
                             
                            <div class="form-group">
                            	<label class="col-sm-3 control-label">下单是否需要课程id</label>
                            	<div class="col-sm-9">   
	                            <select name="kcid" :value="storeInfo.kcid" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">
	                                <option value="0">不需要</option>
	                                <option value="1">需要</option>
	                            </select>
	                            </div>
                            </div>
                            
                            
                            
                            
                            
                         </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="layui-btn layui-btn-danger" data-dismiss="modal">取消</button>
                        <button type="button" class="layui-btn" @click="form('update')">确定</button>
                    </div>
                </div>
            </div>
        </div>
  
  
        <div class="modal fade primary" id="modal-add">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">平台添加</h4>
                    </div>
           
                    <div class="modal-body">
                        <form class="form-horizontal" id="form-add">
                            <input type="hidden" name="action" value="add"/>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">排序</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="sort" class="form-control"  placeholder="输入数字,不填默认10,商品排序从小到大">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">平台名字</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="name" class="form-control"  placeholder="输入平台名字">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">定价</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="price" class="form-control"  placeholder="输入价格">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">密价【会员价】</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="vipprice" class="form-control"  placeholder="输入价格">
                               </div>
                            </div>
                             <div class="form-group">
                               <label class="col-sm-3 control-label">查课扣费</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="ckkf" class="form-control"  placeholder="输入价格">
                               </div>
                            </div>
                            
                            
                            
                            <div class="form-group">
                               <label class="col-sm-3 control-label">查询参数</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="getnoun" class="form-control"  placeholder="输入标识">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">对接参数</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="noun" class="form-control" placeholder="输入标识">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">说明</label>
                                <div class="col-sm-9"> 
                                  <textarea name="content" class="form-control" rows="3"></textarea>           
                               </div>
                            </div>
                            <div class="form-group">
                             	<label class="col-sm-3 control-label">查询平台</label>
	                            <div class="col-sm-9">                             	
		                            <select name="queryplat" class="form-control">
		                            	<option value="0">自营</option>
		                            	<?php
		  	                            		$a=$DB->query("select * from qingka_wangke_huoyuan");
		                            		   	 while($b=$DB->fetch($a)){
		                            		   	 	echo '<option value="'.$b['hid'].'">'.$b['name'].'</option>';	
		                            		   	 }
										?>
		                            </select>
		                       </div>
	                       </div>
                           <div class="form-group">
                             	<label class="col-sm-3 control-label">对接平台</label>
                             	<div class="col-sm-9">   
	                            <select name="docking" class="form-control">
	                            	<option value="0">自营</option>
	                            	<?php
	                            		   	 $a=$DB->query("select * from qingka_wangke_huoyuan");
	                            		   	 while($b=$DB->fetch($a)){
	                            		   	 	echo '<option value="'.$b['hid'].'">'.$b['name'].'</option>';	
	                            		   	 }
									?>
	                            </select>
	                            </div>
                            </div>
                            <div class="form-group">
                            	<label class="col-sm-3 control-label">状态</label>
                            	<div class="col-sm-9">   
	                            <select name="status" class="form-control">
	                                <option value="1">上架</option>
	                                <option value="0">下架</option>
	                            </select>
	                            </div>
                            </div>
                            <div class="form-group">
                             	<label class="col-sm-3 control-label">分类</label>
                             	<div class="col-sm-9">   
	                            <select name="fenlei" class="form-control">
	                            	<option value="">无</option>
	                            	<?php
	                            		   	 $a=$DB->query("select * from qingka_wangke_fenlei ORDER BY `sort` ASC");
	                            		   	 while($b=$DB->fetch($a)){
	                            		   	 	echo '<option value="'.$b['id'].'">'.$b['name'].'</option>';	
	                            		   	 }
									?>
									<option value="wck">无查课</option>
	                            </select>
	                            </div>
                            </div>
                            
                            
                             <div class="form-group">
                            	<label class="col-sm-3 control-label">下单是否需要课程id</label>
                            	<div class="col-sm-9">   
	                            <select name="kcid" class="form-control">
	                                <option value="0">不需要</option>
	                                <option value="1">需要</option>
	                            </select>
	                            </div>
                            </div>
                            
                            
                            
                            
                            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-success" @click="form('add')">确定</button>
                    </div>
                </div>
            </div>
        </div>
  
  
  
  
    </div>
   </div>
 </div>
 
 
 
 
 
 
<?php require_once("footer.php");?>	
<script>
new Vue({
	el:"#orderlist",
	data:{
		row:null,
		storeInfo:{},
		searchKeyword: '',
	},
	methods:{
		get:function(page){
		  var load=layer.load(2);
 			this.$http.post("/apisub.php?act=classlist",{page:page},{emulateJSON:true}).then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){			                     	
	          		this.row=data.body;			             			                     
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
		},
searchPlatform: function () {
    // 清空搜索关键词前后的空白字符
    var keyword = this.searchKeyword.trim();

    // 如果搜索关键词为空，则重新获取全部平台列表数据
    if (keyword === '') {
        this.get(1);
        return;
    }

    // 否则，发送请求获取符合搜索关键词的平台列表数据
    var self = this;
    var load = layer.load(2);
    this.$http.post("/apisub.php?act=searchPlatforms", { keyword: keyword }, { emulateJSON: true }).then(function (data) {
        layer.close(load);
        if (data.data.code == 1) {
            self.row = data.body;
        } else {
            layer.msg(data.data.msg, { icon: 2 });
        }
    });
},
		yjflxj:function(){
		    			layer.confirm('确定下架当前分类已经下架内的所有项目吗？', {title:'温馨提示',icon:1,
							  btn: ['确定','取消'] //按钮
							}, function(){
							  		var load=layer.load(2);
					     			axios.get("/apisub.php?act=yjflxj")
							          .then(function(data){	
							          	   	layer.close(load);
							          	if(data.data.code==1){			                     	
	    			                        layer.alert(data.data.msg,{icon:1,title:"温馨提示"},function(){setTimeout(function(){window.location.href=""});});
							          	}else{
							                layer.msg(data.data.msg,{icon:2});
							          	}
							        });	
							
						    });
		    	    },
	    yjflsj:function(){
		    			layer.confirm('确定上架当前已经上架分类的所有项目吗？', {title:'温馨提示',icon:1,
							  btn: ['确定','取消'] //按钮
							}, function(){
							  		var load=layer.load(2);
					     			axios.get("/apisub.php?act=yjflsj")
							          .then(function(data){	
							          	   	layer.close(load);
							          	if(data.data.code==1){			                     	
	    			                        layer.alert(data.data.msg,{icon:1,title:"温馨提示"},function(){setTimeout(function(){window.location.href=""});});
							          	}else{
							                layer.msg(data.data.msg,{icon:2});
							          	}
							        });	
							
						    });
		    	    },
		yjxj: function () {
      layer.confirm(
        "一键下架之后，所有平台会立即下架，确定下架吗？",
        {
          title: "温馨提示",
          icon: 1,
          btn: ["确定", "取消"] //按钮
        },
        function () {
          var load = layer.load();
          axios.get("/apisub.php?act=yjxj&type=1").then(function (data) {
            layer.close(load);
            if (data.data.code == 1) {
              layer.alert(
                data.data.msg,
                { icon: 1, title: "温馨提示" },
                function () {
                  setTimeout(function () {
                    window.location.href = "";
                  });
                }
              );
            } else {
              layer.msg(data.data.msg, { icon: 2 });
            }
          });
        }
      );
    },
    yjsj: function () {
      layer.confirm(
        "一键上架之后，所有的平台将全部上架，确定上架吗？",
        {
          title: "温馨提示",
          icon: 1,
          btn: ["确定", "取消"] //按钮
        },
        function () {
          var load = layer.load();
          axios.get("/apisub.php?act=yjsj&type=1").then(function (data) {
            layer.close(load);
            if (data.data.code == 1) {
              layer.alert(
                data.data.msg,
                { icon: 1, title: "温馨提示" },
                function () {
                  setTimeout(function () {
                    window.location.href = "";
                  });
                }
              );
            } else {
              layer.msg(data.data.msg, { icon: 2 });
            }
          });
        }
      );
    },
		form:function(form){
		   var load=layer.load(2);
		   
 			this.$http.post("/apisub.php?act=upclass",{data:$("#form-"+form).serialize()},{emulateJSON:true}).then(function(data){	
	          	layer.close(load);
	          	console.log($("#form-"+form).serialize())
	          	if(data.data.code==1){			                     		          		
	          		this.get(this.row.current_page);
	          		$("#modal-" + form).modal('hide');
	          		layer.msg(data.data.msg,{icon:1});	             			window.location.reload(); 
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
		},
		bs:function(oid){
			layer.msg(oid);
		}
	},
	mounted(){
		this.get(1);
	}
});
</script>