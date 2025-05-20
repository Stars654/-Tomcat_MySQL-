<?php
$title='系统设置';
require_once('head.php');
if($userrow['uid']!=1){
	alert("滚，手动输入访问页面狗！","index");
}
?>
<style>
    app-content-body{background-color:#C0C0C0}
</style>
     <div class="app-content-body ">
        <div class="wrapper-md control" id="add">
	       <div class="panel panel-default">
				<div class="panel-body">
					<form class="form-horizontal devform" id="form-web">
					    <div  class="card">
          <ul class="nav nav-tabs" role="tablist">
            <li class="active">
              <a data-toggle="tab" href="#wzpz">网站配置</a>
            </li>
            <li class="nav-item">
              <a data-toggle="tab" href="#dlpz">代理配置</a>
            </li>
            <li class="nav-item">
              <a data-toggle="tab" href="#zfpz">支付配置</a>
            </li>
            <li class="nav-item">
              <a data-toggle="tab" href="#jhdl">注册机制</a>
            </li>
            <li class="nav-item">
              <a data-toggle="tab" href="#flpz">分类配置</a>
            </li>
            <li class="nav-item">
              <a data-toggle="tab" href="#qtpz">查课配置</a>
            </li>
            <li class="nav-item">
              <a data-toggle="tab" href="#lxfs">联系配置</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade active in" id="wzpz">
		            <div class="form-group">
							<label class="col-sm-2 control-label">站点名字</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="sitename" value="<?=$conf['sitename']?>" placeholder="请输入站点名字" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">SEO关键词</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="keywords" value="<?=$conf['keywords']?>" placeholder="请输入站点名字" required>
							</div>
						</div>
												
						<div class="form-group">
							<label class="col-sm-2 control-label">SEO介绍</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="description" value="<?=$conf['description']?>" placeholder="请输入站点名字" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">LOGO地址</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="logo" value="<?=$conf['logo']?>" placeholder="请输入logo地址" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">是否开启水印</label>
								<div class="col-sm-9">
									<select name="sykg" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">	
	                            	   <option value="1" <?php if($conf['sykg']==1){ echo 'selected';}?>>1_允许</option>   
	                            	   <option value="0" <?php if($conf['sykg']==0){ echo 'selected';}?>>0_拒绝</option>                           	                            	
	                                </select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">是否开启订单公告</label>
								<div class="col-sm-9">
									<select name="ddggkg" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">	
	                            	   <option value="1" <?php if($conf['ddggkg']==1){ echo 'selected';}?>>1_允许</option>   
	                            	   <option value="0" <?php if($conf['ddggkg']==0){ echo 'selected';}?>>0_拒绝</option>                           	                            	
	                                </select>
							</div>
						</div>
					
						<div class="form-group">
							<label class="col-sm-2 control-label">是否开启充值排行榜</label>
								<div class="col-sm-9">
									<select name="czph" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">	
	                            	   <option value="1" <?php if($conf['czph']==1){ echo 'selected';}?>>1_允许</option>   
	                            	   <option value="0" <?php if($conf['czph']==0){ echo 'selected';}?>>0_拒绝</option>                           	                            	
	                                </select>
							</div>
						</div>
					
					
						<div class="form-group">
							<label class="col-sm-2 control-label">是否开启签到</label>
								<div class="col-sm-9">
									<select name="qdkg" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">	
	                            	   <option value="1" <?php if($conf['qdkg']==1){ echo 'selected';}?>>1_允许</option>   
	                            	   <option value="0" <?php if($conf['qdkg']==0){ echo 'selected';}?>>0_拒绝</option>                           	                            	
	                                </select>
							</div>
						</div>
					
					
					
						<div class="form-group">
							<label class="col-sm-2 control-label">公告</label>
								<div class="col-sm-9">
									<textarea type="text" name="notice" class="layui-textarea"  rows="5"><?=$conf['notice']?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">订单公告</label>
								<div class="col-sm-9">
									<textarea type="text" name="ddgg" class="layui-textarea"  rows="5"><?=$conf['ddgg']?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">弹窗公告</label>
								<div class="col-sm-9">
									<textarea type="text" name="tcgonggao" class="layui-textarea"  rows="5"><?=$conf['tcgonggao']?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">直属公告</label>
								<div class="col-sm-9">
									<textarea type="text" name="zsgonggao" class="layui-textarea"  rows="5"><?=$conf['zsgonggao']?></textarea>
							</div>
						</div>
            </div>
            <div class="tab-pane fade" id="dlpz">
                <div class="form-group">
							<label class="col-sm-2 control-label">是否开启上级迁移功能</label>
								<div class="col-sm-9">
									<select name="sjqykg" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">	
	                            	   <option value="1" <?php if($conf['sjqykg']==1){ echo 'selected';}?>>1_开启</option>   
	                            	   <option value="0" <?php if($conf['sjqykg']==0){ echo 'selected';}?>>0_关闭</option>                           	                            	
	                                </select>
							</div>
						</div>
                <div class="form-group">
							<label class="col-sm-2 control-label">是否允许邀请码注册</label>
								<div class="col-sm-9">
									<select name="user_yqzc" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">
	                            	    <option value="1" <?php if($conf['user_yqzc']==1){ echo 'selected';}?>>1_允许</option> 
	                            	    <option value="0" <?php if($conf['user_yqzc']==0){ echo 'selected';}?>>0_拒绝</option>                           	                            	
	                                </select>
							   </div>
						</div>	

						<div class="form-group">
							<label class="col-sm-2 control-label">是否允许后台开户</label>
								<div class="col-sm-9">
									<select name="user_htkh" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">	
	                            	   <option value="1" <?php if($conf['user_htkh']==1){ echo 'selected';}?>>1_允许</option>   
	                            	   <option value="0" <?php if($conf['user_htkh']==0){ echo 'selected';}?>>0_拒绝</option>                           	                            	
	                                </select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">代理开通价格</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="user_ktmoney" value="<?=$conf['user_ktmoney']?>" placeholder="" required>
							</div>
						</div>
            </div>
            <div class="tab-pane fade" id="zfpz">
                <div class="form-group">
							<label class="col-sm-2 control-label">是否开启在线充值</label>
								<div class="col-sm-9">
									<select name="zxczkg" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">	
	                            	   <option value="1" <?php if($conf['zxczkg']==1){ echo 'selected';}?>>1_开启</option>   
	                            	   <option value="0" <?php if($conf['zxczkg']==0){ echo 'selected';}?>>0_关闭</option>                           	                            	
	                                </select>
							</div>
						</div>
                <div class="form-group">
							<label class="col-sm-2 control-label">最低充值</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="zdpay" value="<?=$conf['zdpay']?>" placeholder="请输入最低充值金额" required>
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
            </div>
            <div class="tab-pane fade" id="jhdl">
                <div class="form-group">
							<label class="col-sm-2 control-label">邀请奖励</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="yqjl" value="<?=$conf['yqjl']?>" placeholder="每邀请一个用户上级获得的多少钱 如0.5" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">注册送奖励</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="yqsq" value="<?=$conf['yqsq']?>" placeholder="使用邀请码给下级送多少元 如1" required>
							</div>
						</div>
						<!--	<div class="form-group">-->
						<!--	<label class="col-sm-2 control-label">项目返利金额</label>-->
						<!--		<div class="col-sm-9">-->
						<!--			<input type="text" class="layui-input" name="flmoney" value="<?=$conf['flmoney']?>" placeholder="下级用户下单，给上级返利多少，如 0.05 必须设置项目id" required>-->
						<!--	</div>-->
						<!--</div>-->
						<div class="form-group">
							<label class="col-sm-2 control-label">邀请限制</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="yqsx" value="<?=$conf['yqsx']?>" placeholder="使用邀请码，一个用户邀请上限。如2" required>
							</div>
						</div>
            </div>
            <div class="tab-pane fade" id="flpz">
                <div class="form-group">
							<label class="col-sm-2 control-label">分类开关</label>
								<div class="col-sm-9">
									<select name="flkg" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">
	                            	    <option value="1" <?php if($conf['flkg']==1){ echo 'selected';}?>>开启</option> 
	                            	    <option value="0" <?php if($conf['flkg']==0){ echo 'selected';}?>>关闭</option>                           	                            	
	                                </select>
							   </div>
						</div>	
						<div class="form-group">
							<label class="col-sm-2 control-label">分类类型</label>
								<div class="col-sm-9">
									<select name="fllx" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">
									    <!--<option value="0" <?php if($conf['fllx']==0){ echo 'selected';}?>>侧边栏分类</option>-->              
	                            	    <option value="1" <?php if($conf['fllx']==1){ echo 'selected';}?>>下单页面选择框分类</option> 
	                            	    <option value="2" <?php if($conf['fllx']==2){ echo 'selected';}?>>下单页面单选框分类</option> 
	                            	                 	                            	
	                                </select>
							   </div>
						</div>	
            </div>
            <div class="tab-pane fade" id="qtpz">
                <div class="form-group">
							<label class="col-sm-2 control-label">最低调用api查课余额</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="zddy" value="<?=$conf['zddy']?>" placeholder="请输入最低调用api查课余额" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">最低调用api下单余额</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="zdxd" value="<?=$conf['zdxd']?>" placeholder="请输入最低调用api下单余额" required>
							</div>
						</div>
                	<div class="form-group">
							<label class="col-sm-2 control-label">开启api查课功能</label>
								<div class="col-sm-9">
									<select name="ckkg" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">	
	                            	   <option value="1" <?php if($conf['ckkg']==1){ echo 'selected';}?>>1_允许</option>   
	                            	   <option value="0" <?php if($conf['ckkg']==0){ echo 'selected';}?>>0_拒绝</option>                           	                            	
	                                </select>
							</div>
						</div>
						<!--<div class="form-group">-->
						<!--	<label class="col-sm-2 control-label">开启api下单功能</label>-->
						<!--		<div class="col-sm-9">-->
						<!--			<select name="xdkg" class="layui-select" style="    background: url('../index/arrow.png') no-repeat scroll 99%;   width:100%">	-->
	     <!--                       	   <option value="1" <?php if($conf['xdkg']==1){ echo 'selected';}?>>1_允许</option>   -->
	     <!--                       	   <option value="0" <?php if($conf['xdkg']==0){ echo 'selected';}?>>0_拒绝</option>                           	                            	-->
	     <!--                           </select>-->
						<!--	</div>-->
						<!--</div>-->
            </div>
            <div class="tab-pane fade" id="lxfs">
                <div class="form-group">
							<label class="col-sm-2 control-label">QQ联系方式</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="zzqq" value="<?=$conf['zzqq']?>" placeholder="请输入站长QQ" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">微信联系方式</label>
								<div class="col-sm-9">
									<input type="text" class="layui-input" name="zzvx" value="<?=$conf['zzvx']?>" placeholder="请输入站长微信" required>
							</div>
						</div>
            </div>
            <!--结束-->
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
	    	this.$http.post("/apisub.php?act=webset",{data:$("#form-web").serialize()},{emulateJSON:true}).then(function(data){
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