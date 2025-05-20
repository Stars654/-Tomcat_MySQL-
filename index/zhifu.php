<?php
$title='支付设置';
require_once('head.php');
if($userrow['uid']!=1){
	alert("滚，手动输入访问页面狗！","index");
}
?>


     <div class="app-content-body ">
 

        <div class="wrapper-md control" id="add">
	       <div class="panel panel-default">
		    <div class="panel-heading font-bold bg-white">
			    支付设置
		     </div>
		     
				<div class="panel-body">
								
				
					<form class="form-horizontal devform" id="form-web">
					    <div class="form-group">
							<label class="col-sm-2 control-label">最低充值</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="zdpay" value="<?=$conf['zdpay']?>" placeholder="请输入你的商户KEY" required>
							</div>
						</div>
					    <div class="form-group">
							<label class="col-sm-2 control-label">是否开启QQ支付</label>
								<div class="col-sm-9">
									<select name="is_qqpay" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">
	                            	    <option value="1" <?php if($conf['is_qqpay']==1){ echo 'selected';}?>>1_开启</option> 
	                            	    <option value="0" <?php if($conf['is_qqpay']==0){ echo 'selected';}?>>0_关闭</option>                           	                            	
	                                </select>
							   </div>
						</div>	
						<div class="form-group">
							<label class="col-sm-2 control-label">是否开启微信支付</label>
								<div class="col-sm-9">
									<select name="is_wxpay" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">
	                            	    <option value="1" <?php if($conf['is_wxpay']==1){ echo 'selected';}?>>1_开启</option> 
	                            	    <option value="0" <?php if($conf['is_wxpay']==0){ echo 'selected';}?>>0_关闭</option>                           	                            	
	                                </select>
							   </div>
						</div>	
						<div class="form-group">
							<label class="col-sm-2 control-label">是否开启支付宝支付</label>
								<div class="col-sm-9">
									<select name="is_alipay" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">
	                            	    <option value="1" <?php if($conf['is_alipay']==1){ echo 'selected';}?>>1_开启</option> 
	                            	    <option value="0" <?php if($conf['is_alipay']==0){ echo 'selected';}?>>0_关闭</option>                           	                            	
	                                </select>
							   </div>
						</div>	
						<div class="form-group">
							<label class="col-sm-2 control-label">易支付API</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="epay_api" value="<?=$conf['epay_api']?>" placeholder="格式：http://www.baidu.com/" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">商户ID</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="epay_pid" value="<?=$conf['epay_pid']?>" placeholder="请输入你的商户ID" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">商户KEY</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="epay_key" value="<?=$conf['epay_key']?>" placeholder="请输入你的商户KEY" required>
							</div>
						</div>
						
				  	    <div class="col-sm-offset-2 col-sm-4">
				  	    	<input type="button" @click="add" value="立即修改" class="layui-btn"/>
				  	    </div>

			        </form>
			      

		        </div>
	     </div>
      </div>
    </div>


<?php require_once("footer.php");?>

<script>
new Vue({
	el:"#add",
	data:{

	},
	methods:{
	    add:function(){
	        var loading=layer.load(2);
	    	this.$http.post("../apisub.php?act=webset",{data:$("#form-web").serialize()},{emulateJSON:true}).then(function(data){
	    		layer.close(loading);
	    		if(data.data.code==1){
	    			layer.alert(data.data.msg,{icon:1,title:"温馨提示"},function(){setTimeout(function(){window.location.href=""});});
	    		}else{
	    			layer.alert(data.data.msg,{icon:2,title:"温馨提示"});
	    		}
	    	});
	    }   
	},
	mounted(){
		//this.getclass();		
	}
	
	
});
</script>