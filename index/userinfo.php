<?php

require_once('head.php');

?>


<body>
<div id="userindex">
<div class="container-fluid p-t-15">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
           <div class="panel-heading font-bold ">个人资料</div>
        <div class="card-body">
          <div class="edit-avatar">
            <img src="https://q2.qlogo.cn/headimg_dl?dst_uin=<?=$userrow['user'];?>&spec=100" alt="..." class="img-avatar">
            <div class="avatar-divider"></div>
            <div class="clear">
			                  <div v-if="row.name==''" class="h5 m-t-xs">more</div>								
			                  <div v-else class="h5 m-t-xs">{{row.name}}</div>							  
			                  <div class="text-muted">
							<!-- 用户信息部分 -->
<span style="color:red;">UID: {{row.uid}}</span>（{{row.user}}）<br> 	
<span style="color:green">KEY:</span>&nbsp;
<span v-if="row.key==0">未开通API接口&nbsp;
    <button @click="ktapi" class="btn btn-xs btn-success">开通</button>
</span>
<span v-else="">
    {{row.keyshow}}&nbsp;
    <button @click="hi" :class="['btn', 'btn-xs', hide ? 'btn-success' : 'btn-danger']">
        <i :class="['mdi',hide ? 'mdi-eye-off' : 'mdi-eye']"></i>{{hidebutton}}
    </button> 
    <button @click="ghapi" class="btn btn-xs btn-success"><i class="mdi mdi-refresh"></i>更换</button>
    <button @click="copyKey" class="btn btn-xs btn-success"><i class="mdi mdi-file"></i>复制</button>&nbsp;
    <button @click="szyqprice" class="btn btn-xs btn-success">设置邀请费率</button>
</span>




							        
							  </div>						  
			                </div>
          </div>
          <hr>
          <form class="site-form">
                  <div class="form-group">
                  <label>UID</label>
                  <input type="text" class="form-control" :value="row.uid" disabled="disabled" />
                </div>
                <div class="form-group">
                  <label>用户名</label>
                  <input type="text" class="form-control" :value="row.user" disabled="disabled" />
                </div>
<div class="form-group">
    <label>推送通知：</label>
    <div style="display: flex; align-items: center;">
        <input
            type="text"
            name="pushPlusToken"
            lay-tips="用来通知的token"
            disabled="disabled"
            :value="row.pushPlusToken"
            placeholder="未填写PushPlusToken"
            class="layui-input"
            style="width: 500px; margin-right: 10px;"
        />
        <a class="layui-badge layui-bg-green" @click="setPushPlusToken">修改Token</a>
    </div>
</div>






                <div class="form-group">
                  <label>剩余积分</label>
                  <input type="text" class="form-control" :value="row.money" disabled="disabled" />
                </div>
                <div class="form-group">
                  <label>总充值</label>
                  <input type="text" class="form-control" :value="row.zcz" disabled="disabled" />
                </div>
                <div class="form-group">
                  <label>费率</label>
                  <input type="text" class="form-control" :value="row.addprice" disabled="disabled" />
                </div>
                <div class="form-group">
                  <label>邀请码</label>
                  <input type="text" class="form-control" :value="row.yqm==''?'无':row.yqm" disabled="disabled" />
                </div>
                <div class="form-group">
                  <label>邀请费率</label>
                  <input type="text" class="form-control" :value="row.yqprice==''?'无':row.yqprice" disabled="disabled" />
                </div>
                
                
                <div class="form-group">
                <label>邀请链接：</label>
                <input type="text" class="form-control" :value="row.yqlj" disabled="disabled" />
                </div>
                               
                                
                          
                

                
                
                
                
                
                <!--<div class="form-group">
                  <label>QQ登陆</label>
                  <input type="text" class="form-control" :value="row.qq_openid==''?'未绑定':qq_openid" disabled="disabled" />
                </div>-->
          </form>
        </div>
      </div>
    </div>
    
  </div>
  </div>
</div>

<script src="https://cdn.staticfile.org/vue/2.6.11/vue.min.js"></script>
<script src="https://cdn.staticfile.org/vue-resource/1.5.1/vue-resource.min.js"></script>
<script src="https://cdn.staticfile.org/axios/0.18.0/axios.min.js"></script>
</body>
</html>
<script type="text/javascript">

		    var vm=new Vue({
		     	el: "#userindex",
		    	data: {
		      		row:null,
		      		inte:'',
		      		hide:false,
		      		hidebutton:'显示'
		        },
		      	methods:{
		      	    	    copyKey: function() {
                      try {
                        navigator.clipboard.writeText(this.row.key);
                        console.log("Text copied to clipboard");
                        layer.msg('复制成功',{icon:1});
                      } catch (err) {
                        console.error("Failed to copy text: ", err);
                        layer.msg('复制失败！请手动尝试复制.建议使用电脑',{icon:2});
                      }
		      	    },
		      	    hi: function(){
		      	        console.log(this.hide)
		      	        this.hide = !this.hide
		      	        if (this.hide){
		      	            this.hidebutton = '隐藏'
		      	            this.row.keyshow = this.row.key
		      	        }else{
		      	            this.hidebutton = '显示'
		      	            this.row.keyshow = '****************';
		      	        }
		      	    },
		    		userinfo:function(){
		    			var load=layer.load(2);
		     			this.$http.post("/apisub.php?act=userinfo")
				          .then(function(data){	
				          	   	layer.close(load);
				          	if(data.data.code==1){			                     	
				          		this.row=data.data			             			                     
				          	}else{
				                layer.alert(data.data.msg,{icon:2});
				          	}
				          });	
		    		},
		    		yecz:function(){
		    			layer.alert('请联系您的上级QQ：'+this.row.sjuser+'，进行充值。（下级点充值，此处将显示您的QQ）',{icon:1,title:"温馨提示"});
		    		},
		    		ktapi:function(){
		    			layer.confirm('后台剩余积分满300积分可免费开通，反之需花费10积分开通', {title:'温馨提示',icon:1,
							  btn: ['确定','取消'] //按钮
							}, function(){
							  		var load=layer.load(2);
					     			axios.get("/apisub.php?act=ktapi&type=1")
							          .then(function(data){	
							          	   	layer.close(load);
							          	if(data.data.code==1){			                     	
	    			                        layer.alert(data.data.msg,{icon:1,title:"温馨提示"},function(){setTimeout(function(){window.location.href=""});});							          				             			                     
							          	}else{
							                layer.msg(data.data.msg,{icon:2});
							          	}
							        });	
							
						    });
		    	    },	ghapi:function(){
		    			layer.confirm('确定更换key吗，更换之后之前的就不能用了', {title:'温馨提示',icon:1,
							  btn: ['确定','取消'] //按钮
							}, function(){
							  		var load=layer.load(2);
					     			axios.get("/apisub.php?act=ktapi&type=3")
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
		    	    szyqprice:function(){		    	    	
						layer.prompt({title: '设置下级默认费率，首次自动生成邀请码', formType: 3}, function(yqprice, index){
						  layer.close(index);
						  var load=layer.load(2);
			              $.post("/apisub.php?act=yqprice",{yqprice},function (data) {
					 	     layer.close(load);
				             if (data.code==1){
				             	vm.userinfo();  
				                layer.alert(data.msg,{icon:1});
				             }else{
				                layer.msg(data.msg,{icon:2});
				             }
			              });		    		    
					  });
		    	    }, 
		    	    connect_qq:function(){
		    	    	    var ii = layer.load(0, {
		    	    	        shade: [0.1, '#fff']
		    	    	    });
		    	    	    $.ajax({
		    	    	        type: "POST",
		    	    	        url: "../qq_login.php",
		    	    	        data: {"type":'qq'},
		    	    	        dataType: 'json',
		    	    	        success: function(data) {
		    	    	            layer.close(ii);
		    	    	            if (data.code == 1) {
		    	    	                window.location.href = data.url;
		    	    	            } else {
		    	    	                layer.alert(data.msg, {
		    	    	                    icon: 7
		    	    	                });
		    	    	            }
		    	    	        }
		    	    	    });
		    	  },     setPushPlusToken: function () {
  var vm = this; // 保存当前Vue实例的引用
  layer.open({
    type: 1, // 表示内容类型为HTML
    title: "设置PushPlus Token",
    area: ['400px', '300px'], // 调整弹窗的宽度和高度
    content: `
      <div style="padding: 20px; text-align: center;"> <!-- 增加居中显示 -->
        <img src="https://img2.imgtp.com/" alt="图片说明" style="max-width: 100%; height: auto; max-height: 100px;"> <!-- 调整图片尺寸 -->
        <p>微信扫码,在聊天框发送token,即可获取</p>
        <input type="text" id="pushPlusTokenInput" placeholder="请输入PushPlus Token" style="width: 80%; padding: 10px; margin-top: 10px; margin-bottom: 20px; display: block; margin-left: auto; margin-right: auto;"> <!-- 调整输入框宽度 -->
      </div>
    `, // 自定义HTML内容
    btn: ['更新', '取消'], // 设置底部按钮
    yes: function (index) {
      var value = document.getElementById('pushPlusTokenInput').value; // 获取输入的值
      // 检查输入的PushPlus Token是否为32位且仅包含字母和数字
      if (!/^[A-Za-z0-9]{32}$/.test(value)) {
        layer.msg('Token不正确,请检查是否空格或多余符号', { icon: 2 });
        return; // 如果不满足条件，提前返回
      }
      layer.close(index);
      var load = layer.load();
      // 假设你有一个API端点可以处理PushPlus Token的更新
      $.post("/apisub.php?act=updatePushPlusToken", { pushPlusToken: value }, function (data) {
        layer.close(load);
        if (data.code == 1) {
          vm.userinfo(); // 重新获取用户信息以更新视图
          layer.msg('PushPlus Token更新成功', { icon: 1 });
        } else {
          layer.msg(data.msg, { icon: 2 });
        }
      }, 'json');
    }
  });
},szgg:function(){
		    	  		layer.prompt({title: '设置代理公告，您的代理可看到', formType: 2}, function(notice, index){
						  layer.close(index);
						  var load=layer.load(2);
			              $.post("/apisub.php?act=user_notice",{notice},function (data) {
					 	     layer.close(load);
				             if (data.code==1){
				             	vm.userinfo();  
				                layer.msg(data.msg,{icon:1});
				             }else{
				                layer.msg(data.msg,{icon:2});
				             }
			              });		    		    
					  });   	  	
		    	  }
		    	
		     	},
		     	mounted(){
		     		this.userinfo();
		     		
		     	}
		      });
		  
       </script>