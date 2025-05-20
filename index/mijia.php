<?php
$title='编辑用户密价';
require_once('head.php');
if($userrow['uid']!=1){exit("<script language='javascript'>window.location.href='login.php';</script>");}

$uid=$_GET['uid'];
?>
     <div class="app-content-body ">
        <div class="wrapper-md control" id="orderlist">
        	
	    <div class="panel panel-default" >
		    <div class="panel-heading font-bold bg-white">密价列表&nbsp;<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-add">添加</button></div>
				 <div class="panel-body">
		      <div class="table-responsive">
		        <table class="table table-striped">
		          <thead><tr><th>ID</th><th>UID</th><th>课程</th><th>类型</th><th>金额/倍数</th><th>添加时间</th><th>操作</th></tr></thead>
		          <tbody>
		            <tr v-for="res in row.data">
		            	<td>{{res.mid}}</td>		            	
		            	<td>{{res.uid}}</td>
		            	<td>[{{res.cid}}] {{res.name}}</td>
		            	<td><span v-if="res.mode==0">价格的基础上扣除</span><span v-if="res.mode==1">倍数的基础上扣除</span><span v-if="res.mode==2">直接定价</span></td>
		            	<td>{{res.price}}</td>
		            	<td>{{res.addtime}}</td>
		            	<td><button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-update" @click="upm=res">编辑</button>
		            		&nbsp;<button class="btn btn-xs btn-danger"  @click="del(res.mid)">删除</button>
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
                            <input type="hidden" name="action" value="update"/>
                            <input type="hidden" name="cid" :value="storeInfo.cid"/>
                            <!--div class="form-group">
                               <label class="col-sm-3 control-label">MID</label>
                                <div class="col-sm-9">             
                                  <input type="text" v-model="upm.mid" class="form-control" :value="upm.mid" >
                               </div>
                            </div-->
                            <div class="form-group">
                               <label class="col-sm-3 control-label">UID</label>
                                <div class="col-sm-9">             
                                  <input type="text" v-model="upm.uid" class="form-control" :value="upm.uid">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">商品</label>
                                <div class="col-sm-9">             
                               <select v-model="upm.cid" class="form-control">
	                            	<?php
	                            		   	 $a=$DB->query("select * from qingka_wangke_class where status=1");
	                            		   	 while($b=$DB->fetch($a)){
	                            		   	 	echo '<option value="'.$b['cid'].'">['.$b['cid'].'] '.$b['name'].'</option>';	
	                            		   	 }
									?>
	                            </select>
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">类型</label>
                                <div class="col-sm-9">             
                               <select v-model="upm.mode" class="form-control">
	                            	<option value="0">价格的基础上扣除</option>
	                            	<option value="1">倍数的基础上扣除</option>
	                            	<option value="2">直接定价</option>
	                            </select>
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">金额/倍数</label>
                                <div class="col-sm-9">             
                                  <input type="text" v-model="upm.price" class="form-control" :value="upm.price" >
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
                        <h4 class="modal-title">密价添加</h4>
                    </div>
           
                    <div class="modal-body">
                        <form class="form-horizontal" id="form-add">
                            <input type="hidden" name="action" value="add"/>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">UID</label>
                                <div class="col-sm-9">             
                                  <input type="text" v-model="addm.uid" class="form-control">
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">商品ID</label>
                                <div class="col-sm-9">             
                                 <select v-model="addm.cid" class="form-control">
	                            	<?php
	                            		   	 $a=$DB->query("select * from qingka_wangke_class where status=1");
	                            		   	 while($b=$DB->fetch($a)){
	                            		   	 	echo '<option value="'.$b['cid'].'">['.$b['cid'].'] '.$b['name'].'</option>';	
	                            		   	 }
									?>
	                            </select>
                                  
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">类型</label>
                                <div class="col-sm-9">             
                               <select v-model="addm.mode" class="form-control">
	                            	<option value="0">价格的基础上扣除</option>
	                            	<option value="1">倍数的基础上扣除</option>
	                            	<option value="2">直接定价</option>
	                            </select>
                               </div>
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label">金额/倍数</label>
                                <div class="col-sm-9">             
                                  <input type="text" v-model="addm.price"class="form-control">
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
 
 
 
 
 
 
<?php require_once("footer.php");?>	
<script>
vm=new Vue({
	el:"#orderlist",
	data:{
		row:null,
		uid:"<?php echo $uid ?>",
		storeInfo:{},
		addm:{
			uid:"<?php echo $uid ?>",
		},
		upm:{}
	},
	methods:{
		get:function(page){
		  var load=layer.load(2);
 			this.$http.post("/apisub.php?act=mijialist",{uid:this.uid},{emulateJSON:true}).then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){			                     	
	          		this.row=data.body;			             			                     
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
		},add_m:function(){
			var load=layer.load(2);
		 		this.$http.post("/apisub.php?act=mijia",{data:this.addm,active:1},{emulateJSON:true}).then(function(data){	
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
		 		this.$http.post("/apisub.php?act=mijia",{data:this.upm,active:2},{emulateJSON:true}).then(function(data){	
          	layer.close(load);
          	if(data.data.code==1){	
          		  vm.get(1);		                     	
                layer.msg(data.data.msg,{icon:1});             			                     
          	}else{
                layer.msg(data.data.msg,{icon:2});
          	}
        });	
		},del:function(mid){
			var load=layer.load(2);
		 		this.$http.post("/apisub.php?act=mijia_del",{mid:mid},{emulateJSON:true}).then(function(data){	
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