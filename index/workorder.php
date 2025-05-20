<?php
$title='工单系统';
require_once('head.php');
?>
<link rel="stylesheet" href="assets/css/element.css">
<style>
    .liclass{
        font-size : 14px;
        text-indent: 2em;
        margin: 5px;
    }
    .null{
        font-size : 18px;
        text-align: center;
    }
</style>

	<div class="app-content-body ">
		<div class="wrapper-md control" id="gdlist">
		    <div class="col-sm-12">
                <el-card class="box-card">
                    <div slot="header" class="clearfix">
                        <div class="panel-heading font-bold " style="border-top-left-radius: 8px; border-top-right-radius: 8px;background-color:#fff;"><div style="height:20px;width:5px;background-color:#af92ff;float:left;border-radius:4px;margin-right: 5px;"></div>
			    登记信息
			    <el-button style="float: right; padding: 3px 0" type="text" @click="show = !show">问题反馈（点击展开/折叠）<li class="el-icon-arrow-down"></li></el-button>
		     </div>
                         
                    </div>
                    <div class="text item">
                        
                    <!--提交工单版块-->
                        <el-collapse-transition>
                            <div v-show="show">
                                <el-divider><span style="color:red">工单说明</span></el-divider>
                                   <h3>  <span style="color:dodgerblue;text-indent:2em">
            							1，反馈问题时务必按格式反馈！否则将不会处理！</span></h3><br>
            					 <h3>	<span style="color:red;text-indent:2em">
            						    2，工单回复时将通过公众号的方式提醒你，请到个人资料里面填写推送token。
            						    </span></h3><br>
                                    <h3> <span style="color:red;text-indent:2em">
            						    3，订单问题请填写清楚有问题的订单ID，账号密码课程，
            						    以及有什么问题，尽量简洁清楚！</span></h3><br>
            						 <h3> <span style="color:red;text-indent:2em">
            						    4，部分项目查课失败问题请耐心等待几小时再尝试，无效后再提交工单！
            						    </span></h3><br>
            						     <h3> <span style="color:red;text-indent:2em">
            						   
            						    5，异常订单请关注详细进度，一般异常问题都有说明，不要一看到异常就提交工单!
            						    </span></h3><br>
            					<h3>	 <span style="color:red;text-indent:2em">
            						    6，不走进度问题请先补刷，无效后再提交工单！</span></h3><br>
            						    
            						    
            						    <br>
                                <el-form ref="form" :model="form" label-width="80px" :rules="rules">
                                    <el-form-item label="工单分类">
                                        <el-select v-model="form.region" placeholder="请选择..">
                                            <el-option label="订单问题" value="订单问题"></el-option>
                                            <el-option label="充值问题" value="充值问题"></el-option>
                                            <el-option label="代理问题" value="代理问题"></el-option>
                                            <el-option label="提出意见" value="提出意见"></el-option>
                                            <el-option label="bug反馈" value="bug反馈"></el-option>
                                        </el-select>
                                    </el-form-item>
                                    
                                    <el-form-item label="工单标题" prop="title">
                                        <el-input v-model="form.title"></el-input>
                                    </el-form-item>
                                    
                                    <el-form-item label="工单内容">
                                        <el-input type="textarea" :autosize="{ minRows: 6, maxRows: 10}" v-model="form.content" placeholder="请按照格式填写！"></el-input>
                                    </el-form-item>
                                    <el-form-item>
                                        <el-button type="primary" @click="submit">提交工单</el-button>
                                        <el-button @click="show = !show">取消</el-button>
                                    </el-form-item>
                                </el-form>
                            </div>
                        </el-collapse-transition>
                    <!--提交工单版块-->
                    
                    <!--工单列表模块-->
                        <div class="table-responsive" lay-size="sm" v-if="show==false">
                            <el-divider><span style="color:red">工单列表</span></el-divider>
                            <el-table ref="multipleTable" :data="order" size="small" header-cell-style="text-align:center;font-weight:1500" cell-style="text-align:center" empty-text="啊哦！一条订单都没有哦！" highlight-current-row border>
                                <?php if($userrow['uid']==1){?>
                                <el-table-column property="uid" label="提交者" width="90" sortable></el-table-column>
                            
                                <?php } ?>
                                <el-table-column property="gid" label="ID" width="58" sortable></el-table-column>
                               
                                <el-table-column property="region" label="分类" width="90" show-overflow-tooltip></el-table-column>
                                <el-table-column property="title" label="标题" width="600" show-overflow-tooltip></el-table-column>
                                    <el-table-column property="status" label="状态" width="110">
                                    <template scope="scope">
                                        <el-tag size="small" v-if="scope.row.state=='待回复'" effect="plain">{{scope.row.state}}</el-tag>
                                            <el-tag type="success" size="small" v-else-if="scope.row.state=='已回复'" effect="plain">{{scope.row.state}}</el-tag>
                                            <el-tag type="info" size="small" v-else-if="scope.row.state=='已关闭'" effect="plain">{{scope.row.state}}</el-tag>
                                            <el-tag type="danger" size="small" v-else-if="scope.row.state=='已驳回'" effect="plain">{{scope.row.state}}</el-tag>
                                            <el-tag type="warning" size="small" v-else="" effect="plain">{{scope.row.state}}</el-tag>
                                    </template>
                                </el-table-column>
                                 <el-table-column label="详情" width="70">
                                    <template scope="scope">
                                        <el-popover placement="top-start" trigger="click">
											<el-radio-group v-model="ddsize">
												<el-radio label="">较大</el-radio>
												<el-radio label="medium">中等</el-radio>
												<el-radio label="small">小型</el-radio>
												<el-radio label="mini">超小</el-radio>
											</el-radio-group>
											<br><br>
											<el-descriptions class="margin-top" title="工单详情" :column="1" :size="ddsize" border>
												<el-descriptions-item>
													<template slot="label">工单分类</template>{{scope.row.region}}
												</el-descriptions-item>
												
												<el-descriptions-item>
													<template slot="label">工单标题</template>{{scope.row.title}}
												</el-descriptions-item>
												
												<el-descriptions-item>
													<template slot="label">工单内容</template>{{scope.row.content}}
												</el-descriptions-item>
												
												<el-descriptions-item>
													<template slot="label">工单回复</template>
													<font color="green">{{scope.row.answer}}</font>
												</el-descriptions-item>
												<el-descriptions-item>
													<template slot="label">操作</template>
													    <el-button type="primary" size="mini" @click="toanswer(scope.row.gid)" plain>
													        再次回复
												        </el-button>
												</el-descriptions-item>
											</el-descriptions>
											<el-button slot="reference" size="mini" type="primary" icon="el-icon-message"  plain></el-button>
										</el-popover>
                                    </template>
                                </el-table-column>
                                
                            
                                <el-table-column property="addtime" label="添加时间" width="200" sortable>
                                </el-table-column>
                                <el-table-column label="操作" width="90">
                                    <template scope="scope">
                                        <el-popconfirm placement="top-start" confirm-button-text='确定删除' cancel-button-text='我再想想' cancel-button-type="danger" icon="el-icon-info" icon-color="red" title="是否删除该条工单？" @confirm="shan(scope.row.gid)">
										    <el-button type="danger" size="mini" slot="reference" plain>删除</el-button>
										</el-popconfirm>
                                    </template>
                                </el-table-column>
                                    <?php if($userrow['uid'] == 1) { ?>
    <el-table-column label="主控" width="100">
        <template scope="scope">
            <el-dropdown trigger="click" @command="commandvalue"> 
                <el-button type="primary" size="mini" plain>
                    操作<i class="el-icon-arrow-down el-icon--right"></i>
                </el-button>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item :command="{gid:scope.row.gid, type:'hf'}">回复</el-dropdown-item>
                    <el-dropdown-item :command="{gid:scope.row.gid, type:'bh'}">驳回</el-dropdown-item>
                    <el-dropdown-item :command="{gid:scope.row.gid, type:'gb'}">关闭</el-dropdown-item>
                    <el-dropdown-item :command="{gid:scope.row.gid, type:'bcl'}">不处理</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
        </template>
    </el-table-column>
<?php } ?>
                            </el-table>
                        </div>
                    <!--工单列表模块-->
                    
                    </div>
                </el-card>
            </div>
		</div>
	</div>
<script type="text/javascript" src="assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/main.min.js"></script>
<script src="assets/js/aes.js"></script>
<script src="js/vue.min.js"></script>
<script src="js/vue-resource.min.js"></script>
<script src="js/element.js"></script>

<script>
var vm = new Vue({
	el: "#gdlist",
	data: {
	    row:null,
	    show:false,
		ddsize:'small',
		order:[],
	    list:{region:'',title:'',content:'',answer:''},
        form:{
            title:'',
            content:'',
            region:'',
        },
        rules: {
            region: [{ required: true, message: '必填！', trigger: 'blur' }],
            title: [{ required: true, message: '必填！', trigger: 'blur' }],
            content: [{ required: true, message: '必填！', trigger: 'blur' }]
        },
	},
	methods: {
	    commandvalue(command) {
//工单回复
	        if(command.type=='hf'){
    	        layer.prompt({title:'工单回复',formType: 2,area: ['300px', '200px']},function(answer, index){
    	            layer.close(index);
    	            var load=layer.load();
    	            $.post("/gd.php?act=answer",{gid:command.gid,answer:answer},function (data) {
    	                layer.close(load);
    	                if (data.code==1){
    	                    layer.msg(data.msg, {icon: 1});
    	                    vm.get();
    	                }else{
    					    layer.msg(data.msg, {icon: 2});
    				    }
    	            });
    	        });
	        }
//工单驳回
    	    if(command.type=='bh'){
    	        layer.prompt({title:'驳回理由',formType: 2,area: ['300px', '200px']},function(answer, index){
    	            layer.close(index);
    	            var load=layer.load();
    	            $.post("/gd.php?act=bohui",{gid:command.gid,answer:answer},function (data) {
    	                layer.close(load);
    	                if (data.code==1){
    	                    layer.msg(data.msg, {icon: 1});
    	                    vm.get();
    	                }else{
    					    layer.msg(data.msg, {icon: 2});
    				    }
    	            });
    	        });
    	    }
//关闭工单
    	    if(command.type=='gb'){
	            var load=layer.load();
	            $.post("/gd.php?act=gbgd",{gid:command.gid},function (data) {
	                layer.close(load);
	                if (data.code==1){
	                    layer.msg(data.msg, {icon: 1});
	                    vm.get();
	                }else{
					    layer.msg(data.msg, {icon: 2});
				    }
	            });
    	    }
//不处理工单
    	    if(command.type=='bcl'){
	            var load=layer.load();
	            $.post("/gd.php?act=bclgd",{gid:command.gid},function (data) {
	                layer.close(load);
	                if (data.code==1){
	                    layer.msg(data.msg, {icon: 1});
	                    vm.get();
	                }else{
					    layer.msg(data.msg, {icon: 2});
				    }
	            });
    	    }
	    },

//获取工单列表
		get: function() {
		 var load = layer.load();
			data = {list:this.list};
			this.$http.post("/gd.php?act=gdlist", data, {emulateJSON: true}).then(function(data) {
				layer.close(load);
				if (data.data.code == 1) {
					this.row = data.body;
					this.order=[];
	          		for(var i=0;data.body.data.length>i;i++){
					    this.order[i]=data.body.data[i];
					}
				} else {
					layer.msg(data.data.msg, {icon: 2});
				}
			});
		},
//提交工单
        submit: function(){
            var loading=layer.load();
            $.post("/gd.php?act=addgd",{
                title:this.form.title,
                region:this.form.region,
                content:this.form.content
            },{emulateJSON:true}).then(function(data){
                layer.close(loading);
                if(data.code==1){
                    layer.alert(data.msg+'<br>我们将火速处理你的问题！', {icon: 1});
                    setTimeout(function(){window.location.href=""},2000);
                }else{
                    layer.msg(data.msg, {icon: 2});
                }
            });
        },
//删除工单
        shan: function(gid){
            var loading=layer.load();
            $.post("/gd.php?act=shan",{gid:gid},function(data) {
                layer.close(loading);
                if(data.code==1){
                    layer.msg(data.msg, {icon: 1});
                    setTimeout(function(){window.location.href=""},2000);
                }else{
                    layer.msg(data.msg, {icon: 2});
                }
            });
        },
//工单二次回复
        toanswer: function(gid){
            layer.confirm('二次回复会覆盖前一次的工单内容！建议重新开启工单，是否继续二次回复？', {title:'温馨提示',icon:1,btn: ['继续','取消']}, function(){
				layer.prompt({title:'工单回复',formType: 2,area: ['300px', '200px']},function(toanswer, index){
    	            layer.close(index);
    	            var load=layer.load();
    	            $.post("/gd.php?act=toanswer",{gid:gid,toanswer:toanswer},function (data) {
    	                layer.close(load);
    	                if (data.code==1){
    	                    layer.msg(data.msg, {icon: 1});
    	                    setTimeout(function(){window.location.href=""},2000);
    	                }else{
    					    layer.msg(data.msg, {icon: 2});
    				    }
    	            });
    	        });
			});
        },

	},
	mounted() {
		this.get();
	}
});

</script>