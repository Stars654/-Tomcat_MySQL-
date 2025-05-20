vm=new Vue({
	el:"#orderlist",
	data:{
		  row:null,
	
		  phone:'',
		 
		  sex:[],
		  ddinfo3:{
		  	status:false,
		  	info:[]
		  },
		  dc:[],
		  dc2:{
		  	gs:1
		  },
		  cx:{
		  	status_text:'',
		  	dock:'',
		  	qq:'',
		  	oid:'',
		  	uid:'',
		  	school:'',
		  	kcname:'',
		  	ptname:'',
		  	pass:'',
		  
		  
		  	cid:'',
		  	limit:''
                },
           orderCount: '',
            },methods:{
                 
                getOrderList(status) {
                this.cx.status_text = status;
                this.get(1);
            },
                
	    jietu:function(user){
          window.open("http://61.136.162.34:1688/score.php?username="+user);
       },
        zhengshu:function(user){
          window.open("http://61.136.162.34:1688/cert.php?username="+user);
       },removepercent:function(text){
		    function isNumeric(value) {
  return !isNaN(parseFloat(value)) && isFinite(value) && typeof value !== 'boolean';
}
		    if (isNumeric(text.split('%').join(""))){
		        return text.split('%').join("");
		    }
		    return false;
		},download:function(savepath){
		  //   console.log("e ==> ",e);
		  //   return;
		     if(!savepath){
		     	layer.confirm('当前订单正在生成中，请稍侯在试！', {title:'温馨提示',icon:5,
							  btn: ['确定','取消'] //按钮
							}, function(){
							  vm.get(vm.row.current_page);  
							 //  layer.alert();
							 //layer.close();
							 layer.closeAll('dialog');

                });
		     }else{
		        const apiUrl = `https://eee.vg/apisublunw.php?act=getDownLoadFile&file=${encodeURIComponent(savepath)}`;
                const link = document.createElement('a');
                link.href = apiUrl;
                link.setAttribute('download', ''); // 可以指定下载文件的名称
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                	layer.confirm('下载成功！',{
                	    title:'温馨提示',
                	    icon:1,
                	    btn:['确定','取消']
                	    
                	},()=>{
                	     layer.closeAll('dialog');
                	})
                // this.$message.success("下载成功！");
		     }
		 },








// tz: function(yid) {
//     layer.confirm('确定要停止任务吗？<br>点完以后刷新，看是否停止', {
//         title: '提示',
//         btn: ['确定', '取消']
//     }, function () {
//         var load = layer.load();
//         layer.msg("正在停止中....", { icon: 3 });
//         $.get("/apitz.php?act=tz&yid="+yid, function (data) {
//             layer.close(load);
//             if (data.code == 1) {
//                 layer.msg(data.msg, { icon: 1 });
//             } else {
//                 layer.msg(data.msg, { icon: 2 });
//             }
//         });
//     });
// },


	zt:function(oid){
				var load=layer.load();
				layer.msg("正在暂停中....",{icon:3});
          $.get("/apisub.php?act=zt&oid="+oid,function (data) {
		 	     layer.close(load);
	             if (data.code==1){
	             	  vm.get(vm.row.current_page);  
	             	  setTimeout(function() {
	             	  	for(i=0;i<vm.row.data.length;i++){           	
					            	 if(vm.row.data[i].oid==oid){
					            	 	  vm.ddinfo3.info=vm.row.data[i];
					            	 	  console.log(vm.row.data[i].oid);
					            	 	  console.log(vm.row.data[i].status);
					            	 	  console.log(vm.ddinfo3.info.status);
					            	 	  return true;
					            	 } 
					            } 
	             	  },1800);   	             	  		             	 
	                layer.msg(data.msg,{icon:1});	                               
	             }else{
	              	layer.msg(data.msg,{icon:2});	
	             }	              
         });			
		 },

	
	
	xgmm:function (oid) {
    layer.prompt(
        { title: "修改密码", formType: 3 },
        function (xgmm, index) {
            layer.close(index);
            var load = layer.load();
            $.get("/apisub.php?act=xgmm&oid="+oid, { xgmm }, function (data) {
                layer.close(load);
                if (data.code == 1) {
                     
    						vm.get(vm.row.current_page);
    						layer.msg(data.msg, {icon: 1});
                } else {
                    layer.msg(data.msg, { icon: 2 });
                }
            });
        }
    );
},

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		get:function(page){
		  var load=layer.load();
		  data={cx:this.cx,page}
 			this.$http.post("/apisub.php?act=orderlist",data,{emulateJSON:true}).then(function(data){	
	          	layer.close(load);
	          	if(data.data.code==1){			                     	
	          		this.row=data.body;
	          		this.orderCount = data.body.data.length
	          	}else{
	                layer.msg(data.data.msg,{icon:2});
	          	}
	        });	
		},

		
		
		
		
		TgTips:function(){
	layer.alert('1.可以点编辑目录推荐目录的基础上修改或者新增 [<span style="color:red;">章节/小节标题以及字数</span>] <br>2.成为目标目录，系统将通过目标目录为你撰写文章，注意格式 <br>3.可以自己稍微修改格式也可以让客户自己改<span style="color:red;">模板定制联系上级</span> <br>4.能过98%论文网址查重 <br><span style="color:red;">5.欢迎尝试，显示完成即可点保存下载！</span> <br><span style="color:red;"><strong>6.因编辑目录存在修改性，</strong><strong>已完成后重刷会失效！</strong></span> <br><span style="color:red;">7.如果显示失败点重刷，重新编辑即可，</span><span ><br>一直失败请反馈上级！</span>', {
	
		title: '论文订单教程规则',
		skin: 'layui-layer-molv layui-layer-wxd'
		  , shadeClose: true
	});	
		},lunw:function(){
	layer.alert('自动发货到邮箱本地不保存', {
	
		title: '论文订单教程规则',
		skin: 'layui-layer-molv layui-layer-wxd'
		  , shadeClose: true
	});	
		},
		plzt: function(sex) {
			    if(this.sex==''){layer.msg("请先选择订单！");return false;}
			    layer.confirm('是否确认入队，入队后等待线程执行即可，禁止一直重复入队！20分钟内订单禁止入队，切记', {title: '温馨提示',icon: 3,btn: ['确认', '取消']}, function() {
    				var load = layer.load();
    				$.post("/apisub.php?act=plzt",{sex: sex}, {emulateJSON: true}).then(function(data) {
    					layer.close(load);
    					if (data.code == 1) {
    						vm.selectAll();
    						vm.get(vm.row.current_page);
    						layer.msg(data.msg, {icon: 1});
    					} else {
    						layer.msg(data.msg, {
    							icon: 2
    						});
    					}
    				});
				});
			},
			
		
			plbs:function(a){
				var load=layer.load();
          $.post("/apisub.php?act=plbs&a="+a,{sex:this.sex,type:1},{emulateJSON:true}).then(function(data){
		 	     layer.close(load);
	             if (data.code==1){
	              	vm.selectAll();   
	             	  vm.get(vm.row.current_page);		             	            	 
	                layer.msg(data.msg,{icon:1});	                
	             }else{
	                layer.msg(data.msg,{icon:2});
	             }	              
         });
		 },plsx:function(a){
				var load=layer.load();
          $.post("/apisub.php?act=plbs&a="+a,{sex:this.sex,type:1},{emulateJSON:true}).then(function(data){
		 	     layer.close(load);
	             if (data.code==1){
	              	vm.selectAll();   
	             	  vm.get(vm.row.current_page);		             	            	 
	                layer.msg(data.msg,{icon:1});	                
	             }else{
	                layer.msg(data.msg,{icon:2});
	             }	              
         });
		 },
		
	bs:function(oid){
		 	 		 	layer.confirm('建议漏看或者进度被重置的情况下使用。<br>频繁点击补刷会出现不可预测的结果<br>请问是否补刷所选的任务？', {title:'温馨提示',icon:3,
							  btn: ['确定补刷','取消'] //按钮
							}, function(){
		 			     var load=layer.load(2);
		          $.get("/apisub.php?act=bs&oid="+oid,function (data) {
				 	     layer.close(load);
			             if (data.code==1){
			             	  vm.get(vm.row.current_page);		             	 
			                layer.alert(data.msg,{icon:1});	                
			             }else{
			                layer.msg(data.msg,{icon:2});
			             }	              
		         });
         });
		 },up:function(oid){
				var load=layer.load(2);
				layer.msg("正在努力获取中....",{icon:3});
          $.get("/apisub.php?act=uporder&oid="+oid,function (data) {
		 	     layer.close(load);
	             if (data.code==1){
	             	  vm.get(vm.row.current_page);  
	             	  setTimeout(function() {
	             	  	for(i=0;i<vm.row.data.length;i++){           	
					            	 if(vm.row.data[i].oid==oid){
					            	 	  vm.ddinfo3.info=vm.row.data[i];
					            	 	  console.log(vm.row.data[i].oid);
					            	 	  console.log(vm.row.data[i].status);
					            	 	  console.log(vm.ddinfo3.info.status);
					            	 	  return true;
					            	 } 
					            } 
	             	  },1800);   	             	  		             	 
	                layer.msg(data.msg,{icon:1});	                               
	             }else{
	              	layer.msg(data.msg,{icon:2});	
//	                layer.alert(data.msg,{icon:2,btn:'立即跳转'},function(){
//	                	window.location.href=data.url
//	                });
	             }	              
         });			
		 },
		 plzt: function(sex) {
			    if(this.sex==''){layer.msg("请先选择订单！");return false;}
			    layer.confirm('是否确认入队，入队后等待线程执行即可，禁止一直重复入队！20分钟内订单禁止入队，切记', {title: '温馨提示',icon: 3,btn: ['确认', '取消']}, function() {
    				var load = layer.load();
    				$.post("/apisub.php?act=plzt",{sex: sex}, {emulateJSON: true}).then(function(data) {
    					layer.close(load);
    					if (data.code == 1) {
    						vm.selectAll();
    						vm.get(vm.row.current_page);
    						layer.msg(data.msg, {icon: 1});
    					} else {
    						layer.msg(data.msg, {
    							icon: 2
    						});
    					}
    				});
				});
			},plbs: function(sex) {
			    if(this.sex==''){layer.msg("请先选择订单！");return false;}
			    layer.confirm('是否确认入队补刷，入队后等待线程执行即可，禁止一直重复入队！20分钟内订单禁止入队，切记', {title: '温馨提示',icon: 3,btn: ['确认', '取消']}, function() {
    				var load = layer.load();
    				$.post("/apisub.php?act=plbs",{sex: sex}, {emulateJSON: true}).then(function(data) {
    					layer.close(load);
    					if (data.code == 1) {
    						vm.selectAll();
    						vm.get(vm.row.current_page);
    						layer.msg(data.msg, {icon: 1});
    					} else {
    						layer.msg(data.msg, {
    							icon: 2
    						});
    					}
    				});
				});
			},
		 duijie:function(oid){
		 	layer.confirm('确定处理么?', {title:'温馨提示',icon:3,
							  btn: ['确定','取消'] //按钮
							}, function(){
		 			     var load=layer.load();
		          $.get("/apisub.php?act=duijie&oid="+oid,function (data) {
				 	     layer.close(load);
			             if (data.code==1){
			             	  vm.get(vm.row.current_page);		             	 
			                layer.alert(data.msg,{icon:1});	                
			             }else{
			                layer.msg(data.msg,{icon:2});
			             }	              
		         });
         });
		 },getname:function(oid){
				var load=layer.load(2);
          $.get("/apisub.php?act=getname&oid="+oid,function (data) {
		 	     layer.close(load);
	             if (data.code==1){	             		             	 
	                layer.msg(data.msg,{icon:1});	                
	             }else{
	                layer.msg(data.msg,{icon:2});
	             }	              
         });			
		 },ms:function(oid){
			 	layer.confirm('提交秒刷将扣除0.05元服务费', {title:'温馨提示',icon:3,
								  btn: ['确定','取消'] //按钮
								}, function(){
			 			     var load=layer.load();
			          $.get("/apisub.php?act=ms_order&oid="+oid,function (data) {
					 	     layer.close(load);
				             if (data.code==1){
				             	  vm.get(vm.row.current_page);		             	 
				                layer.alert(data.msg,{icon:1});	                
				             }else{
				                layer.msg(data.msg,{icon:2});
				             }	              
			         });
	         });		
		 },quxiao:function(oid){
		 	 		 	layer.confirm('取消订单将无法退款，确定取消吗', {title:'温馨提示',icon:3,
							  btn: ['确定','取消'] //按钮
							}, function(){
		 			     var load=layer.load();
		          $.get("/apisub.php?act=qx_order&oid="+oid,function (data) {
				 	     layer.close(load);
			             if (data.code==1){
			             	  vm.get(vm.row.current_page);		             	 
			                layer.alert(data.msg,{icon:1});	                
			             }else{
			                layer.msg(data.msg,{icon:2});
			             }	              
		         });
         });
		 },status_text:function(a){
				var load=layer.load(2);
          $.post("/apisub.php?act=status_order&a="+a,{sex:this.sex,type:1},{emulateJSON:true}).then(function(data){
		 	     layer.close(load);
	             if (data.code==1){
	              	vm.selectAll();   
	             	  vm.get(vm.row.current_page);		             	            	 
	                layer.msg(data.msg,{icon:1});	                
	             }else{
	                layer.msg(data.msg,{icon:2});
	             }	              
         });	        
		 },
		 tk: function(sex) {
			    if(this.sex==''){layer.msg("请先选择订单！");return false;}
			    layer.confirm('确定要退款吗？陛下，三思三思！！！', {title: '温馨提示',icon: 3,btn: ['确定', '取消']}, function() {
    				var load = layer.load();
    				$.post("/apisub.php?act=tk",{sex: sex}, {emulateJSON: true}).then(function(data) {
    					layer.close(load);
    					if (data.code == 1) {
    						vm.selectAll();
    						vm.get(vm.row.current_page);
    						layer.msg(data.msg, {icon: 1});
    					} else {
    						layer.msg(data.msg, {
    							icon: 2
    						});
    					}
    				});
				});
			},
			
			dock:function(a){
				var load=layer.load();
          $.post("/apisub.php?act=status_order&a="+a,{sex:this.sex,type:2},{emulateJSON:true}).then(function(data){
		 	     layer.close(load);
	             if (data.code==1){
	              	vm.selectAll();   
	             	  vm.get(vm.row.current_page);		             	            	 
	                layer.msg(data.msg,{icon:1});	                
	             }else{
	                layer.msg(data.msg,{icon:2});
	             }	              
         });	        
		 },selectAll: function () {
            if(this.sex.length==0) {
	          	for(i=0;i<vm.row.data.length;i++){           	
	            	vm.sex.push(this.row.data[i].oid)
	            }    	     	
          	}else{
          		this.sex=[]
          	}                           
      },ddinfo: function(a){  
      	    this.ddinfo3.info=a;
      	    var load=layer.load(2,{time:300});
      	    setTimeout(function() {
	             layer.open({
							  type: 1,
							  title:'订单详情操作',
							  skin: 'layui-layer-demo',
							  closeBtn: 1,
							  anim: 2,
							  shadeClose: true,
							  content: $('#ddinfo2'),
							  end: function(){ 
							    $("#ddinfo2").hide();
							  }
							});  
            }, 100); 
            
      },del:function(sex){
		 	 layer.confirm('删除订单将无法退款，确定取消吗', {title:'温馨提示',icon:3,
				btn: ['确定','取消'] //按钮
				}, function(){
		 		var load=layer.load();
             $.post("/apisub.php?act=delorder",{sex:sex},{emulateJSON:true}).then(function(data){
                 layer.close(load);
                 if(data.code==1){
                     vm.get(vm.row.current_page);
                 layer.msg(data.msg,{icon:1});
                }else{
                     layer.msg(data.msg,{icon:2});
			             }	              
		         });
         });
		 },
daochu: function() {
    if(this.sex.length === 0) {
        layer.msg("请先选择订单", {icon: 2});
        return;
    }
    let exportContent = "";
    this.sex.forEach((oid) => {
        let order = this.row.data.find(order => order.oid === oid);
        if(order) {
            // 使用正则表达式替换掉序号和其后的空格
            let kcnameWithoutNumber = order.kcname.replace(/^\[\d+\]\s/, '');
            let line = `${order.school} ${order.user} ${order.pass} ${kcnameWithoutNumber}\n`;
            exportContent += line;
        }
    });
    const blob = new Blob([exportContent], {type: "text/plain;charset=utf-8"});
    const href = URL.createObjectURL(blob);
    const link = document.createElement("a");
    link.href = href;
    link.download = "More平台.txt"; // 文件名
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(href);
}
		 
	},
	mounted(){
		this.get(1);
		this.getclass();
	}
});





