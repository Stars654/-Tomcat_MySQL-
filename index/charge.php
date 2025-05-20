<?php
include('head.php');
$uid=$userrow['uid'];
 if($conf['zxczkg']!=1){
	alert("滚，手动输入访问页面狗！","index");
}
?>
     <div class="app-content-body ">
        <div class="wrapper-md control" id="charge">
        	
				          <div class="card" class="">
				             <div class="card-header">	
				             在线充值
				             </div>	
				             
				            <li class="list-group-item">
				           <div class="edit-avatar">
                  <img src="http://q2.qlogo.cn/headimg_dl?dst_uin=<?=$userrow['user'];?>&spec=100" alt="..." class="img-avatar">
                  <div class="avatar-divider"></div>
                  <div class="edit-avatar-content">
                       <div class="h5 m-t-xs"><?=$conf['sitename'];?> 欢迎您！</div>
                    <span style="color:red;">账号: <?=$userrow['user'];?></span><br> 	
							    <span style="color:green">余额:<?=$userrow['money'];?></span>		
                  </div>
                </div>			              
			              
				            </li>   		          
				          	 <?php if($userrow['uuid']==1){ ?>
				             <div class="card-body">
						      <div class="form-group" style="overflow:hidden">									
				                    <input style="width: 150px; float: left;" type="text" class="layui-input" placeholder="输入充值的金额" v-model="money"/><button style="float: left;margin-left: 5px;" class="layui-btn" @click="pay">充值</button>	
				                    </div>
				                  <span style="color:red;">
				                      1.正常情况下请联系上家进行充值。<br />							    
								2.上家被封禁的情况下可选择在线充值。<br />
								3.上家如若连续7天未登录平台可联系站长充值<br />
								4.站长直属下级请联系站长充值。<br />
				                5.充多少用多少随冲随用</span>
							    
				             </div>	
				               <?php }?>
				              
				               <?php if($userrow['uuid']!=1){ ?>
				               <span style="color:red; font-size: 20px;">
				                      1.联系上级充值。<br />							    
								2.上家不做了请联系管理员。
				               <?php }?>
				          </div>
				          
	<div class="col-sm-12" id="pay2" style="display: none;">
    	<form action="/epay/epay.php" method="post">
    		<div><center style="margin-top:15px;"><h3>￥{{money}}</h3></center></div>
    		
    		<input type="hidden" name="out_trade_no" v-model="out_trade_no"/><br>
    		 <?php if($conf['is_alipay']==1){ ?>
			<button type="radio" name="type" value="alipay" class="btn btn-primary btn-block" >支付宝</button><br> <?php } ?>
			 <?php if($conf['is_qqpay']==1){ ?>
			<button type="radio" name="type" value="qqpay" class="btn btn-danger btn-block">QQ</button><br> <?php } ?>
			 <?php if($conf['is_wxpay']==1){ ?>
			<button type="radio" name="type" value="wxpay" class="btn btn-info btn-block">微信</button><br> <?php } ?>
		</form>	
    </div>   
				    

 
<?php if($userrow['uuid']==1){ ?>
	
		          <div class="panel panel-default">   
		           <div class="card-header">	
				             成功订单
				             </div>	
         		      <div class="table-responsive"> 
         		      
				         <table class="table table-striped">
				          <thead><tr><th>ID</th><th>订单号</th><th>类型</th><th>用户UID</th><th>名称</th><th>金额</th><th>创建时间</th><th>支付时间</th><th>状态</th></thead>
				          <tbody>				          	
							<?php 
	                     	 $a=$DB->query("select * from qingka_wangke_pay where uid='$uid' and status='1' ");
	                     	 while($rs=$DB->fetch($a)){
	                     	     if ($rs['status'] == 1) {
	                     	         $zt = '<span class="badge bg-success">已支付</span>';
	                     	     }else{
	                     	         $zt = '<span class="badge bg-danger">未支付</span>';
	                     	     }
	                     	 	  echo "<tr><td>".$rs['oid']."</td>
	                     	 	  	<td>".$rs['out_trade_no']."</td>
	                     	 	  	<td>".$rs['type']."</td>
	                     	 	  	<td>".$rs['uid']."</td>
	                     	 	  	<td>".$rs['name']."</td>
	                     	 	  	<td>".$rs['money']."</td>
	                     	 	  	<td>".$rs['addtime']."</td>
	                     	 	  	<td>".$rs['endtime']."</td>
	                     	 	  	<td>".$zt."</td>
	                     	 	  	</tr>"; 
	                     	 }
	                     	?>		           
				          </tbody>
				        </table>
				      </div>
		          </div>
		          <?php }?>
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
    layer.alert('扫码支付时务必支付和显示同样的余额，在二维码页面停留等待支付成功！如果未支付成功就关闭会造成支付不跳转！导致充值到账极慢问题！极少发生。');
</script>
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
$("pay2").hide();
new Vue({
	el:"#charge",
	data:{
       money:'',
       out_trade_no:''
	},
	methods:{
		pay:function(page){
		    var load=layer.load(2);
 			this.$http.post("/apisub.php?act=pay",{money:this.money},{emulateJSON:true}).then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){	
	          		$("pay2").show();
	          		this.out_trade_no=data.data.out_trade_no;	
	          		layer.msg(data.data.msg,{icon:1});		  
 					layer.open({
					  type: 1,
					  title: '请选择支付方式',
					  closeBtn: 0,
					  area: ['250px', '300px'],
					  skin: 'layui-bg-gray', //没有背景色
					  shadeClose: true,
					  content: $('#pay2'),
			  		  end: function(){ 
					    $("#pay2").hide();
					  }
					});          		                   	          			             			                     
	          	}else{	          		
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
		}
	},
	mounted(){
		
	}
});
</script>
