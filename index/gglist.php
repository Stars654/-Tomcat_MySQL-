<?php
$title='公告';
require_once('head.php');
if($userrow['uid']!=1){exit("<script language='javascript'>window.location.href='login.php';</script>");}

$uid=$_GET['uid'];
?>
     <div class="app-content-body ">
        <div class="wrapper-md control" id="orderlist">
        	
	    <div class="panel panel-default" >
		    <div class="panel-heading font-bold">公告列表&nbsp;<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-add">添加</button></div>
				 <div class="panel-body">
		      <div class="table-responsive">
		        <table class="table table-striped">
		          <thead><tr><th>ID</th><th>标题</th><th>内容</th><th>时间</th><th>状态</th><th>置顶</th><th>发布人</th><th>操作</th></tr></thead>
		          <tbody>
		            <tr v-for="res in row.data">
		            	<td style="width:20px;">{{res.id}}</td>		            	
		            	<td style="width:100px;">{{res.title}}</td>
		            	<td>{{res.content}}</td>
		            	<td>{{res.time}}</td>
		            	<td><span v-if="res.status==0" class="btn btn-xs btn-danger">不可见</span><span v-if="res.status==1" class="btn btn-xs btn-primary">可见</span></td>
		            	<td><span v-if="res.zhiding==0" class="btn btn-xs btn-danger">未置顶</span><span v-if="res.zhiding==1" class="btn btn-xs btn-primary">置顶</span></td>
		            	<td>{{res.uid}}</td>
		            	<td style="width:120px;"><button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-update" @click="upm=res">编辑</button>
		            		&nbsp;<button class="btn btn-xs btn-danger"  @click="del(res.id)">删除</button>
		            	</td>    
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
                        <h4 class="modal-title">密价修改</h4>
                    </div>
           
                    <div class="modal-body">
                        <form class="form-horizontal" id="form-update">
                            <input type="hidden" name="id" :value="upm.id"/>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">标题</label>
                                <div class="col-sm-9">             
                                  <input type="text" v-model="upm.title" class="form-control" :value="upm.title">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">内容</label>
                                <div class="col-sm-9">             
                               <textarea type="text" v-model="upm.content" class="layui-textarea"  rows="6" :value="upm.content"></textarea>
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">状态</label>
                                <div class="col-sm-9">             
                               <select v-model="upm.status" class="form-control">
	                            	<option value="1">可见</option>
	                            	<option value="0">不可见</option>
	                            </select>
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">置顶</label>
                                <div class="col-sm-9">             
                                  <select v-model="upm.zhiding" class="form-control">
	                            	<option value="0">不置顶</option>
	                            	<option value="1">置顶</option>
	                            </select>
                               </div>
                            </div>    
                                
                         </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal" @click="up_m">确定</button>
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
                        <h4 class="modal-title">公告添加</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="form-add">
                            <div class="form-group">
                               <label class="col-sm-3 control-label">标题</label>
                                <div class="col-sm-9">             
                                  <input type="text" v-model="addm.title" class="form-control">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">内容</label>
                                <div class="col-sm-9">             
                                 <textarea type="text" v-model="addm.content" class="layui-textarea"  rows="6"></textarea>
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">状态</label>
                                <div class="col-sm-9">             
                               <select v-model="addm.status" class="form-control">
	                            	<option value="1">可见</option>
	                            	<option value="0">不可见</option>
	                            </select>
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">置顶</label>
                                <div class="col-sm-9">             
                                  <select v-model="addm.zhiding" class="form-control">
	                            	<option value="0">不置顶</option>
	                            	<option value="1">置顶</option>
	                            </select>
                               </div>
                            </div>    
                                
                         </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal" @click="add_m">确定</button>
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

<script>
vm=new Vue({
	el:"#orderlist",
	data:{
		row:null,
		addm:{
		    status:'1',
		    zhiding:'0'
		},
		upm:{}
	},
	methods:{
		get:function(page){
		  var load=layer.load(2);
 			this.$http.post("/apisub.php?act=gglist1",{uid:this.uid},{emulateJSON:true}).then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){			                     	
	          		this.row=data.body;			             			                     
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
		},add_m:function(){
			var load=layer.load(2);
		 		this.$http.post("/apisub.php?act=ggadd",{data:this.addm,active:1},{emulateJSON:true}).then(function(data){	
          	layer.close(load);
          	if(data.data.code==1){	
          	  	vm.get(1);		                     	
                layer.msg(data.data.msg,{icon:1});             			                     
          	}else{
                layer.msg(data.data.msg,{icon:2});
          	}
        });	
		},up_m:function(){
			var load=layer.load(2);
		 		this.$http.post("/apisub.php?act=ggadd",{data:this.upm,active:2},{emulateJSON:true}).then(function(data){	
          	layer.close(load);
          	if(data.data.code==1){	
          		  vm.get(1);		                     	
                layer.msg(data.data.msg,{icon:1});             			                     
          	}else{
                layer.msg(data.data.msg,{icon:2});
          	}
        });	
		},del:function(id){
			var load=layer.load(2);
		 		this.$http.post("/apisub.php?act=gg_del",{id:id},{emulateJSON:true}).then(function(data){	
          	layer.close(load);
          	if(data.data.code==1){	
          		  vm.get(1);		                     	
                layer.msg(data.data.msg,{icon:1});             			                     
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