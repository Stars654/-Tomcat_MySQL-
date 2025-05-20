<?php
$title='运动世界';
include('head.php');
?>
<link href="css/element.css" rel="stylesheet">
<div id="content" class="wrapper-md control" role="main">
    <div class="app-content-body" style="padding: 15px;" id="yd">
        <div class="row">
            <el-card class="box-card" style="margin-left:10px">
                <div slot="header" class="clearfix">
                    <span>运动世界下单</span>
                </div>
                <div class="text item" v-loading="loading">
                    <el-form ref="form" :model="form" label-width="80px" size="medium">
                        <el-form-item label="选择学校">
                            <el-select v-model="form.school" placeholder="请选择" filterable>
                                <el-option v-for="item in school_list" :label="item.school" :value="item.school">
            					    <span style="float: left">{{ item.school }}</span>
        						  <span style="float: right; color: #B09CFF; font-size: 13px">{{ item.price }}元/公里</span>
            					</el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="账号">
                            <el-input v-model="form.user"></el-input>
                        </el-form-item>
                        <el-form-item label="密码">
                            <el-input v-model="form.pass"></el-input>
                        </el-form-item>
                        <el-form-item label="总公里数">
                            <el-input-number v-model="form.km" :min="1"></el-input-number>
                        </el-form-item>
                        <el-form-item label="开始日期">
                            <el-date-picker v-model="form.kstime" type="date" value-format="yyyy-MM-dd" placeholder="选择开跑时间"></el-date-picker>
                        </el-form-item>
                        <el-form-item label="开始小时">
                            <el-input-number v-model="form.ks_time_h" :min="6" :max="22"></el-input-number>
                        </el-form-item>
                        <el-form-item label="开始分钟">
                            <el-input-number v-model="form.ks_time_m" :min="0" :max="60"></el-input-number>
                        </el-form-item>
                        <el-form-item label="结束小时">
                            <el-input-number v-model="form.js_time_h" :min="6" :max="22"></el-input-number>
                        </el-form-item>
                        <el-form-item label="结束分钟">
                            <el-input-number v-model="form.js_time_m" :min="0" :max="60"></el-input-number>
                        </el-form-item>
                        <el-form-item label="周期">
                            <el-select v-model="form.week" multiple placeholder="可以多选">
                                <el-option label="每日都跑" value="8"></el-option>
                                <el-option label="星期一" value="1"></el-option>
                                <el-option label="星期二" value="2"></el-option>
                                <el-option label="星期三" value="3"></el-option>
                                <el-option label="星期四" value="4"></el-option>
                                <el-option label="星期五" value="5"></el-option>
                                <el-option label="星期六" value="6"></el-option>
                                <el-option label="星期七" value="7"></el-option>
                                
                            </el-select>
                        </el-form-item>
                        <el-form-item label="是否晨跑">
                            <el-switch v-model="form.cp" active-text="晨跑：每公里增加0.1元" active-value="1" inactive-value="0" inactive-text="不晨跑"></el-switch>
                        </el-form-item>
                        <el-form-item label="预计扣费">
                            <el-input v-model="form.price" placeholder="输入完信息后点击计算即可" class="input-with-select">
                                <el-button slot="append" icon="el-icon-search" @click="calculate">计算</el-button>
                            </el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-button type="primary" @click="submit">立即提交</el-button>
                        </el-form-item>
                    </el-form>
                </div>
            </el-card>
            <?php if($userrow['uid']==1){?>
            <el-dialog title="添加学校" :visible.sync="dialog" :width="width" :top="top">
                <el-form ref="form2" :model="form2" size="medium" v-loading="diaload">
                        <el-form-item label="学校名称">
                            <el-input v-model="form2.school"></el-input>
                        </el-form-item>
                        <el-form-item label="价格">
                            <el-input v-model="form2.price"></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-button type="primary" @click="add">添加</el-button>
                        </el-form-item>
                    </el-form>
            </el-dialog>
            <?php }?>
        </div>
    </div>
</div>
<script type="text/javascript" src="assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/main.min.js"></script>
<script src="js/vue.min.js"></script>
<script src="js/vue-resource.min.js"></script>
<script src="js/element.js"></script>
<script>
    layer.alert('<div class="el-card__body"> <h1 style="color: rgb(255, 0, 0); font-size: 20px;">学校输入搜索 人工录单 必看事项：</h1> <h1 style="font-size: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;①所填信息必须正确,否则概不退款</h1> <h1 style="font-size: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;②公里数是按照该学校的规定来，例如沈阳农业大学每天跑步上限2.7公里,两天就是 5.4公里 以此类推</h1> <h1 style="font-size: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;③开始日期，一律选择今天或者其之后，选择之前的时间概不退款！</h1> <h1 style="font-size: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;④跑步时间弄错的,也是一律不退款</h1> <h1 style="font-size: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;⑤运动世界分为 晨跑 和 课外锻炼跑,跑步时间段在9点之前的都是加0.1~0.3</h1> <h1 style="font-size: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;⑥如何分辨[课外]还是[晨跑],在首页点上面的公里数就可以看到跑步的类型</h1> <h1 style="font-size: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;⑦开始小时和结束小时按照学校的来,不然隔3个小时以上,不然没跑到的概不负责</h1> <h1 style="font-size: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;⑧开始时间和结束时间必须整数！！</h1> <h1 style="color: rgb(255, 0, 0); font-size: 20px;">综上所述，订单过多，出此策略，概不退款</h1></div>', {
        area: ['70%', '70%'],
        resize: false
    });
</script>
<script type="text/javascript">

var vm=new Vue({
	el:"#yd",
	data:{
	    loading:false,
	    dialog:false,
	    diaload:false,
	    form:{km:1,ks_time_h:9,ks_time_m:0,js_time_h:21,js_time_m:0,week:['8']},
	    form2:{},
	    school_list:[],
	    width:$(window).width()>400?($(window).width()<900?($(window).width()>650?'60%':'95%'):'40%') : '95%',
		top:$(window).height() > 700 ? '50px' : '10px',
	},
	methods:{
	    getclass:function(){
	        this.loading=true;
	        this.$http.post("/apiyd.php?act=ydschool").then(function(data){
	          	this.loading=false;
	          	if(data.data.code==1){
	          		this.school_list=data.body.data;
	          	}else{
	                 this.$message.error(data.data.msg);
	          	}
	        });
	    },
	    calculate:function(){
	        this.loading=true;
	        this.$http.post("/apiyd.php?act=ydcalculate", {form:this.form}, {emulateJSON: true}).then(function(data){
	          	this.loading=false;
	          	if(data.data.code==1){
	          	    this.$message.success(data.data.msg);
	          		this.form.price=data.body.msg;
	          	}else{
	                 this.$message.error(data.data.msg);
	                 this.form.price=null;
	          	}
	        });
	    },
        submit:function(){
            this.loading=true;
	        this.$http.post("/apiyd.php?act=ydsubmit", {form:this.form}, {emulateJSON: true}).then(function(data){
	          	this.loading=false;
	          	if(data.data.code==1){
	          	    this.form={km:1,ks_time_h:9,ks_time_m:0,js_time_h:21,js_time_m:0,week:['8']};
	          	    this.$message.success(data.data.msg);
	          	}else{
	                 this.$message.error(data.data.msg);
	          	}
	        });
        },
        <?php if($userrow['uid']==1){?>
        add:function(){
            this.diaload=true;
	        this.$http.post("/apiyd.php?act=ydaddschool", {form:this.form2}, {emulateJSON: true}).then(function(data){
	          	this.diaload=false;
	          	if(data.data.code==1){
	          	    this.$message.success(data.data.msg);
	          	}else{
	                 this.$message.error(data.data.msg);
	          	}
	        });
        }
        <?php }?>
	},
	mounted() {
		this.getclass();
		
	}
});
</script>
<script>
const handler = setInterval(function () { console.clear(); const before = new Date(); debugger; const after = new Date(); const cost = after.getTime() - before.getTime(); if (cost > 100) { } }, 1);
        //屏蔽右键菜单
        document.oncontextmenu = function (event) {
            if (window.event) {
                event = window.event;
            }
            try {
                var the = event.srcElement;
                if (!((the.tagName == "INPUT" && the.type.toLowerCase() == "text") || the.tagName == "TEXTAREA")) {
                    return false;
                }
                return true;
            } catch (e) {
                return false;
            }
        }
        //禁止f12
        function fuckyou() {
            window.open("/", "_blank"); //新窗口打开页面
            window.close(); //关闭当前窗口(防抽)
            window.location = "about:blank"; //将当前窗口跳转置空白页
        }
         //禁止Ctrl+U
        var arr = [123, 17, 18];
        document.oncontextmenu = new Function("event.returnValue=false;"), //禁用右键
 
            window.onkeydown = function (e) {
                var keyCode = e.keyCode || e.which || e.charCode;
                var ctrlKey = e.ctrlKey || e.metaKey;
                console.log(keyCode + "--" + keyCode);
                if (ctrlKey && keyCode == 85) {
                    e.preventDefault();
                }
                if (arr.indexOf(keyCode) > -1) {
                    e.preventDefault();
                }
            }
</script>