<?php
$title='运动世界';
include('head.php');
?>
<link href="css/element.css" rel="stylesheet">
<div id="content" class="wrapper-md control" role="main">
    <div class="app-content-body" style="padding: 15px;" id="yd">
        <div class="row">
            <el-card class="box-card">
                <div class="text item">
                    <!--<el-button type="primary" size="small" plain></el-button>-->
                    <?php if($userrow['uid']==1){?>
                    <el-button type="primary" size="small" @click="excel" plain>导出</el-button>
                         <?php }?>
                    搜索订单：<el-select class="frosss" v-model="cx.sru" style="width:100px;padding: 0;">
                    <el-option value="1" label="订单ID">订单ID</el-option>
                    <el-option value="2" label="学校">学校</el-option>
                    <el-option value="3" label="账号">账号</el-option>
                    </el-select>
                    <el-input v-model="cx.name" placeholder="请输入需要查询的对应内容" style="width:300px;padding: 0;"></el-input>
                    <el-select class="frosss" v-model="cx.status" style="width:100px;padding: 0;">
                    <el-option value label="所有">所有</el-option>
                    <el-option value="0" label="待处理">待处理</el-option>
                    <el-option value="1" label="已处理">已处理</el-option>
                    <el-option value="2" label="已退款">已退款</el-option>
                    </el-select>
                    <el-button type="primary" @click="query" plain>查询</el-button>
                    <div style="height:10px"></div>
                    <el-table id="table" v-loading="loading" element-loading-text="载入数据中" ref="multipleTable" :data="list" size="small" header-cell-style="text-align:center;font-weight:1500" cell-style="text-align:center" empty-text="啊哦！一条订单都没有哦！" @selection-change="selectoid" highlight-current-row border>
                    <el-table-column type="selection"></el-table-column>
                    <?php if($userrow['uid']==1){ ?><el-table-column label="操作" width="100" show-overflow-tooltip><template scope="scope"><el-button type="danger" style="width: 50px;height: 30px;padding: 0;" @click="tk(scope.row.id,scope.row.status)" v-if="scope.row.status!=2" round>退款</el-button><el-button type="primary" style="width: 75px;height: 35px;padding: 0;" @click="tkyy(scope.row.id,scope.row.status,scope.row.tktext)" v-else round>退款原因</el-button></template></el-table-column><?php } ?>
			        <el-table-column label="ID" property="id" width="60"></el-table-column>
			         <?php if($userrow['uid']==1){?> 
                    <el-table-column label="UID" property="uid" width="60"></el-table-column>
                    <?php }?>
                    <el-table-column label="状态" width="100" show-overflow-tooltip>
    			        <template scope="scope">
							<el-tag type="success" v-if="scope.row.status=='1'" effect="plain">
								已处理
							</el-tag>
							<el-tooltip content="点击查看退款原因" placement="top-start" v-else-if="scope.row.status=='2'">
							<el-tag type="info" effect="plain" @click="handleRefundClick(scope.row.tktext)">
								已退款
							</el-tag>
							</el-tooltip>
							<el-tag effect="plain" v-else @click="handleRefundClick(scope.row.tktext)">
								待处理
							</el-tag>
                        </template>
    			    </el-table-column>
    			    <el-table-column property="school" width="110" label="学校" show-overflow-tooltip></el-table-column>
    			    <el-table-column property="user" width="110" label="账号" show-overflow-tooltip></el-table-column>
    			    <el-table-column property="pass" width="110" label="密码" show-overflow-tooltip></el-table-column>
    			    <el-table-column label="开始时间" width="150" show-overflow-tooltip>
    			        <template scope="scope">
    			            {{scope.row.kstime}}
    			        </template>
    			    </el-table-column>
    			    <el-table-column property="ks_time_h" label="开始小时" width="110"></el-table-column>
    			    <el-table-column property="ks_time_m" label="开始分钟" width="110"></el-table-column>
    			    <el-table-column property="js_time_h" label="结束小时" width="110"></el-table-column>
    			    <el-table-column property="js_time_m" label="结束分钟" width="110"></el-table-column>
    			    <el-table-column property="week" label="周期" width="150"></el-table-column>
    			    <el-table-column property="km" label="总公里" width="60"></el-table-column>
    			    <el-table-column property="score" label="是否晨跑" width="100" show-overflow-tooltip>
    			        <template scope="scope">
							<el-tag v-if="scope.row.cp==1" effect="plain">
								晨跑
							</el-tag>
							<el-tag type="warning" effect="plain" v-else>
								不晨跑
							</el-tag>
                        </template>
    			    </el-table-column>
    			    <el-table-column property="addtime" label="下单时间" width="150" show-overflow-tooltip></el-table-column>
    			</el-table>
    			<el-divider></el-divider><!--<by TaoYao 分页>-->
                <el-pagination @size-change="sizechange" @current-change="pagechange" :current-page.sync="currentpage" :page-sizes="[10, 20, 50, 100, 200, 500]" :page-size="pagesize" layout="total,sizes, prev, pager, next, jumper" :total="pagecount">
                    </el-pagination>
                <el-divider></el-divider><!--<by TaoYao 分页>-->
                </div>
            </el-card>
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
<script src="js/excel.js"></script>
<script type="text/javascript">
var vm=new Vue({
	el:"#yd",
	data:{
	    cx:{
	        status:"",
	        user:"",
	        school:"",
	        name:"",
	        sru:"",
	    },
	    loading:false,loadings:false,
	    list:[],
	    sex:[],
	    currentpage:1,//默认在第几页
		pagesize:20,//每页显示的数量
		pagecount:100,//总数的默认值，后面会做调整，此数值无参考意义
	},
	methods:{
	    tk:function(id){
	        this.loading=true;
			this.$http.post("/apiyd.php?act=ydtk", {id:id}, {emulateJSON: true}).then(function(data) {
				this.loading=false;
				if (data.data.code == 1) {
				    this.query();
					this.$message.success(data.data.msg);
				} else {
					this.$message.error(data.data.msg);
				}
			});
	    },
	    changestauts:function(id,form){
	        this.loading=true;
			this.$http.post("/apiyd.php?act=ydchangestauts", {id:id,form:form}, {emulateJSON: true}).then(function(data) {
				this.loading=false;
				if (data.data.code == 1) {
				    this.query();
					this.$message.success(data.data.msg);
				} else {
					this.$message.error(data.data.msg);
				}
			});
	    },
	    selectoid:function(selection){
	        this.sex=[];
	        for(var i=0;selection.length>i;i++){
	            this.sex[i]=selection[i];
	        }
	        console.log(this.sex)
	    },
        sizechange:function(val){
	        this.pagesize=val;
	        this.query();
	    },
	    pagechange:function(val){
	        this.currentpage=val;
	        this.query();
	    },
	    handleRefundClick:function(text){
	        this.$alert(text, '退款原因', {
              confirmButtonText: '确定',

            });
	    },
	    tkyy:function(id,status,tktext){
		    if(status!=2){this.$message.error("[订单ID："+id+"] 还未退款，无法操作");return false;}
			this.$prompt('请输入退款原因', '你将为[订单ID：'+id+']填写退款原因', {
              confirmButtonText: '确定',
              cancelButtonText: '取消',
              inputValue:tktext,
            }).then(({ value }) => {
                this.$http.post("/apiyd.php?act=ydtkyy", {id:id,tkyy:value}, {emulateJSON: true}).then(function(data) {
				if (data.data.code == 1) {
				    this.query();
					this.$message.success(data.data.msg);
				} else {
					this.$message.error(data.data.msg);
				}
			});
            }).catch(() => {
              this.$message({
                type: 'info',
                message: '取消操作退款原因'
              });       
            });
		},
	    query:function(){
		    this.loading=true;
			data = {page:this.currentpage,size:this.pagesize,cx:this.cx};
			this.$http.post("/apiyd.php?act=query_yd", data, {emulateJSON: true}).then(function(data) {
				this.loading=false;
				if (data.data.code == 1) {
					this.pagecount=Number(data.body.count);
				    this.list=data.body.data;
				} else {
					this.$message.error(data.data.msg);
				}
			});
		},
		excel:function(){
		    var data=[["学校","账号","密码","公里数","开始-小时","开始-分钟","结束-小时","结束-分钟","跑步周天"]];
		    for(i in this.sex){
		        item=this.sex[i];
		        if(item.status==0){
		            data.push([
    		            item.school,
    		            item.user,
    		            item.pass,
    		            item.km,
    		            item.ks_time_h,
    		            item.ks_time_m,
    		            item.js_time_h,
    		            item.js_time_m,
    		            item.week
                    ]);
                }
		        
		    }
		    LAY_EXCEL.exportExcel(data, '订单数据.xlsx', 'xlsx');
	        this.$message.success("导出成功！文件下载中...");
		}
	},
	mounted() {
		this.query();
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