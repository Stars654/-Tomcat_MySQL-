<?php
$mod='blank';
$title='订单列表';
require_once('head.php');
?>

 <!--//解决ios点击两次问题 -->
<style lang="scss">
 .el-scrollbar .el-scrollbar__bar {
    opacity: 1 !important;
}
</style>
<!--解决超出屏幕问题 -->
<style>
.long-text-option {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  width: 100%;
  max-width: 100%;
}

.custom-dropdown {
  max-width: 100vw;
  width: auto !important;
  right: 0; 

  
}


.blue-text {
  color: blue;
}



</style>




<style>
[v-cloak] {
  display: none;
}
</style>
<style>

        .console-link-block {
            font-size: 16px;
            padding: 20px 20px;
            border-radius: 4px;
            background-color: #40D4B0;
            color: #FFFFFF !important;
            box-shadow: 0 2px 3px rgba(0, 0, 0, .05);
            position: relative;
            overflow: hidden;
            display: block;
            min-height: 80px;
        }

        .console-link-block .console-link-block-num {
            font-size: 40px;
            margin-bottom: 5px;
            opacity: .9;
        }

        .console-link-block .console-link-block-text {
            opacity: .8;
        }

        .console-link-block .console-link-block-icon {
            position: absolute;
            top: 50%;
            right: 20px;
            width: 50px;
            height: 50px;
            font-size: 50px;
            line-height: 50px;
            margin-top: -25px;
            color: #FFFFFF;
            opacity: .8;
        }

        .console-link-block .console-link-block-band {
            color: #fff;
            width: 100px;
            font-size: 12px;
            padding: 2px 0 3px 0;
            background-color: #E32A16;
            line-height: inherit;
            text-align: center;
            position: absolute;
            top: 8px;
            right: -30px;
            transform-origin: center;
            transform: rotate(45deg) scale(.8);
            opacity: .95;
            z-index: 2;
        }

       
        .layui-row > div:nth-child(2) .console-link-block {
            background-color: #55A5EA;
        }

        .layui-row > div:nth-child(3) .console-link-block {
            background-color: #9DAFFF;
        }

        .layui-row > div:nth-child(4) .console-link-block {
            background-color: #F591A2;
        }

        .layui-row > div:nth-child(5) .console-link-block {
            background-color: #FEAA4F;
        }

        .layui-row > div:last-child .console-link-block {
            background-color: #9BC539;
        }
        
 
        .console-app-group {
            padding: 16px;
            border-radius: 4px;
            text-align: center;
            background-color: #fff;
            cursor: pointer;
            display: block;
        }

        .console-app-group .console-app-icon {
            width: 32px;
            height: 32px;
            line-height: 32px;
            margin-bottom: 6px;
            display: inline-block;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            font-size: 32px;
            color: #69c0ff;
        }

        .console-app-group:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, .08);
        }
</style>



<link rel="stylesheet" href="assets/css/element.css">
<link rel="stylesheet" href="css/list.css" media="all">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" media="all">
<!--<link rel="stylesheet" href="http://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" media="all">-->
<link href="assets/LightYear/css/bootstrap.min.css" rel="stylesheet">
<div class="app-content-body ">
        <div class="wrapper-md control">
	    <div class="panel panel-default" id="orderlist">
		    <div class="panel-heading font-bold bg-white">任务列表 (状态同步不及时，有时需手动更新)</div>
				 <div class="panel-body">
					<div class="form-horizontal devform" style="margin-left:10px">
						<div class="form-group">
						    
						   <div class="layui-row layui-col-space10">				
						    <div class="layui-col-md2 layui-col-sm3 layui-col-xs6" v-cloak>	
				 		   				<el-select id="select" v-model="cx.cid" filterable placeholder="请选择平台" style="background: url('../user/arrow.png') no-repeat scroll 99%;width:100%">
				 		   				    <el-option label="请选择平台" value=""></el-option>
								<?php
		                	     	$a=$DB->query("select * from qingka_wangke_class where status=1 ");
								    while($row=$DB->fetch($a)){
				                       echo '<el-option label="'.$row['name'].'" value="'.$row['cid'].'">'.$row['name'].'</el-option>';
								    }?>
							</el-select>
							  </div>  
							  <div class="layui-col-md2 layui-col-sm3 layui-col-xs6">	
							<el-select id="select" v-model="cx.status_text" filterable placeholder="请选择状态" style="background: url('../user/arrow.png') no-repeat scroll 99%;width:100%">
						
								            <el-option label="请选择状态" value=""></el-option>
				 		   				    <el-option label="待处理" value="待处理"></el-option>
				 		   				    <el-option label="进行中" value="进行中"></el-option>
				 		   				    <el-option label="已完成" value="已完成"></el-option>
				 		   				    <el-option label="补刷中" value="补刷中"></el-option>
				 		   				    <el-option label="已取消" value="已取消"></el-option>
				 		   				    <el-option label="已退款" value="已退款"></el-option>
				 		   				    <el-option label="已暂停" value="已暂停"></el-option>
				 		   				    <el-option label="考试中" value="考试中"></el-option>
				 		   				    <el-option label="待考试" value="待考试"></el-option>
				 		   				    <el-option label="异常中" value="异常"></el-option>
							</el-select>
							</div>  
							
							<div class="layui-col-md2 layui-col-sm3 layui-col-xs6">	
				 		   	<el-select id="select" v-model="cx.limit" filterable placeholder="选择每页订单数量" style="background: url('../user/arrow.png') no-repeat scroll 99%;width:100%">
				 		   				    <el-option label="选择每页订单数量" value=""></el-option>
				 		   				    <el-option label="20/页" value="20"></el-option>
				 		   				    <el-option label="50/页" value="50"></el-option>
				 		   				    <el-option label="100/页" value="100"></el-option>
				 		   				    <el-option label="200/页" value="200"></el-option>
				 		   				    <el-option label="500/页" value="500"></el-option>
				 		   				    <el-option label="1000/页" value="1000"></el-option>
				 		   				</el-select>	 
				                    </div> 
				                    
				                    <div class="layui-col-md2 layui-col-sm3 layui-col-xs6">
								<el-select id="select" v-model="dc2.gs" filterable placeholder="选择导出格式"
									style="background: url('../user/arrow.png') no-repeat scroll 99%;width:100%">
									<el-option label="选择导出格式" value=""></el-option>
									<el-option label="学校+账号+密码+课程名字" value="1"></el-option>
									<el-option label="账号+密码+课程名字" value="2"></el-option>
									<el-option label="学校+账号+密码" value="3"></el-option>
									<el-option label="账号+密码" value="4"></el-option>
								</el-select>
							</div>
				                    
				                    <div class="layui-col-md2 layui-col-sm3 layui-col-xs6">
								<input type="text" v-model="cx.status_text" class="layui-input" placeholder="自定义状态查询" />
							</div>
				                    
				                     <div class="layui-col-md2 layui-col-sm3 layui-col-xs6" v-if="row.uid==1">
				 	                  <input type="text"  v-model="cx.uid" value="" class="layui-input"  placeholder="请输入UID" required/> </div></div>
				 	<div class="form-horizontal devform">	
				 	          <div class="layui-row layui-col-space10">
				 	              <div class="layui-col-md2 layui-col-sm3 layui-col-xs6">
				 	                  <input type="text"  v-model="cx.oid" value="" class="layui-input"  placeholder="请输入订单ID" required/> </div>
				 	              <div class="layui-col-md2 layui-col-sm3 layui-col-xs6">
				 	                  <input type="text"  v-model="cx.qq" value="" class="layui-input"  placeholder="请输入下单账号" required/>
				 	              </div>
				 	              <div class="layui-col-md2 layui-col-sm3 layui-col-xs6">
				 	                  <input type="text"  v-model="cx.kcname" value="" class="layui-input"  placeholder="请输入课程名关键字" required/></div>
				 	                  
				 	                   <div class="layui-col-md2 layui-col-sm3 layui-col-xs6">
		                 <input type="text"  v-model="cx.ptname" value="" class="layui-input"  placeholder="请输入完整渠道名" required/>
			              </div>
				 	               <div class="layui-col-md2 layui-col-sm3 layui-col-xs6">
		                 <input type="text"  v-model="cx.pass" value="" class="layui-input"  placeholder="请输入学生密码" required/> </div>
		                 
				 	               <div class="layui-col-md2 layui-col-sm3 layui-col-xs6" style="width: 160px;" v-if="row.uid==1"> 		          
					       <el-select id="select" v-model="cx.dock" filterable placeholder="处理状态" style="background: url('../user/arrow.png') no-repeat scroll 99%;width:100%">
					                        <el-option label="处理状态" value=""></el-option>
				 		   				    <el-option label="待处理" value="0"></el-option>
				 		   				    <el-option label="处理成功" value="1"></el-option>
				 		   				    <el-option label="处理失败" value="2"></el-option>
				 		   				    <el-option label="重复下单" value="3"></el-option>
				 		   				    <el-option label="已取消" value="4"></el-option>
				 		   				    <el-option label="我的" value="99"></el-option>
					              </el-select>  
				              </div>
				 	              <div class="layui-col-md2 layui-col-sm3 layui-col-xs6" >
			              <input type="submit"value=" 查询" @click="get(1)" class="layui-btn"/>	
			              <input type="submit" value="导出" @click="daochu()"  class="layui-btn"/>
			             </div></div>
			             </div>	
			          </div>
				
						<?php if($userrow['uid']==1){ ?>
						<div class="form-group"><br/>任务状态
    						<a class="el-button el-button--warning   is-plain el-button--mini"
    							style="padding: 4px 10px;" @click="status_text('待处理')">1_待处理</a>
    						<a class="el-button el-button--success   is-plain el-button--mini"
    							style="padding: 4px 10px;" @click="status_text('已完成')">1_已完成</a>
    						<a class="el-button el-button--primary is-plain el-button--mini"
    							style="padding: 4px 10px;" @click="status_text('进行中')">1_进行中</a>
    						<a class="el-button el-button--danger  is-plain el-button--mini"
    							style="padding: 4px 10px;" @click="status_text('异常')">1_异常</a>
    						<a class="el-button el-button--default is-plain el-button--mini"
    							style="padding: 4px 10px;" @click="status_text('已取消')">1_已取消</a>
    							
    						<a class="el-button el-button--success   is-plain el-button--mini" 
    					     	style="padding: 4px 10px;" @click="status_text('已退款')">已退款</a>
    					     	
    					     	<a class="el-button el-button--purple   is-plain el-button--mini " @click="status_text('已录单进度联系客服')">手工录单</a>
							<a class="el-button el-button--default is-plain el-button--mini" @click="status_text('密码错误异常')">密错</a>
							<a class="el-button el-button--default is-plain el-button--mini" @click="status_text('任务完成|祝您前程似锦|壮志凌云')">自定义</a>
    					     	
    					     	
    					     	
    					     	
    						
    				    	<span style="margin-left:40px"><br/><br/>处理状态
    						<a class="el-button el-button--warning   is-plain el-button--mini"
    							style="padding: 4px 10px;" @click="dock(0)">2_待处理</a>
    						<a class="el-button el-button--success   is-plain el-button--mini"
    							style="padding: 4px 10px;" @click="dock(1)">2_已完成</a>
    						<a class="el-button el-button--danger  is-plain el-button--mini"
    							style="padding: 4px 10px;" @click="dock(2)">2_处理失败</a>
    						<a class="el-button el-button--default is-plain el-button--mini"
    							style="padding: 4px 10px;" @click="dock(3)">2_重复下单</a>
    						<a class="el-button el-button--default is-plain el-button--mini"
    							style="padding: 4px 10px;" @click="dock(4)">2_取消</a>
    						<a class="el-button el-button--default is-plain el-button--mini"
    							style="padding: 4px 10px;" @click="dock(99)">2_我的</a>
    							
    						<a class="el-button el-button--warning   is-plain el-button--mini"
    							style="padding: 4px 10px;" @click="tk(sex)">退款</a>
    				    
    					
    		
    					
        				</span>
						</div>
						<?php } ?>
					</div>
					
					
					
					  
					
					
					
					
					
                  	<div class="bg-gradient-tron">
                            <!--<a class="btn btn-xs btn btn-primary purple" id="checkboxAll" @click="selectAll()">全选</a>-->
                            批量操作:<br/>
                            <a class="btn btn-xs btn-info purple" @click="plzt(sex)">同步状态入队</a>&nbsp;&nbsp;
                            <a class="btn btn-xs btn-success purple" @click="plbs(sex)">补刷订单入队</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;
                            <a class="btn btn-xs btn-danger" @click="del(sex)">删除订单</a>
                            <a class="btn btn-xs btn-info" href=http://ck.wmv.life target="_blank" >单独查单</a>
                            <br/>
                            <span>注：批量同步禁止频繁点导致服务器堵塞罚款10RMB</span>
							<br />
							<span>注：批量补刷使用后 系统每5分钟自动提交补刷谢谢</span>
							<br />
							<span>注：删除订单功能，单纯删除本台订单，源头没删哈</span>
							<br />
							<span><span style="color:red;">注：系统问题，之前下过的同账号课程的进度，请用单独查单查询</span></span>
							<br />
							<span><span><span style="color:#4C33E5;"><strong>温馨提示：平台订单15-30分钟自动同步</strong></span><span style="color:#4C33E5;"><strong>1次 订单较多同步较慢 动动手手动同步一下谢谢配合 部分订单请手动同步</strong></span></span></span><span style="color:#4C33E5;"><span><span><span><span><strong></strong></span></span></span></span></span>
						
                  </div> 
                  <div><span style="color:#FF7F00;">本页面总共：{{ orderCount }}条数据</div>
                  	
		      <div class="layui-table table-responsive" lay-size="sm" >
		        <table class="table table-striped">
		          <thead><tr><th ><input type="checkbox" id="checkboxAll" @click="selectAll()" /></th>
		     <!--     <th style="text-align: center;"><b>【ID】</b></th>-->
		     <!--     <th style="text-align: center;"><b>【渠道】</b></th>-->
		     <!--     <th style="text-align: center;"><b>【学校&nbsp;账号&nbsp;密码】</b></th>-->
		     <!--     <th style="text-align: center;width:10%"><b>【项目名】</b></th>-->
		     <!--     <th style="text-align: center;"><b>¥</b></th>-->
		     <!--     <th nowrap="nowrap" style="text-align: center;"><b>状态</b></th>-->
		     <!--     <th style="text-align: center ;width:120px"><b>操作</b></th>-->
		     <!--     <th style="text-align: center;"><b>进度</b></th>-->
		     <!--   <th style="text-align: center;"><b><span style="color:#4C33E5;">《日志》</b></th>-->
		     <!--   <th style="text-align: center;"><b>时间</th>-->
		     <!--     <th style="text-align: center;"><b>设置</b></th>-->
		     <!--     <th v-if="row.uid==1" style="text-align: center;"><b>状态</b></th>-->
		     <!--<th v-if="row.uid==1" style="text-align: center;"><b>UID</b></th>-->
		     
		     <!-- <th style="text-align: center;"><b>课程ID核查</b></th> -->
		     <!--</tr>-->
		     
		    <th style="text-align: center ;width:120px"><b>操作</b></th>
		     
		           <th style="text-align: center;"><b>【订单ID】</b></th>
		     <th style="text-align: center;"><b>【渠道】</b></th>
		     <th style="text-align: center;"><b>【学校&nbsp;账号&nbsp;密码】</b></th>
		     <th style="text-align: center;width:10%"><b>【项目名】</b></th>
		  
		   
		     <th nowrap="nowrap" style="text-align: center;"><b>状态</b></th>
		    <th style="text-align: center;"><b>进度</b></th>
		    <th style="text-align: center;"><b><span style="color:#4C33E5;">《日志》</b></th>
		     <!--<th style="text-align: center;"><b>最近更新</th>-->
		     <th style="text-align: center;"><b>提交时间</th>
		     <th v-if="row.uid==1">处理状态</th>
		     <th v-if="row.uid==1">UID</th>
		       <th style="text-align: center;"><b>¥</b></th>
		        <!--<th style="text-align: center;width:10%"><b>课程ID核查</b></th>-->
		     <!--<th v-if="row.uid==1">修改备注</th>		-->
		     
		     
		     
		     
		     
		     
		     
		     
		     
		     
		     </thead>
		          <tbody>
		            <tr v-for="res in row.data">		            					
								  <td  > 
								  	<span class=" ">
			                            <input type="checkbox" id="checkboxAll" :value="res.oid" v-model="sex"><label for="checkbox1"></label>
			                        </span>
								  </td>
								  <div class="center">
								      
								      
								      
								      
								      
								      
								      
								      
								       <td style="text-align: center; white-space: nowrap;">
		               
		               
		               
		               
		               
		               
		               
		       <!--        <p style="text-align:center;"><span  class="btn btn-round btn-sm btn-danger"  @click="up(res.oid)">刷</span>-->
									<!--	<span class="btn btn-round btn-sm btn-dark" @click="bs(res.oid)">补</span>-->
								
									<!--        <span v-if="res.cid==656|res.cid==657">-->
									<!--        <a target="_blank" class="btn btn-round btn-sm btn-yellow" :href="'https://api.wkhome.homes/arctile/'+res.yid+'.docx'">论文下载</a></span>-->
									<!--        <span v-if="res.cid==652">-->
									<!--        <a  class="btn btn-round btn-sm btn-yellow" :href="'https://api.wkhome.homes/yueji/'+res.yid+'.docx'">月记下载</a></span>-->
									<!--        <span v-if="res.cid==655">-->
									<!--        <a  class="btn btn-round btn-sm btn-yellow" :href="'https://api.wkhome.homes/zhoujiqixi/'+res.yid+'.docx'">开题下载</a></span>-->
									<!--         <span v-if="res.cid==654">-->
									<!--        <a  class="btn btn-round btn-sm btn-yellow" :href="'https://wkapi.wkhome.homes/shixizj/'+res.yid+'.docx'">周记下载</a></span>-->
								 <!--<span v-if="res.cid==653">-->
									<!--        <a  class="btn btn-round btn-sm btn-yellow" :href="'https://wkapi.wkhome.homes/rujis/'+res.yid+'.docx'">日记下载</a></span>-->
										
									
									<!--	</p>-->
										
										  <!--截图>-->            

        <!--<span class="btn btn-xs  btn-dark" @click="bs(res.oid)">重刷</span>&nbsp;</span>-->
        <!--  <button @click="up(res.oid)" class="btn btn-xs btn btn-purple">更新</button>&nbsp;-->
<!--<button @click="tz(res.yid)" class="btn btn-xs  btn btn-info">停止</button>&nbsp;-->
<!--<button @click="zt(res.oid)" class="btn btn-xs  btn btn-info">暂停</button>&nbsp;-->
<!--       <button @click="ms(res.oid)" class="btn btn-xs  btn btn-success">秒刷</button>&nbsp;-->
         
        <button @click="ddinfo(res)" class="btn btn-xs btn-primary btn-round">详情</button>&nbsp;
         
         
       
         
         
         
        
       </div>
       <div v-else>
										
							 <!--新版论文保存-->   			      
							<div v-if="res.cid=='1386' ||res.cid=='1387'||res.cid=='1388'||res.cid=='1389'||res.cid=='1390'||res.cid=='1391'">
							 <span class="btn btn-xs btn-default" @click="download(res.savepath)">保存</span>&nbsp;</span>
							   <button @click="TgTips()" class="btn btn-xs btn-warning">教程</button>&nbsp;
							</div>
							<div v-else>  
							<!--旧版论文通用模板>-->   			      
                           	<div v-if="res.cid=='1305' ||res.cid=='1304'||res.cid=='1303'||res.cid=='1302'||res.cid=='1301'||res.cid=='1300'">
                            <div v-if="res.status=='已完成'">
                            <a :href="`https://eee.vg/articleGptFile/订单号${res.oid}题目${res.kcname}.docx`" class="btn btn-xs btn-default">保存</a>
                            &nbsp;
                             <button @click="TgTips()" class="btn btn-xs btn-warning">教程</button>&nbsp;
                              </div>
                             <div v-else>			
									  
                              <span class="btn btn-xs  btn-dark" @click="bs(res.oid)">重刷</span>&nbsp;
                             <button @click="TgTips()" class="btn btn-xs btn-warning">教程</button>&nbsp;
                               </div>
                               </div>
							<div v-else> 
										
			
					
										
										<!--论文通用模板-月记撰写[自定义篇数]>-->   			      
                     <!--     <div v-if="res.cid=='652'">-->
                     <!--  <div v-if="res.status=='已完成'">-->
                     <!-- <a :href="`https://api.wkhome.homes/yueji/${res.yid}.docx`" class="btn btn-xs btn btn-info">保存</a>&nbsp;-->
                     <!--   <button @click="TgTips()" class="btn btn-xs btn-warning">教程</button>&nbsp;-->
                     <!--</div>-->
                     <!--<div v-else>-->
                     <!--    <span class="btn btn-xs  btn-dark" @click="bs(res.oid)">重刷</span>&nbsp;-->
                     <!--   <button @click="TgTips()" class="btn btn-xs btn-warning">教程</button>&nbsp;-->
                     <!--   </div>-->
                     <!--   </div>-->
									<!--<div v-else>  -->
										
										<!--截图>-->   			      
							<div v-if="res.cid=='648'">
							 <span class="btn btn-xs  btn-dark" @click="bs(res.oid)">重刷</span>&nbsp;</span>
							   <button @click="jietu(res.user)" class="btn btn-xs  btn btn-info" >截图</button>&nbsp;
							  </span> <button @click="zhengshu(res.user)" class="btn btn-xs  btn-primary" >证书</button>&nbsp;
							</div>
							<div v-else> 
										
										
								<!--<span>	 <p style="text-align:center;"><span  class="btn btn-round btn-sm btn-danger"  @click="up(res.oid)">更新</span>&nbsp;-->
								<!--		<span class="btn btn-round btn-sm btn-dark" @click="bs(res.oid)">重刷</span>-->
								
								
								
								 <span>
        <span class="btn btn-xs  btn-dark" @click="bs(res.oid)">重刷</span>
        &nbsp;
        <button @click="up(res.oid)" class="btn btn-xs btn btn-purple">更新</button>
    </span> &nbsp;
    
    <button @click="ddinfo(res)" class="btn btn-xs btn-primary btn-round">详情</button>
    
				
																
										
									
    <!--    <span class="btn btn-xs  btn-dark" @click="bs(res.oid)">重刷</span>-->
    <!--    &nbsp;-->
    <!--    <button @click="up(res.oid)" class="btn btn-xs btn btn-info">更新</button>-->
    <!--</span>-->
</td>
										
								      
								      
								      
								      
								      
								      
								      
								      
								      
								  
		           	<td  style="text-align: center;">{{res.oid}}</td>	
		            	
		           <td><center><span style="color:#333333;"><strong>{{res.ptname}}</strong><span v-if="res.miaoshua=='1'"
											style="color: green;">&nbsp;秒刷</span></center></td>         	      	
		            <td><div style="text-align:center;"><strong>{{res.school}}
											{{res.user}}
											{{res.pass}}</strong></div>
									</td>
		       <!--     	<td><span style="color:#64451D;">-->
									<!--		<div style="text-align:center;">{{res.kcname}}</div>-->
									<!--</td>-->
									<td><center><span style="color:#333333;"><strong>{{res.kcname}}</strong></span>
									
									
									<!--<td>{{res.kcname}}</td>-->
		            	<!--<td style="text-align: center;">{{res.fees}}</td>-->
		            	
		            			<td style="white-space:nowrap" title="刷新" @click="up(res.oid)" v-if="res.dockstatus!='99'">
		            		<span v-if="res.status=='待处理'" class="btn btn-xs btn-info btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='等待处理'" class="btn btn-xs btn-info btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='列队中'" class="btn btn-xs btn-info btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='已完成'" class="btn btn-xs btn-success btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='任务完成'" class="btn btn-xs btn-success btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='习惯分完成,等待考试'" class="btn btn-xs btn-success btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='等待开考'" class="btn btn-xs btn-success btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='考试完成'" class="btn btn-xs btn-success btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='已考试'" class="btn btn-xs btn-success btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='夜间休息中'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='异常'" class="btn btn-xs btn-danger btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='登录出错'" class="btn btn-xs btn-danger btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='排队中'" class="btn btn-xs btn-danger btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='课程未开始'" class="btn btn-xs btn-danger btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='异常中'" class="btn btn-xs btn-danger btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='提交异常'" class="btn btn-xs btn-danger btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='已取消'" class="btn btn-xs btn-danger btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='需要验证'" class="btn btn-xs btn-danger btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='需验证码'" class="btn btn-xs btn-danger btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='密码错误'" class="btn btn-xs btn-danger btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='请重新激活'" class="btn btn-xs btn-danger btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='进行中'" class="btn btn-xs btn-warning btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='已上号'" class="btn btn-xs btn-warning btn-round">{{res.status}}</span>
		            			<span v-else-if="res.status=='登陆中'" class="btn btn-xs btn-warning btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='正在进行'" class="btn btn-xs btn-warning btn-round">{{res.status}}</span>
		           <span v-else-if="res.status=='正在跑单'" class="btn btn-xs btn-warning btn-round">{{res.status}}</span>		
		            		
		            		
		            		
		            		<span v-else-if="res.status=='刷课中'" class="btn btn-xs btn-warning btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='已暂停'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='处理中'" class="btn btn-xs btn-warning btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='停止中'" class="btn btn-xs btn-warning btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='1:1安排视频中'" class="btn btn-xs btn-warning btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='正在考试'" class="btn btn-xs btn-warning btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='课程进行中'" class="btn btn-xs btn-warning btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='正在排队'" class="btn btn-xs btn-warning btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='考试中'" class="btn btn-xs btn-warning btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='平时分'" class="btn btn-xs btn-pink btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='习惯分'" class="btn btn-xs btn-pink btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='习惯分中'" class="btn btn-xs btn-pink btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='上号中'" class="btn btn-xs btn-warning btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='待上号'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='已登陆'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='执行中'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='已提取'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='待执行'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='已提交刷课'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='已提交'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            		
		            			<span v-else-if="res.status=='任务完成|祝您前程似锦|壮志凌云'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            			
		            			
		            				<span v-else-if="res.status=='已录单进度联系客服'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            					
<span v-else-if="res.status=='未检测到考试'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            				
		            					<span v-else-if="res.status=='密码错误异常'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            		
		            		<span v-else-if="res.status=='队列中'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='订单提交'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='时长中'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='待考试'" class="btn btn-xs btn-purple btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='暂无形考'" class="btn btn-xs btn-purple btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='形考未到提交时间'" class="btn btn-xs btn-purple btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='缺少答案,等待处理'" class="btn btn-xs btn-purple btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='大作业缺少答案,等待处理'" class="btn btn-xs btn-purple btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='已退款'" class="btn btn-xs btn-dark btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='补刷中'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='待重刷'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='重刷中'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            		<span v-else-if="res.status=='重刷'" class="btn btn-xs btn-cyan btn-round">{{res.status}}</span>
		            		<span v-else style="color: green;">{{res.status}}</span>
									</td>
		            	
		            
		            	   
		            	    
		            	    
		            	    
		            	
		            	<!--<td>-->
		            	<!--	<span v-if="res.status=='待处理'" class="btn btn-xs btn-info">{{res.status}}</span>-->
		            	<!--	<span v-else-if="res.status=='已完成'" class="btn btn-xs btn-success">{{res.status}}</span>-->
		            	<!--	<span v-else-if="res.status=='异常'" class="btn btn-xs btn-danger">{{res.status}}</span>-->
		            	<!--	<span v-else-if="res.status=='进行中'" class="btn btn-xs btn-warning">{{res.status}}</span>-->
		            	<!--	<span v-else style="color: green;"  class="btn btn-xs btn-warning">{{res.status}}</span>-->
		            	<!--</td> -->
		            	
		            <!--<td>		<span v-if="res.status=='待处理'" class="el-button el-button--warning   is-plain el-button--mini"><i class="fa fa-clock-o fa-pulse fa-lg fa-fw"></i>{{res.status}}</span>-->
		            <!--		<span v-else-if="res.status=='已完成'" class="el-button el-button--success   is-plain el-button--mini"><i class="fa fa-check-square-o fa-lg fa-fw"></i>{{res.status}}</span>-->
		            <!--		<span v-else-if="res.status=='异常'" class="el-button el-button--danger  is-plain el-button--mini"><i class="fa fa-exclamation-circle fa-lg fa-fw"></i>{{res.status}}</span>-->
		            <!--		<span v-else-if="res.status=='进行中'" class="el-button el-button--primary is-plain el-button--mini"><i class="fa fa-spinner fa-pulse fa-lg fa-fw"></i>{{res.status}}</span>-->
		            <!--		<span v-else  class="el-button el-button--warning   is-plain el-button--mini"><i class="fa fa-clock-o fa-pulse fa-lg fa-fw"></i>{{res.status}}</span>-->
		            	
		            	
		            	
		            	
		            	
		            <!--	</td> -->
		            
		            
		        <!--    <td><div style="text-align:center;">-->
										<!--<span v-if="res.status=='待处理'" class="badge btn bg-brown">{{res.status}}</span>-->
										<!--<span v-else-if="res.status=='已完成'" class="badge btn bg-success">{{res.status}}<i class="mdi mdi-checkbox-marked-circle-outline"></i></span>-->
										<!--<span v-else-if="res.status=='进行中'" class="badge btn btn-primary">{{res.status}}</i></span>-->
										<!--<span v-else-if="res.status=='异常'" class="badge btn bg-danger">{{res.status}}<i class="mdi mdi-close"></i></span>-->
										<!--<span v-else style="color: white;" class="badge btn btn-dark">{{res.status}}</span></div>	</td>-->
								
		            
		            
		            
		            <!--	<td><span class="btn btn-primary btn-xs" @click="up(res.oid)"><i class="fa fa-spinner fa-spin fa-lg fa-fw"></i> </span></td> -->
		            <!--<td>	<span class="btn btn-xs btn-warning" @click="bs(res.oid)"><i class="fa fa-refresh fa-spin fa-lg fa-fw"></i> </span></td>-->
		            	
		      
		               
		               
		               
		               
<!--		               <td style="text-align: center; white-space: nowrap;">-->
		               
		               
		               
		               
		               
		               
		               
		       <!--        <p style="text-align:center;"><span  class="btn btn-round btn-sm btn-danger"  @click="up(res.oid)">刷</span>-->
									<!--	<span class="btn btn-round btn-sm btn-dark" @click="bs(res.oid)">补</span>-->
								
									<!--        <span v-if="res.cid==656|res.cid==657">-->
									<!--        <a target="_blank" class="btn btn-round btn-sm btn-yellow" :href="'https://api.wkhome.homes/arctile/'+res.yid+'.docx'">论文下载</a></span>-->
									<!--        <span v-if="res.cid==652">-->
									<!--        <a  class="btn btn-round btn-sm btn-yellow" :href="'https://api.wkhome.homes/yueji/'+res.yid+'.docx'">月记下载</a></span>-->
									<!--        <span v-if="res.cid==655">-->
									<!--        <a  class="btn btn-round btn-sm btn-yellow" :href="'https://api.wkhome.homes/zhoujiqixi/'+res.yid+'.docx'">开题下载</a></span>-->
									<!--         <span v-if="res.cid==654">-->
									<!--        <a  class="btn btn-round btn-sm btn-yellow" :href="'https://wkapi.wkhome.homes/shixizj/'+res.yid+'.docx'">周记下载</a></span>-->
								 <!--<span v-if="res.cid==653">-->
									<!--        <a  class="btn btn-round btn-sm btn-yellow" :href="'https://wkapi.wkhome.homes/rujis/'+res.yid+'.docx'">日记下载</a></span>-->
										
									
									<!--	</p>-->
										
										
										
										<!--论文通用模板-论文撰写-无视查重率[自定义目录]>-->   			      
<!--                            <div v-if="res.cid=='657'">-->
<!--                            <div v-if="res.status=='已完成'">-->
<!--                     <a :href="`https://api.wkhome.homes/arctile2/${res.oid}.docx`" class="btn btn-xs btn btn-info">保存</a>&nbsp;-->
            
<!--                             <button @click="TgTips()" class="btn btn-xs btn-warning">教程</button>&nbsp;-->
<!--                              </div>-->
<!--                             <div v-else>-->
<!--                             <span class="btn btn-xs  btn-dark" @click="bs(res.oid)">重刷</span>&nbsp;-->
<!--                             <button @click="TgTips()" class="btn btn-xs btn-warning">教程</button>&nbsp;-->
<!--                               </div>-->
<!--                               </div>-->
<!--							<div v-else>  -->
							<!--论文通用模板-论文撰写-无视查重率[字数1万字]>-->   			      
<!--                          <div v-if="res.cid=='656'">-->
<!--                       <div v-if="res.status=='已完成'">-->
<!--                      <a :href="`https://api.wkhome.homes/arctile/${res.oid}.docx`" class="btn btn-xs btn btn-info">保存</a>&nbsp;-->
<!--                        <button @click="TgTips()" class="btn btn-xs btn-warning">教程</button>&nbsp;-->
<!--                     </div>-->
<!--                     <div v-else>-->
<!--                         <span class="btn btn-xs  btn-dark" @click="bs(res.oid)">重刷</span>&nbsp;-->
<!--                        <button @click="TgTips()" class="btn btn-xs btn-warning">教程</button>&nbsp;-->
<!--                        </div>-->
<!--                        </div>-->
<!--									<div v-else>  -->
										
										<!--论文通用模板-论文开题报告[编辑标题]>-->   			      
<!--                          <div v-if="res.cid=='655'">-->
<!--                       <div v-if="res.status=='已完成'">-->
<!--                      <a :href="`https://api.wkhome.homes/zhoujiqixi/${res.oid}.docx`" class="btn btn-xs btn btn-info">保存</a>&nbsp;-->
<!--                        <button @click="TgTips()" class="btn btn-xs btn-warning">教程</button>&nbsp;-->
<!--                     </div>-->
<!--                     <div v-else>-->
<!--                         <span class="btn btn-xs  btn-dark" @click="bs(res.oid)">重刷</span>&nbsp;-->
<!--                        <button @click="TgTips()" class="btn btn-xs btn-warning">教程</button>&nbsp;-->
<!--                        </div>-->
<!--                        </div>-->
<!--									<div v-else>  -->
										
										<!--论文通用模板-周记撰写[自定义篇数]>-->   			      
<!--                          <div v-if="res.cid=='654'">-->
<!--                       <div v-if="res.status=='已完成'">-->
<!--                      <a :href="`https://api.wkhome.homes/zhoujix/${res.oid}.docx`" class="btn btn-xs btn btn-info">保存</a>&nbsp;-->
<!--                        <button @click="TgTips()" class="btn btn-xs btn-warning">教程</button>&nbsp;-->
<!--                     </div>-->
<!--                     <div v-else>-->
<!--                         <span class="btn btn-xs  btn-dark" @click="bs(res.oid)">重刷</span>&nbsp;-->
<!--                        <button @click="TgTips()" class="btn btn-xs btn-warning">教程</button>&nbsp;-->
<!--                        </div>-->
<!--                        </div>-->
<!--									<div v-else> -->
									<!--论文通用模板-日记撰写[自定义篇数]>-->   			      
<!--                          <div v-if="res.cid=='653'">-->
<!--                       <div v-if="res.status=='已完成'">-->
<!--                      <a :href="`https://api.wkhome.homes/riji/${res.oid}.docx`" class="btn btn-xs btn btn-info">保存</a>&nbsp;-->
<!--                        <button @click="TgTips()" class="btn btn-xs btn-warning">教程</button>&nbsp;-->
<!--                     </div>-->
<!--                        <div v-else>-->
<!--                        <span class="btn btn-xs  btn-dark" @click="bs(res.oid)">重刷</span>&nbsp;-->
<!--                        <button @click="TgTips()" class="btn btn-xs btn-warning">教程</button>&nbsp;-->
<!--                        </div>-->
<!--                        </div>-->
<!--									<div v-else>  -->
										
										<!--论文通用模板-月记撰写[自定义篇数]>-->   			      
<!--                          <div v-if="res.cid=='652'">-->
<!--                       <div v-if="res.status=='已完成'">-->
<!--                      <a :href="`https://api.wkhome.homes/yueji/${res.oid}.docx`" class="btn btn-xs btn btn-info">保存</a>&nbsp;-->
<!--                        <button @click="TgTips()" class="btn btn-xs btn-warning">教程</button>&nbsp;-->
<!--                     </div>-->
<!--                     <div v-else>-->
<!--                         <span class="btn btn-xs  btn-dark" @click="bs(res.oid)">重刷</span>&nbsp;-->
<!--                        <button @click="TgTips()" class="btn btn-xs btn-warning">教程</button>&nbsp;-->
<!--                        </div>-->
<!--                        </div>-->
<!--									<div v-else>  -->
										
										<!--截图>-->   			      
<!--							<div v-if="res.cid=='648'">-->
<!--							 <span class="btn btn-xs  btn-dark" @click="bs(res.oid)">重刷</span>&nbsp;</span>-->
<!--							   <button @click="jietu(res.user)" class="btn btn-xs  btn btn-info" >截图</button>&nbsp;-->
<!--							  </span> <button @click="zhengshu(res.user)" class="btn btn-xs  btn-primary" >证书</button>&nbsp;-->
<!--							</div>-->
<!--							<div v-else> -->
										
										
<!--								<span>	 <p style="text-align:center;"><span  class="btn btn-round btn-sm btn-danger"  @click="up(res.oid)">更新</span>&nbsp;-->
<!--										<span class="btn btn-round btn-sm btn-dark" @click="bs(res.oid)">重刷</span>-->
										
										
<!--										<span>-->
    <!--    <span class="btn btn-xs  btn-dark" @click="bs(res.oid)">重刷</span>-->
    <!--    &nbsp;-->
    <!--    <button @click="up(res.oid)" class="btn btn-xs btn btn-info">更新</button>-->
    <!--</span>-->
<!--</td>-->
										
									
									
										
		            	
		            	
<!--		            	<td style="text-align: center; padding: 0; vertical-align: middle;">-->
<!--  <div style="background-color: #E6E6E6; border-radius: 2px; height: 12px; width: 100%;">-->
<!--    <div v-if="res.process" :style="{ width: res.process }" style="background-color: #409EFF; height: 100%; border-radius: 2px;"></div>-->
<!--  </div>-->
<!--  <span style="color: #409EFF;font-size: 12px">{{ res.process ? res.process : '0' }}</span>-->


<!--</td>-->
                             <!--<td     v-if="res.cid!=648" >-->
                                 
                                 
                                 
                                 
                                 
                                 
                                <!--蛇-->
                                 
                                 
                                 <td style="text-align: center; padding: 5; vertical-align: middle;">
                                 
		            	       <el-progress :text-inside="true" :stroke-width="18" :percentage="removepercent(res.process)" status="success" style="width:100px" v-if="removepercent(res.process)"></el-progress>
		            	       
		            	       
		            	       
		            	        <div v-else>{{res.process}}</div>
		            	        
		            	</td>   
		            	
		            
		            	
		            	
		            	
		            	
		            	
		         
		            	
		            	
		            	
		            	
		            	
		            	
		            	
		            	
		            	
		            	
		            	
		            	
		            	
		            	
		            	
		            	
		            	
		            	
		            	
		    <!--        <td style="text-align: center;">{{res.process}}-->
		    <!--        	<div class="progress reverse-progress">-->
      <!--<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" class="progress-bar progress-bar-blue progress-bar-success active progress-bar-striped rounded" role="progressbar" v-bind:style="'width:'+(res.process)+';' ">-->
		    <!--        	        </div>-->
		    <!--        	    </div>-->
		    <!--        	</td> -->
		            	
		            	
		            	
		            	
		            	
		            	
		            	
		            	
		            	
		            
<!--		            <td -->
		            
<!--		            v-if="res.cid==648">-->
<!--		            	    <span><button @click="jietu(res.user)" class="btn btn-xs btn btn-info" >截图</button></span>-->
<!--		            	    <span><button @click="zhengshu(res.user)" class="btn btn-xs btn-primary" >证书</button></span>-->
		            	
		            	
<!--		            </td>-->
						
									        
									        
									       
		         
		            
		            
		          
		            
		            
		            
		            
		            
		            
		            
		            
		            
		            
		            
		            
		            
		            
		            
		            
		            
		            
		            
		            
		            
		            
		            
		            
		            
		            	<!--<td style="width: 300px;">{{ res.remarks }}</td> -->
		            	<td><span style="color: #000080; font-weight: bold;">{{res.remarks}}</td>
		            	
		            
<!--		            		            	<td v-if="res.finalupdate && res.finalupdate !== '无'" class="blue-text">{{ res.finalupdate }}</td>-->
<!--<td v-else style="color: red;">{{ res.addtime }}</td>-->
		            	<td><span style="color:#E53333;">{{res.addtime}}</td>
		            	
		            	
		            	
		            	
		            	
		            	
		            	
		            	<!--<td><span style="color:#E53333;">{{res.addtime}}</td>-->
		            	
		            			            	
		            	<!--<td>{{res.fees}}</td>-->
		            	<!--	<td><span class="btn btn-xs btn-primary" @click="ddinfo(res)"><i class="fa fa-cog fa-spin fa-lg fa-fw"></i> </span></td>-->
		            	<!--<td><span class="btn btn-xs btn-danger" @click="quxiao(res.oid)"><i class="el-button el-button--info is-plain el-button--mini"></i> </span></td>-->
		            	<!--<td v-if="row.uid==1">-->
		            	<!--	<span @click="duijie(res.oid)" v-if="res.dockstatus==0" class="el-button el-button--warning   is-plain el-button--mini">等待</span>-->
		            	<!--	<span v-if="res.dockstatus==1" class="el-button el-button--success   is-plain el-button--mini">成功</span>-->
		            	<!--	<span @click="duijie(res.oid)" v-if="res.dockstatus==2" class="el-button el-button--danger  is-plain el-button--mini">失败</span>-->
		            	<!--	<span v-if="res.dockstatus==3" class="el-button el-button--info is-plain el-button--mini">重复</span>-->
		            	<!--	<span v-if="res.dockstatus==4" class="el-button el-button--primary is-plain el-button--mini">取消</span>-->
		            	<!--	<span v-if="res.dockstatus==99" class="el-button el-button--warning   is-plain el-button--mini">我的</span></td>   -->
		            	
		            	<!--	<td v-if="row.uid==1">{{res.uid}}</td>-->
		            	
		            	
		            <td nowrap="nowrap" v-if="row.uid==1" style="text-align: center;">
		            		<span @click="duijie(res.oid)" v-if="res.dockstatus==0" class="btn btn-xs btn-info">待处理</span>
		            		<span v-if="res.dockstatus==1" class="btn btn-xs btn-success">处理成功</span>
		            		<span @click="duijie(res.oid)" v-if="res.dockstatus==2" class="btn btn-xs btn-danger">处理失败</span>
		            		<span v-if="res.dockstatus==3" class="">重复下单</span>
		            		<span v-if="res.dockstatus==4" class="">已取消</span>
		            		<span v-if="res.dockstatus==99" class="btn btn-xs btn-warning">自营</span></td>
		            	
		            		<td v-if="row.uid==1" style="text-align: center;">{{res.uid}}</td>
		            			<td style="text-align: center;">{{res.fees}}</td>
		            			
		            			
<!--<td><center><span style="color:green;"><strong>{{res.kcid}}</strong></span></center></td>-->
		            	<!--<td v-if="row.uid==1"><button @click="dd_passwd(res.oid)"  class="btn btn-xs btn-warning">修改备注</button></td>-->
		            <!--td v-if="res.status!='已取消'"><button @click="ms(res.oid)" v-if="res.miaoshua==0" class="btn btn-xs btn-danger">秒刷</button>&nbsp;<button @click="up(res.oid)" class="btn btn-xs btn-success">更新状态</button>&nbsp;<button @click="bs(res.oid)" class="btn btn-xs btn-primary">补刷</button>&nbsp;<button @click="quxiao(res.oid)"  class="btn btn-xs btn-info">取消</button></td--> 
		            </tr>
                        </div>
		          </tbody>
		        </table>
		      </div>
		      
			     <ul class="pagination pagination-circle" v-if="row.last_page>1"> 
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
			     
   
			 <!--   <div id="ddinfo2" style="display: none;"><!--订单详情-->                    
			 <!--      <li class="list-group-item">-->
			 <!--      	    <b>课程类型：</b>{{ddinfo3.info.ptname}}<span v-if="ddinfo3.info.miaoshua=='1'" style="color: red;">&nbsp;秒刷</span></li>-->
			 <!--      	<li class="list-group-item" style="word-break:break-all;">-->
			 <!--      	    <b>账号信息：</b>{{ddinfo3.info.school}}&nbsp;{{ddinfo3.info.user}}&nbsp;{{ddinfo3.info.pass}}</li>-->
			 <!--      	<li class="list-group-item"><b>课程名字：</b>{{ddinfo3.info.kcname}}</li>-->
			 <!--      	<li class="list-group-item" v-if="ddinfo3.info.name!='null'"><b>学生姓名：</b>{{ddinfo3.info.name}}</li>-->
			 <!--      	<li class="list-group-item"><b>下单时间：</b>{{ddinfo3.info.addtime}}</li>-->
			 <!--      	<li class="list-group-item" v-if="ddinfo3.info.courseStartTime"><b>课程开始时间：</b>{{ddinfo3.info.courseStartTime}}</li>-->
			 <!--      	<li class="list-group-item" v-if="ddinfo3.info.courseEndTime"><b>课程结束时间：</b>{{ddinfo3.info.courseEndTime}}</li>-->
			 <!--      	<li class="list-group-item" v-if="ddinfo3.info.examStartTime"><b>考试开始时间：</b>{{ddinfo3.info.examStartTime}}</li>-->
			 <!--      	<li class="list-group-item" v-if="ddinfo3.info.examEndTime"><b>考试结束时间：</b>{{ddinfo3.info.examEndTime}}</li>-->
			 <!--      	<li class="list-group-item"><b>订单状态：</b><span style="color: red;">{{ddinfo3.info.status}}</span>&nbsp;<button v-if="ddinfo3.info.dockstatus!='99'" @click="up(ddinfo3.info.oid)" class="btn btn-xs btn-success">刷新</button>&nbsp;</li>-->
			 <!--      	<li class="list-group-item"><b>进度：</b>{{ddinfo3.info.process}}<div class="progress">-->
		  <!--          	        <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" v-bind:style="'width:'+(ddinfo3.info.process)+';' ">-->
		  <!--          	        </div>-->
		  <!--          	    </div></li>-->
			 <!--      	<li class="list-group-item" v-if="ddinfo3.info.remarks"><b>备注：</b>{{ddinfo3.info.remarks}}</li>-->
			 <!--      	<li class="list-group-item" v-if="ddinfo3.info.status!='已取消'"><b>操作：</b><button @click="ms(ddinfo3.info.oid)" v-if="false" class="btn btn-xs btn-danger">秒刷</button>&nbsp;<button v-if="false" @click="layer.msg('更新中，近期开放')" class="btn btn-xs btn-info">修改密码</button>&nbsp;<button @click="bs(ddinfo3.info.oid)" class="btn btn-xs btn-primary">补刷</button>&nbsp;<button @click="quxiao(ddinfo3.info.oid)"  class="btn btn-xs btn btn-info">取消</button></li>		       	  -->
		  <!--    </div>-->
		      
		  <!--  </div>-->
		  <!--</div>-->
		  
		  
			    <div id="ddinfo2" style="display: none;"><!--订单详情-->                    
			       <li class="list-group-item">
			       	<b>课程类型：</b>{{ddinfo3.info.ptname}}<span v-if="ddinfo3.info.miaoshua=='1'" style="color: red;">&nbsp;秒刷</span></li>
			       	<li class="list-group-item" style="word-break:break-all;"><b>账号信息：</b>{{ddinfo3.info.school}}&nbsp;{{ddinfo3.info.user}}&nbsp;{{ddinfo3.info.pass}}</li>
			       	<li class="list-group-item"><b>课程名字：</b>{{ddinfo3.info.kcname}}</li>
			       	<li class="list-group-item" v-if="ddinfo3.info.name!='null'"><b>学生姓名：</b>{{ddinfo3.info.name}}</li>
			       	<li class="list-group-item"><b>下单时间：</b>{{ddinfo3.info.addtime}}</li>
			       	<li class="list-group-item" v-if="ddinfo3.info.finalupdate"> <b>最近更新：</b><span style="color: red;">{{ddinfo3.info.finalupdate}}</span></li>
			       	<li class="list-group-item" v-if="ddinfo3.info.courseStartTime"><b>课程开始时间：</b>{{ddinfo3.info.courseStartTime}}</li>
			       	<li class="list-group-item" v-if="ddinfo3.info.courseEndTime"><b>课程结束时间：</b>{{ddinfo3.info.courseEndTime}}</li>
			       	<li class="list-group-item" v-if="ddinfo3.info.examStartTime"><b>考试开始时间：</b>{{ddinfo3.info.examStartTime}}</li>
			       	<li class="list-group-item" v-if="ddinfo3.info.examEndTime"><b>考试结束时间：</b>{{ddinfo3.info.examEndTime}}</li>
			       	<li class="list-group-item"><b>订单状态：</b><span style="color: red;">{{ddinfo3.info.status}}</span>&nbsp;<button v-if="ddinfo3.info.dockstatus!='99'" @click="up(ddinfo3.info.oid)" class="btn btn-xs btn-success">更新</button>&nbsp;<button  v-if="ddinfo3.info.cid == 1 || ddinfo3.info.cid == 2 || ddinfo3.info.cid == 3 || ddinfo3.info.cid == 4 || ddinfo3.info.cid == 5 || ddinfo3.info.cid == 6 || ddinfo3.info.cid == 7 || ddinfo3.info.cid == 10 || ddinfo3.info.cid == 11 || ddinfo3.info.cid == 8 || ddinfo3.info.cid == 14 || ddinfo3.info.cid == 1504 || ddinfo3.info.cid == 1505"  @click="zt(ddinfo3.info.oid)" class="btn btn-xs btn-purple"><li class="icon icon-refresh"></li>暂停</button></li>
			       	<li class="list-group-item"><b>进度：</b>{{ddinfo3.info.process}}</li>
			       	<li class="list-group-item"v-if="ddinfo3.info.remarks"><b>备注：</b>{{ddinfo3.info.remarks}}</li>
			       	<li class="list-group-item" v-if="ddinfo3.info.kcid" ><b>kcid：</b>{{ddinfo3.info.kcid}}</li>
			       	<li class="list-group-item"><b>下单金额：</b>{{ddinfo3.info.fees}}</li>
			       	<li class="list-group-item" v-if="ddinfo3.info.status!='已取消'"><b>操作：</b>
			       	<button   v-if="ddinfo3.info.cid == 1 || ddinfo3.info.cid == 2 || ddinfo3.info.cid == 3 || ddinfo3.info.cid == 4 || ddinfo3.info.cid == 5 || ddinfo3.info.cid == 6 || ddinfo3.info.cid == 7 || ddinfo3.info.cid == 10 || ddinfo3.info.cid == 11 || ddinfo3.info.cid == 8 || ddinfo3.info.cid == 14|| ddinfo3.info.cid == 1504 || ddinfo3.info.cid == 1505"        @click="ms(ddinfo3.info.oid)" class="btn btn-xs btn-warning "><li class="icon icon-refresh"></li>秒刷</button>&nbsp;
			       	
			       	<!--<button v-if="true" @click="layer.msg('更新中，近期开放')" class="btn btn-xs btn-info">修改密码</button>&nbsp;-->
			       	<button v-if="ddinfo3.info.cid == 1 || ddinfo3.info.cid == 2 || ddinfo3.info.cid == 3 || ddinfo3.info.cid == 4 || ddinfo3.info.cid == 5 || ddinfo3.info.cid == 6 || ddinfo3.info.cid == 7 || ddinfo3.info.cid == 10 || ddinfo3.info.cid == 11 || ddinfo3.info.cid == 8 || ddinfo3.info.cid == 14"  @click="xgmm(ddinfo3.info.oid)" class="btn btn-xs btn-info">修改密码</button>&nbsp;  
			       	<button @click="bs(ddinfo3.info.oid)" class="btn btn-xs btn-primary">补刷</button>&nbsp;
			       	
			       	
			       	<button @click="quxiao(ddinfo3.info.oid)"  class="btn btn-xs btn btn-info">取消</button></li>	       	  
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
<script src="assets/cdn/axios.min.js"></script>
<script src="assets/js/vue.min.js"></script>
<script src="assets/js/vue-resource.min.js"></script>
<script src="assets/js/element.js"></script>
<script type="text/javascript" src="./list2.js"></script>
<script src="assets/js/shuiyin.js"></script>
<!-- 引入样式 -->
<link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
<!-- 引入组件库 -->
<script src="https://unpkg.com/element-ui/lib/index.js"></script>



 <?php if ($conf['ddggkg']==1) {?>
      <script>
layer.alert('<?=$conf['ddgg'];?>', {
  time: 5*1000
  ,success: function(layero, index){
    var timeNum = this.time/1000, setText = function(start){
      layer.title((start ? timeNum : --timeNum) + ' 秒后关闭', index);
    };
    setText(!0);
    this.timer = setInterval(setText, 1000);
    if(timeNum <= 0) clearInterval(this.timer);
  }
  ,end: function(){
    clearInterval(this.timer);
  }
});
 </script>
   <?}?>
   
   
   
   
   
   <script src="https://cdn.bootcss.com/sweetalert/2.1.0/sweetalert.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// document.addEventListener('DOMContentLoaded', function () {
//   var now = new Date().getTime();
//   var popupShownTime = localStorage.getItem('popupShownTime');
//   var timePassed = now - popupShownTime;
//   if (!popupShownTime || timePassed > 600000) {
//     Swal.fire({
//       title: '微信扫码关注',
//       html: '<p><span style="font-size: 10pt;"><img src="https://img2.imgtp.com/2024/04/27/nVaDCYKn.png" alt="My alt text" width="88" height="89" /></span></p>',
//       showCancelButton: true, // 显示取消按钮
//       cancelButtonText: '关闭', // 按钮文本
//       showConfirmButton: false, // 不显示确认按钮
//     }).then((result) => {
//       /* 如果需要在关闭弹出框后执行一些操作，可以在这里添加 */
//     });
//     // 更新localStorage中的时间戳
//     localStorage.setItem('popupShownTime', now.toString());
//   }
// });
</script>

   
   
   
   
   