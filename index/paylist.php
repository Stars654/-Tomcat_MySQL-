<?php
$mod='blank';
$title='订单列表';
require_once('head.php');
if($userrow['uid']!=1){
	alert("你来错地方了","index.php");
}
?>
 

	<div class="app-content-body">
	    <div class="wrapper-md control">		
			<div class="row">
				<div class="col-sm-12">
		          <div class="panel panel-default">    
         		      <div class="table-responsive"> 
				         <table class="table table-striped">
				          <thead><tr><th>ID</th><th>订单号</th><th>类型</th><th>用户UID</th><th>名称</th><th>金额</th><th>创建时间</th><th>支付时间</th><th>状态</th></thead>
				          <tbody>				          	
							<?php 
	                     	 $a=$DB->query("select * from qingka_wangke_pay order by addtime desc limit 50");
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
	



