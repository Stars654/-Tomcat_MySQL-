<?php
$title='普通补习';
require_once('head.php');
$url="api.ax.jstzsjz.com.cn";
$token = "sbsbsbsbsbsbbsbsbsbsbs"; //此处填写token
$addsalt=md5(mt_rand(0,999).time());
$_SESSION['addsalt']=$addsalt;

?>
<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/apps.css" type="text/css" />
<link rel="stylesheet" href="assets/css/app.css" type="text/css" />
<link rel="stylesheet" href="assets/layui/css/layui.css" type="text/css" />
<link href="../assets/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/LightYear/js/bootstrap-multitabs/multitabs.min.css">
<link href="assets/LightYear/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/LightYear/css/style.min.css" rel="stylesheet">
<link href="assets/LightYear/css/materialdesignicons.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<script src="/assets/js/jquery.min.js"></script>
<script src="layer/3.1.1/layer.js"></script>

</head>
<body><style>
    .card__operate{
        width: 100%;
        /*display: flex;*/
        justify-content:space-between;
        padding: 15px 25px 0px 25px;
    }
    .card__operate__seach{
        width: 100%;
        max-width: 450px;
    }
    .card__operate__seach .el-input__inner{
        height: 32px;
        line-height: 32px;
    }
    .card__operate__seach .el-input__suffix .el-input__suffix-inner>.el-input__icon{
        line-height: 32px;
    }
</style>
<link rel="stylesheet" href="assets/css/element.css">
<link rel="stylesheet" href="css/element.css">

 <div class="panel panel-default" style="box-shadow: 3px 3px 8px #d1d9e6, -3px -3px 8px #d1d9e6; border-radius: 10px;">
     <div class="app-content-body ">

    <div class="wrapper-md control" id="app" >
         <!-- 下单弹窗-->
      <el-dialog title="添加订单" :visible.sync="dialog" :width="width" >
        <el-alert title="下单前请确保账号密码正确，密码可以改，账号不能改，退单有手续费扣费20%" type="warning"></el-alert>&nbsp;
        <el-alert title="记得让客户账号实名认证，未实名认证无法进行！" type="warning"></el-alert>&nbsp;
          <el-alert title="发码地址【先下单在发码】：http://yz.ax.jstzsjz.com.cn" type="warning" effect="dark"></el-alert>&nbsp;
          <!--<el-alert title="查分地址【可发给客户用】：push.ax.jstzsjz.com.cn" type="warning" effect="dark"></el-alert>&nbsp;-->
           <el-alert title="所有操作账号学习中才能用，未登陆的账号不要进行任何操作。" type="error" effect="dark"></el-alert>&nbsp;
         <el-form ref="form" :model="form" label-width="auto" v-loading="diaload" size="medium">
        <el-form-item label="账号">
        <el-input v-model="form.user"></el-input>
        </el-form-item>
        <el-form-item label="密码">
        <el-input v-model="form.pass"></el-input>
        </el-form-item>
        <el-form-item label="天数">
        <el-input-number v-model="form.day" :min="1" label="学习天数" style=" background: url('../index/arrow.png') no-repeat scroll 99%; width:100%"></el-input-number>
        </el-form-item>
        <el-form-item label="扣费">
        <el-input v-model="yuji" readonly></el-input>
        </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
        <el-button @click="dialog = false">取 消</el-button>
        <el-button type="primary" @click="add" :loading="addloading">确 定</el-button>
        </div>
        </el-dialog>
	   <!-- 列表 -->
<el-card class="box-card" style="box-shadow: 3px 3px 8px #d1d9e6, -3px -3px 8px #d1d9e6; border-radius: 10px;">
          <!--<el-alert title="稳定运行，点击拉取进度来获取最新分数，请先下单再授权登录！" type="success"></el-alert>&nbsp;-->
          <!--<el-alert title="客户外置授权（先下单在授权）：http://code.techaixue.icu/" type="success"></el-alert>&nbsp;-->
          <!--<el-alert title="客户查分链接：http://push.techaixue.icu/" type="success"></el-alert>-->
          <!--<div style="padding:20px 15px 0px 15px">-->
          <!--    <el-form class="order__form" inline="ture" ref="form" :model="form"  label-width="auto" v-loading="diaload" size="medium">-->
                  <!--<el-form-item label="天数：">
                        <el-input-number v-model="form.day" :min="7" label="学习天数" ></el-input-number>
                    </el-form-item>
                    <el-form-item label="账号：">
                    <el-input v-model="form.user"></el-input>
                    </el-form-item>
                    <el-form-item label="密码：">
                        <el-input v-model="form.pass"></el-input>
                    </el-form-item>
                    <el-form-item label="预计扣费：">
                        <el-input v-model="yuji" readonly></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="add" :loading="addloading" >提交订单</el-button>
                    </el-form-item>-->
          <!--    </el-form>-->
              
          <!--</div>-->
          <div class="card__operate">
              <div>
                   <el-button type="primary" @click="dialog=true" size="">提交订单</el-button>
                  <el-button type="success"  size="" @click="update">同步进度</el-button>
                  <el-button type="success" onclick="javascript:void(0);window.open('http://yz.ax.jstzsjz.com.cn/#/');" size="small" plain>打开授权地址</el-button>
                  <el-button type="info" onclick="javascript:void(0);window.open('https://327404-1320488233.cos.ap-beijing.myqcloud.com/%E5%BE%AE%E4%BF%A1%E6%8E%A8%E9%80%81%E6%96%B9%E6%B3%95.jpg');" size="">微信推送</el-button><br><br>
                   <el-alert title="账号学习中才能用操作，非学习中别点任何操作。" type="error" effect="dark"></el-alert>&nbsp;
                   <el-alert title="对接失败是你号在别人那里下过鸡巴让他删除掉。" type="warning" effect="dark"></el-alert>
<!--                  <br><br>-->
<!--<el-button type="warning" onclick="javascript:void(0);window.open('http://code.techaixue.icu/#/');" size="small">提交后点我授权</el-button>-->
<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
<!--<el-button type="warning" onclick="javascript:void(0);window.open('http://push.techaixue.icu/#/');" size="small">客户外置查分数</el-button>-->

              </div>
              <div>
                  <br>
                 
                  <!--<div class="card__operate__seach" >-->
                      <div class="card" >
                      <el-input placeholder="模糊查询" v-model="cx.qq" class="input-with-select" >
                          <el-select v-model="cx.search" style="width:80px" placeholder="条件" slot="prepend" >
                              <el-option label="状态" value="status"></el-option>
                              <el-option label="账号" value="user"></el-option>
                              <el-option label="密码" value="pass"></el-option>
                              <el-option label="剩余天数" value="sytime"></el-option>
                          </el-select>
                          <el-button slot="append" icon="el-icon-search" @click="query" />
                      </el-input>
                      
                  </div>
              </div>
              
          </div>
          
        
        <div class="card-body">
          <el-table
            :data="tableData"
            v-loading="loading" 
            element-loading-text="载入数据中" 
            ref="multipleTable"  
            size="small" 
            header-cell-style="text-align:center;font-weight:1500" 
            cell-style="text-align:center" 
            empty-text="啊哦！你还没有下单哦！" 
            highlight-current-row>
          <el-table-column
            prop="qid"
            label="ID"
            width="60">
          </el-table-column>
          <el-table-column
            prop="uid"
            label="UID"
            width="60">
          </el-table-column>
                  <el-table-column
            label="操作"
            width="130%"      
            >
            <template slot-scope="scope">
			<el-tag type="success" size="" @click="faMaFun(scope.row)" effect="dark" >发码</el-tag>&nbsp;&nbsp;
			<el-tag type="primary" size="" @click="LoginFun(scope.row)" effect="dark" >登录</el-tag>
            </template>
          </el-table-column>
          <el-table-column
            prop="user"
            label="账号"
            width="110%">
          </el-table-column>
          <el-table-column
            prop="pass"
            label="密码"
            width="100%">
          </el-table-column>
          <el-table-column label="学习状态" width="120%" show-overflow-tooltip>
                            <template scope="scope">
                                <el-tag effect="plain" class="el-tag el-tag--info el-tag--plain" size="" v-if="scope.row.status=='待学习'">
									{{scope.row.status}}
								</el-tag>
								<el-tag effect="plain" class="el-tag el-tag--success el-tag--plain" size="" type="danger" v-else-if="scope.row.status=='学习完成'">
									{{scope.row.status}}
								</el-tag>
								<el-tag  effect="plain" class="el-tag el-tag--danger el-tag--plain" size="" v-else-if="scope.row.status=='对接失败'">
									{{scope.row.status}}
								</el-tag>
								<el-tag effect="plain" class="el-tag el-tag--plain" size="" v-else-if="scope.row.status=='学习中'">
									{{scope.row.status}}
								</el-tag>
								<el-tag effect="plain" class="el-tag el-tag--success el-tag--plain" size="" v-else-if="scope.row.status=='已学习'">
									{{scope.row.status}}
								</el-tag>
									<el-tag effect="warning" class="el-tag el-tag--success el-tag--plain" size="" v-else-if="scope.row.status=='未登录'">
									{{scope.row.status}}
								</el-tag>
									<el-tag effect="danger" class="el-tag el-tag--success el-tag--plain" size="" v-else-if="scope.row.status=='未验证'">
									{{scope.row.status}}
								</el-tag>
									<el-tag effect="info" class="el-tag el-tag--info el-tag--plain" size="" v-else-if="scope.row.status=='验证码已发送'">
									{{scope.row.status}}
								</el-tag>
									<el-tag effect="info" class="el-tag el-tag--danger el-tag--plain" size="" v-else-if="scope.row.status=='验证码错误'">
									{{scope.row.status}}
								</el-tag>
								<el-tag effect="plain" class="el-tag el-tag--plain" size="" v-else>
									{{scope.row.status}}
								</el-tag>
                            </template>
                        </el-table-column>

           <el-table-column property="score" label="今日分数" width="100%" show-overflow-tooltip>
        			        <template scope="scope">
        			            <el-tag v-if="!scope.row.score" class="el-tag el-tag--warning el-tag--dark">
									待更新
								</el-tag>
								<el-tag v-else-if="scope.row.score>0" class="el-tag el-tag--success el-tag--dark">
									{{scope.row.score}}分
								</el-tag>
								<el-tag type="warning" class="el-tag el-tag--success el-tag--dark" v-else-if="scope.row.score==0">
									{{scope.row.score}}分
								</el-tag>
								<el-tag type="danger" class="el-tag el-tag--dark" v-else>
									{{scope.row.score}}
								</el-tag>
                            </template>
        			    </el-table-column>
      <!--    <el-table-column-->
      <!--    prop="total"-->
      <!--    label="今日/总分"-->
      <!--    width="120">-->
      <!--        <template scope="scope">-->
      <!--              <span>-->
						<!--<el-tag class="el-tag el-tag--success el-tag--dark">{{scope.row.total}}分</el-tag>-->
      <!--              </span>-->
      <!--         </template>-->
      <!--  </el-table-column>-->
        <el-table-column
        prop="sytime"
        label="剩余天数"
        width="80%">
             <template scope="scope">
                    <span>
						<el-tag class="el-tag el-tag--info el-tag--dark">{{scope.row.sytime}}天</el-tag>
                    </span>
               </template>
      </el-table-column>

<el-table-column  label="APP截图" width="210">
        <template slot-scope="scope">
            <el-link :underline="false" @click="jtDialog(scope.row.img1)" type="success">截图1</el-link>
            <el-link :underline="false" @click="jtDialog(scope.row.img2)" type="success">截图2</el-link>
            <el-link :underline="false" @click="jtDialog(scope.row.img3)" type="success">截图3</el-link>
        </template>
</el-table-column>
          <el-table-column
            label="操作"
            width="100%"      
            >
            <template slot-scope="scope">
                <el-dropdown  @command="commandvalue">
                    <el-button type="primary" size="small">
                        操作<i class="el-icon-arrow-down el-icon--right"></i>
                    </el-button>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item :command="{qid:scope.row.qid,type:'xf'}">增加天数</el-dropdown-item>
                        <el-dropdown-item :command="{qid:scope.row.qid,type:'gm'}">修改密码</el-dropdown-item>
                        <el-dropdown-item :command="{qid:scope.row.qid,type:'cz'}">重置状态</el-dropdown-item>
                        <el-dropdown-item :command="{qid:scope.row.yid,type:'uptoken'}">微信推送</el-dropdown-item>
                        <el-dropdown-item :command="{qid:scope.row.qid,type:'tk'}" @confirm="del(scope.row.qid)">申请退款</el-dropdown-item>
                        <el-dropdown-item :command="{qid: scope.row.qid, type: 'delete'}">删除订单</el-dropdown-item>
                          <?php if($userrow['uid']==1){ ?>
                                 <el-dropdown-item :command="{qid:scope.row.qid,type:'readd'}">重新提交</el-dropdown-item>
    							<?php } ?>  
                        </el-dropdown-menu>
                </el-dropdown>
            </template>
          </el-table-column>
      <el-table-column
        prop="endtime"
        label="上次学习"
        width="160%">
      </el-table-column>
      <el-table-column
        prop="addtime"
        label="提交时间"
        width="160%">
      </el-table-column>

        </el-table>
        	<!--<by TaoYao 分页>-->
        	<!--<el-divider></el-divider>-->
<div class="custom-pagination" style="padding-top:50px;">
    <el-pagination 
    :total=pagecount
    :page-size="pagesize"
    :current-page.sync="currentpage"
    :page-sizes= "[20,50,100]"
    layout="total,sizes,prev,pager,next"
    prev-text="　上一页　"
    @prev-click="pagechange(currentpage - 1)"
    next-text="　下一页　"
    @next-click="pagechange(currentpage + 1)"
    @size-change="sizechange"
    @current-change="pagechange"
    :background=true
    />
</div>
<!--<by TaoYao 分页>-->

        </div>
      </el-card>
<el-dialog :visible.sync="jt_dialog" width="400px" custom-class="jtStyle" >
     <div style="padding:10px 20px; display:flex; justify-content:center;">
         <el-image style="width:200px;400px;" :src="jt_link"></el-image>
     </div>
</el-dialog>
     </div>

    </div>

<script type="text/javascript" src="assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/main.min.js"></script>
<script src="assets/js/aes.js"></script>
<script src="../assets/js/vue.min.js"></script>
<script src="https://cdn.staticfile.org/vue-resource/1.5.1/vue-resource.min.js"></script>
<script src="https://cdn.staticfile.org/axios/0.18.0/axios.min.js"></script>
<script src="./assets/js/element.js"></script>
 <script>
          var vm =  new Vue({
              el: '#app',
              data() {
                return {
                loading:false,
                addloading: false,
                currentpage:1,//默认在第几页
            	pagesize:20,//每页显示的数量
            	pagecount:100,//总数的默认值，后面会做调整，此数值无参考意义        
                price:2,
                dialog:false,
                diaload:false,
                jt_dialog:false,
                jt_link : '',
                form:{day:"30"},
                cx: {qq: '',search: ''},
                width:$(window).width() > 400 ? ($(window).width()<900?($(window).width()>650?'60%':'95%'):'40%') : '95%',
                options: [{
          value: '8',
          label: '哆啦'
        },{
          value: '15',
          label: '鸡巴'
        }],
        value: '',
                    tableData: [
                    {
                      "qid": "272",
                      "name": "鸡巴",
                      "uid": "1",
                      "yid": "401",
                      "user": "鸡巴技术支持",
                      "pass": "123456",
                      "status": "待学习",
                      "total": "99999",
                      "score": "100",
                      "sytime": "30",
                      "img1":"",
                      "img2":"",
                      "img3":"",
                      "addtime": "2023-03-31 17:43:21",
                      "endtime": "",
                      "dockstatus": "账号正常",
                      "zhuangtai": ""
                    },
                  ]
                }
              },
              mounted() {
          	this.get_price();
		this.query();
        },
        computed:{
	    yuji:function(){
	        return (this.price*this.form.day).toFixed(2)+"元";
	    }
	},
              methods: {
                  update:function(){
		    this.loading=true;
		    this.$http.post("/qg/cron.php",{emulateJSON:true}).then(function(data){
		    //this.$http.post("http://3106.web.gzdazhihui.com/api/admin/base/sys/order/getPageList",{page:1,size:20,token:'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc1JlZnJlc2giOmZhbHNlLCJyb2xlSWRzIjpbIjE0Il0sInVzZXJuYW1lIjoiOTAzNTAyIiwidXNlcklkIjo5NjIsInBhc3N3b3JkVmVyc2lvbiI6MSwidWlkIjo5NjIsImlhdCI6MTY3ODE5NzY2MCwiZXhwIjoxNjc4MjA0ODYwfQ.TwXQ8s2ucAAnWhRlEMYcmeRmHv5uGa6TQmb8-YmUv9U'},{emulateJSON:true}).then(function(data){
	          	this.loading=false;
	          	this.query();
	          	if(data.data.code==1)vm.$message.success(data.data.msg);
	          	else vm.$message.error(data.data.msg);
	        });
		},
		submit:function(){
		    this.loading=true;
		    this.$http.get("/qg/api.php?act=submit").then(function(data){
	          	this.showmsg(data.data);
	        });
		},
        laqu:function(row){
            data = {user: row.user};
		    this.loading=true;
		    this.$http.post("/qg/api.php?act=laqu",data, {emulateJSON:true}).then(function(data){
		    //this.$http.post("http://3106.web.gzdazhihui.com/api/admin/base/sys/order/getPageList",{page:1,size:20,token:'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc1JlZnJlc2giOmZhbHNlLCJyb2xlSWRzIjpbIjE0Il0sInVzZXJuYW1lIjoiOTAzNTAyIiwidXNlcklkIjo5NjIsInBhc3N3b3JkVmVyc2lvbiI6MSwidWlkIjo5NjIsImlhdCI6MTY3ODE5NzY2MCwiZXhwIjoxNjc4MjA0ODYwfQ.TwXQ8s2ucAAnWhRlEMYcmeRmHv5uGa6TQmb8-YmUv9U'},{emulateJSON:true}).then(function(data){
	          	this.loading=false;
	          	this.query();
	          	if(data.data.code==1)vm.$message.success(data.data.msg);
	          	else vm.$message.error(data.data.msg);
	        });
		},
                  query:function(){
		    this.loading=true;
			data = {cx: this.cx,page:this.currentpage,size:this.pagesize};
			this.$http.post("/qg/api.php?act=order", data, {emulateJSON: true}).then(function(data) {
				this.loading=false;
				if (data.data.code == "0") {
					this.pagecount=Number(data.body.count);
				    this.tableData=data.body.data;
				    // console.log(this.tableData)
				} else {
					this.$message.error(data.data.msg);
				}
			});
		},
	    get_price(id){
		    this.loading=true;
			this.$http.post("/qg/api.php?act=price",{yid : id},{emulateJSON:true}).then(function(data) {
				this.loading=false;
				this.price=data.data.data;
			});
		},
                add:function(){
                    this.addloading = true;
		    if(!this.form.user||!this.form.pass||!this.form.day){
		        this.$message.error("账号密码不能为空！");return false;
		    }
		    this.form.yid = 15;
		    this.$http.post("/qg/api.php?act=add",{form:this.form},{emulateJSON:true}).then(function(data){
	          	this.addloading=false;
	          	this.query();
	          	if(data.data.code==1){
	          	    vm.$message.success(data.data.msg);
	          	    // this.dialog = false;
	          	}
	          	else{ vm.$message.error(data.data.msg);}
	        });
		},
		 commandvalue(command) {
  // 执行删除操作
if (command.type === 'delete') {
  layer.confirm('确定要删除该记录吗？', { btn: ['确定', '取消'], title: '删除确认', icon: 3 }, function (index) {
    layer.close(index);
    vm.loading = true;
    $.post("/qg/api.php?act=delete", { qid: command.qid }, function (data) {
      vm.loading = false;
      if (data.data.code === 1) {
        // 删除成功后在前端移除对应的记录
        const index = vm.data.findIndex(item => item.qid === command.qid);
        location. reload();
        if (index !== -1) {
          vm.data.splice(index, 1);
        }
        vm.$message.success(data.data.msg);
      } else {
        vm.$message.error(data.data.msg);
      }
    });
  });
}
//账号续费
            if(command.type=='xf'){
                layer.prompt({title: '请输入续费天数：', formType: 3},function(day, index){
                    layer.close(index);
                    vm.loading=true;
                    $.post("/qg/api.php?act=xufei",{qid:command.qid,day:day},function (data) {
                    //$.post("http://3106.web.gzdazhihui.com/api/admin/base/sys/order/addDay",{user:command.user,day:day,id:86342,moblie:'15632537673'},function (data) {
                        vm.loading=false;
                        if (data.data.code==1){
                            vm.query();
                            vm.$message.success(data.msg);
                        }else{
                            vm.$message.error(data.msg);
                        }
                    });
                });	
            }
//修改密码
            if(command.type=='gm'){
                layer.prompt({title: '请输入新密码', formType: 3},function(pass, index){
                    layer.close(index);
                    vm.loading=true;
                     $.post("/qg/api.php?act=gm",{qid:command.qid,pass:pass},function (data) {
                    // $.post("http://3106.web.gzdazhihui.com/api/admin/base/sys/order/update",{user:command.user,password:pass},function (data) {
                    //$.post("http://3106.web.gzdazhihui.com/api/admin/base/sys/order/update",{user:command.user,password:pass,moblie:'15936518952',remark:'',id:86441},function (data) {
                        vm.loading=false;
                        if (data.data.code==1){
                            vm.query();
                            vm.$message.success(data.msg);
                        }else{
                            vm.$message.error(data.msg);
                        }
                    });
                });
            }
//推送token
            if(command.type=='uptoken'){
                layer.prompt({title: '请输入微信推送token', formType: 3},function(uptoken, index){
                    layer.close(index);
                    vm.loading=true;
                     $.post("/qg/api.php?act=uptoken",{qid:command.qid,uptoken:uptoken},function (data) {
                    // $.post("http://3106.web.gzdazhihui.com/api/admin/base/sys/order/update",{user:command.user,password:pass},function (data) {
                    //$.post("http://3106.web.gzdazhihui.com/api/admin/base/sys/order/update",{user:command.user,password:pass,moblie:'15936518952',remark:'',id:86441},function (data) {
                        vm.loading=false;
                        if (data.code==1){
                            vm.query();
                            vm.$message.success(data.msg);
                        }else{
                            vm.$message.error(data.msg);
                        }
                    });
                });
            }
//重置状态
            if(command.type=='cz'){
                this.loading=true;
                 $.post("/qg/api.php?act=czstatus",{qid:command.qid},function (data){
                //$.post("http://3106.web.gzdazhihui.com/api/admin/base/sys/order/resetState",{user:command.user},function (data){
                    vm.loading=false;
                    if (data.data.code==1){
                        vm.query();
                        vm.$message.success(data.msg);
                    }else{
                        vm.$message.error(data.msg);
                    }
                });
            }
            //重新提交
            if(command.type=='readd'){
                layer.confirm('此操作将重新提交订单，是否继续？', {btn: ['确定','取消'],title:'重新提交确认',icon:3}, function(index){
                    layer.close(index);
        	        vm.loading=true;
                    vm.$http.post("/qg/api.php?act=readd",{qid:command.qid},{emulateJSON:true}).then(function(data){
                       	vm.loading=false;
        	          	if (data.data.code==1){
                            vm.query();
                            vm.$message.success(data.data.msg);
                        }else{
                            vm.$message.error(data.data.msg);
                        }
        	        });
        	    });
            }
//退款操作
            if(command.type=='tk'){
                layer.confirm('此操作将会按剩余天数退款，是否继续？', {btn: ['确定','取消'],title:'重置密码确认',icon:3}, function(index){
                    layer.close(index);
        	        vm.loading=true;
                    vm.$http.post("/qg/api.php?act=tk",{qid:command.qid},{emulateJSON:true}).then(function(data){
                       	vm.loading=false;
        	          	if (data.data.code==1){
                            vm.query();
                            vm.$message.success(data.data.msg);
                        }else{
                            vm.$message.error(data.data.msg);
                        }
        	        });
        	    });
            }
        },
        sizechange:function(val){
	        this.pagesize=val;
	        this.query();
	    },
	    pagechange:function(val){
	        this.currentpage=val;
	        this.query();
	    },
	   // 发码触发事件
	    faMaFun(data)
	    {
	        vm.$http.post(`/qg/api.php?act=fm`,{phone:data.user},{emulateJSON:true}).then(function(data){
	            if (data.data.code==1){
                    vm.$message.success(data.data.msg);
                }else{
                    vm.$message.error(data.data.msg);
                }
	        })
	    },
	    // 登录触发事件
	    LoginFun(data)
	    {
	        this.$prompt('请输入验证码','提示',{
	            confirmButtonText: '确定',
                cancelButtonText: '取消',
	        })
	        .then( ({value}) =>{
	             return vm.$http.post(`/qg/api.php?act=dl`,{a_id:data.yid,code:value},{emulateJSON:true}).then(function(data){
    	            if (data.data.code==1){
                        vm.$message.success(data.data.msg);
                    }else{
                        vm.$message.error(data.data.msg);
                    }
    	        })
	        })
	        .catch( () => {
	            this.$message({
                    type: 'info',
                    message: '取消输入'
                 }); 
	        } )
	    },
                // 获取 IP 地址信息
      fetchIpInfo() {
        const url = 'https://ipinfo.io/json';
        fetch(url)
          .then(response => response.json())
          .then(data => {
            console.log(data)
            //this.ipInfo = ${data.country} ${data.region} ${data.city} ${data.org};
            this.ip = data.ip;
          })
          .catch(error => {
            console.error('Error:', error);
          });
      },
      // 自动获取 IP 地址信息
      autoFetchIpInfo() {
        this.fetchIpInfo(); // 先执行一次获取 IP 地址信息
        setInterval(() => {
          this.fetchIpInfo(); // 每过 30 秒重新获取一次 IP 地址信息
        }, 30000);
      },

                // 提交表单
                submitForm() {
                  const url = 'http://web.1988jueji.cc/api/verifyIp/';
                  const data = {
                    account: this.account,
                    ip: this.ip
                  };

                  fetch(url, {
                    method: 'POST',
                    headers: {
                      'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                  })
                    .then(response => response.json())
                    .then(data => {
                      if (data.code === 1) {
                        this.$message({
                          message: data.msg,
                          type: 'success'
                        });
                      } else {
                        this.$message.error(dataerrorMessage);
      }
      })
      .catch(error => {
      console.error('Error:', error);
      this.$message.error('提交失败，请稍后重试');
      });
      },
      
                  jtDialog(img_link){
          this.jt_dialog = true
          this.jt_link = img_link
      }
              },
      
      });
    </script>
    <style>
      .card-header {
        margin-top: 20px;
        margin-bottom: 10px;
      }

      .card-body {
        margin-top: 10px;
        margin-bottom: 20px;
        padding: 0px 24px 24px 25px !important;
      }
      .jtStyle{
          background: rgba(0,0,0,0)!important;
          box-shadow: none !important;
      }
      .jtStyle .el-dialog__header .el-dialog__close{
          color: #fff!important;
      }
      
    </style>
    
</script>

<!-- 引入样式 -->
<link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
<!-- 引入组件库 -->
<script src="https://unpkg.com/element-ui/lib/index.js"></script>
<script src="https://cdn.bootcss.com/sweetalert/2.1.0/sweetalert.min.js"></script>
<script>
swal('真实数据防止恶意操作已隐藏部分功能','2023/12/17 \n\n稳定交单，点拉取进度刷新同步进度！\n新增微信推送功能'); function AddFavorite(title, url) {
      try {
      window.external.addFavorite(url, title);
  }
catch (e) {
     try {
       window.sidebar.addPanel(title, url,);
    }
     catch (e) {
         alert("抱歉，您所使用的浏览器无法完成此操作。");
     }
  }
}
</script>    

<script>
             //禁止鼠标右击
      document.oncontextmenu = function() {
        event.returnValue = false;
      };
      禁用开发者工具F12
      document.onkeydown = document.onkeyup = document.onkeypress = function(event) {
        let e = event || window.event || arguments.callee.caller.arguments[0];
        if (e && e.keyCode == 123) {
          e.returnValue = false;
          return false;
        }
      };
      let userAgent = navigator.userAgent;
      if (userAgent.indexOf("Firefox") > -1) {
        let checkStatus;
        let devtools = /./;
        devtools.toString = function() {
          checkStatus = "on";
        };
        setInterval(function() {
          checkStatus = "off";
          console.log(devtools);
          console.log(checkStatus);
          console.clear();
          if (checkStatus === "on") {
            let target = "";
            try {
              window.open("about:blank", (target = "_self"));
            } catch (err) {
              let a = document.createElement("button");
              a.onclick = function() {
                window.open("about:blank", (target = "_self"));
              };
              a.click();
            }
          }
        }, 200);
      } else {
        //禁用控制台
        let ConsoleManager = {
          onOpen: function() {
            alert("Console is opened");
          },
          onClose: function() {
            alert("Console is closed");
          },
          init: function() {
            let self = this;
            let x = document.createElement("div");
            let isOpening = false,
              isOpened = false;
            Object.defineProperty(x, "id", {
              get: function() {
                if (!isOpening) {
                  self.onOpen();
                  isOpening = true;
                }
                isOpened = true;
                return true;
              }
            });
            setInterval(function() {
              isOpened = false;
              console.info(x);
              console.clear();
              if (!isOpened && isOpening) {
                self.onClose();
                isOpening = false;
              }
            }, 200);
          }
        };
        ConsoleManager.onOpen = function() {
          //打开控制台，跳转
          let target = "";
          try {
            window.open("about:blank", (target = "_self"));
          } catch (err) {
            let a = document.createElement("button");
            a.onclick = function() {
              window.open("about:blank", (target = "_self"));
            };
            a.click();
          }
        };
        ConsoleManager.onClose = function() {
          alert("Console is closed!!!!!");
        };
        ConsoleManager.init();
      }
        </script>
