<?php
$title='编辑平台网课';
require_once('head.php');
if($userrow['uid']!=1){exit("<script language='javascript'>window.location.href='login.php';</script>");}
?>
<div class="app-content-body ">
        <div class="wrapper-md control" id="orderlist">
        	
	    <div class="panel panel-default" >
		    <div class="panel-heading font-bold bg-white">平台列表(这里乱添加会出问题)&nbsp;<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-add">添加</button></div>
				 <div class="panel-body">
		      <div class="table-responsive">
		        <table class="table table-striped">
		          <thead><tr><th>操作</th><th>ID</th><th>名称</th><th>平台</th><th>账号</th><th>密码</th><th>网址</th><th>密钥/token</th><th>添加时间</th></tr></thead>
		          <tbody>
		            <tr v-for="res in row.data">
		                <td><button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-update" @click="storeInfo=res">编辑</button>&nbsp;<button v-if="res.pt === '27'" class="btn btn-xs btn-primary" data-toggle="modal" @click="yjdj(res.hid)">一键对接</button></td>
		            	<td>{{res.hid}}</td>
		            	<td>{{res.name}}</td>
		            	<td>{{res.pt}}</td>
		            	<td>{{res.user}}</td>
		            	<td>{{res.pass}}</td>
		            	<td>{{res.url}}</td>
		            	<td>{{res.token}}</td>
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
                            <input type="hidden" name="hid" :value="storeInfo.hid"/>
                             <div class="form-group">
                               <label class="col-sm-3 control-label">名称</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="name" class="layui-input" :value="storeInfo.name" placeholder="输入自定义名称">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">平台</label>
	                            <div class="col-sm-9">   
		                            <select name="pt" class="layui-select" :value="storeInfo.pt" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">
		                            	<?php
		                            		$a=wkname();
		                            		   foreach($a as $key => $value){ 	                            		   	
		                            		      echo	'<option value="'.$key.'">'.$value.'</option>';													
										        }
										?>
		                            </select>
		                        </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">域名</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="url" class="layui-input" :value="storeInfo.url" placeholder="输入域名">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">账号</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="user" class="layui-input" :value="storeInfo.user" placeholder="输入账号,27对接填uid">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">密码</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="pass" class="layui-input" :value="storeInfo.pass" placeholder="输入密码,27对接填key">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">密匙/token</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="token" class="layui-input" :value="storeInfo.token" placeholder="输入密匙/token，没有则不输入">
                               </div>
                            </div>
                            <!--<div class="form-group">-->
                            <!--   <label class="col-sm-3 control-label">IP</label>-->
                            <!--    <div class="col-sm-9">             -->
                            <!--      <input type="text" name="ip" class="form-control" :value="storeInfo.ip" placeholder="模拟指定IP对接，请输入ip地址，不指定留空">-->
                            <!--   </div>-->
                            <!--</div>                           -->
                            <div class="form-group">
                               <label class="col-sm-3 control-label">cookie</label>
                                <div class="col-sm-9"> 
                                  <textarea name="cookie"  placeholder="没必要，不用输入" class="layui-textarea" :value="storeInfo.cookie" rows="4"></textarea>           
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
                               <label class="col-sm-3 control-label">名称</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="name" class="form-control"  placeholder="输入自定义名称">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">平台</label>
	                            <div class="col-sm-9">   
		                            <select name="pt" class="form-control">
		                            	<?php
		                            		$a=wkname();
		                            		   foreach($a as $key => $value){ 	                            		   	
		                            		      echo	'<option value="'.$key.'">'.$value.'</option>';													
										        }
										?>
		                            </select>
		                        </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">域名</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="url" class="form-control"  placeholder="输入域名">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">账号</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="user" class="form-control"  placeholder="输入账号,27对接填uid">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">密码</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="pass" class="form-control"  placeholder="输入密码,27对接填key">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">密匙/token</label>
                                <div class="col-sm-9">             
                                  <input type="text" name="token" class="form-control" placeholder="输入密匙/token，没有则不输入">
                               </div>
                            </div>
                            <!--<div class="form-group">-->
                            <!--   <label class="col-sm-3 control-label">IP</label>-->
                            <!--    <div class="col-sm-9">             -->
                            <!--      <input type="text" name="ip" class="form-control" placeholder="模拟指定IP对接，请输入ip地址，不指定留空">-->
                            <!--   </div>-->
                            <!--</div>                           -->
                            <div class="form-group">
                               <label class="col-sm-3 control-label">cookie</label>
                                <div class="col-sm-9"> 
                                  <textarea name="cookie"  placeholder="没必要，不用输入"  class="form-control" rows="4"></textarea>           
                               </div>
                            </div>                           
                         </form>
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
		storeInfo:{}
	},
	methods:{
		get:function(page){
		  var load=layer.load(2);
 			this.$http.post("/apisub.php?act=huoyuanlist",{page:page},{emulateJSON:true}).then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){			                     	
	          		this.row=data.body;			             			                     
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
		},
yjdj: function(hid) {
    layer.confirm('确定对接该平台的所有的项目吗？', {
        title: '温馨提示',
        icon: 1,
        btn: ['确定', '取消']
    }, function() {
        var category = prompt("请输入要对接的分类ID："); // 弹出对话框获取分类ID
        if (category != null) {
            var pricee = prompt("请输入要增加的百分比价格：1.05 就是增加5% 看不懂问数学老师"); // 弹出对话框获取价格
            if (pricee != null) {
                var load = layer.load(2);
                $.get("/apisub.php?act=yjdj&hid=" + hid + "&pricee=" + pricee + "&category=" + category, function(data) {
                    layer.close(load);
                    if (data.code == 1) {
                        top.location = "../index/class";
                        layer.msg(data.msg, { icon: 1 });
                    } else {
                        layer.msg(data.msg, { icon: 2 });
                    }
                });
            }
        }
    });
},
		form:function(form){
		   var load=layer.load(2);
 			this.$http.post("/apisub.php?act=uphuoyuan",{data:$("#form-"+form).serialize()},{emulateJSON:true}).then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){
	          		this.get(this.row.current_page);
	          		$("#modal-" + form).modal('hide');
	          		layer.msg(data.data.msg,{icon:1});
	          	window.location.reload(); 
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