<?php
$title='copilot';
require_once('head.php');
$addsalt=md5(mt_rand(0,999).time());
$_SESSION['addsalt']=$addsalt;
?>
<!-- 引入样式 -->

<link rel="stylesheet" href="../sxdk/element/index.css">
<script src="https://cdn.bootcdn.net/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/vue/2.6.1/vue.js"></script>
<script src="https://cdn.staticfile.org/vue-resource/1.5.1/vue-resource.min.js"></script>
<script src="../sxdk/element/index.js"></script>
<link rel="stylesheet" href="//at.alicdn.com/t/c/font_3807157_95r8c8ifkoo.css" />
<div
	id="content"
	class="lyear-layout-content"
	role="main"
	style="padding-left: 5px; padding-top: 20px"
>
	<div class="app-content-body">
		<div class="wrapper-md control" id="app">
			<!-- 下单弹窗-->
			<el-dialog :title="edit?'修改订单':'添加订单'" :visible.sync="dialog" width="650px" :before-close="handleClose" size="mini">
				<el-form :model="form" :rules="addFormRules" ref="Form" label-width="120px">
					<el-form-item label="平台" prop="platform">
						<el-select v-model="form.platform" placeholder="请选择" size="mini" :disabled="edit">
							<el-option
								v-for="item in platFormList"
								:key="item.value"
								:label="item.label"
								@click.native="get_price(item.value)"
								:value="item.value"
							>
							</el-option>
						</el-select>
						<span style="color:#409eff;margin-left:10px;"> (单价：{{price}}/天)</span>
					</el-form-item>
					<el-form-item label="登录方式" v-if="form.platform=='xxt'" prop="loginType">
					    <el-switch
                          v-model="userSchool"
                          active-text="手机号"
                          inactive-text="学号"
                          active-color="#13ce66"
                          inactive-color="#13ce66"
                          @change="xxtLoginTypeChange"
                          >
					        
                        </el-switch>
				    </el-form-item>
					<!-- 学习通 -->
					<el-form-item v-if="form.platform=='xxt'&&!userSchool" label="学校" prop="schoolId" >
						<el-select v-model="form.schoolId" placeholder="请选择学校" size="mini" @change="(value)=>xxtschoolChange(value)" filterable remote :remote-method='xxtGetSchoolList' :loading="xxtgetSchoolLoading">
							<el-option
								v-for="item in xxtSchoolList"
								:key="item.value"
								:label="item.text"
								:value="item.value"
							>
							</el-option>
						</el-select>
					</el-form-item>
					
					<!-- 习讯云 -->
					<el-form-item v-if="form.platform=='xxy'" label="学校" prop="schoolId" >
						<el-select v-model="form.schoolId" placeholder="请选择学校" size="mini" @change="(value)=>xxyschoolChange(value)" filterable>
							<el-option
								v-for="item in xxySchoolList"
								:key="item.value"
								:label="item.text"
								:value="item.value"
							>
							</el-option>
						</el-select>
					</el-form-item>
					
					<el-form-item label="账号" prop="phone">
						<el-input v-model="form.phone" size="mini" :disabled="edit"></el-input>
					</el-form-item>
					<el-form-item label="密码" prop="password">
						<el-input v-model="form.password" size="mini"></el-input>
					</el-form-item>
					
					<el-form-item prop="autoInfo">
						<el-button @click="getPhoneInfo" size="mini" type="primary" :loading="getPhoneInfoLoading">获取打卡信息</el-button>
						<span style="color:#409eff;margin-left:10px;"> 别看表单多，输入账号密码点此按钮试试。</span>
					</el-form-item >
					<el-form-item label="姓名" prop="name">
						<el-input v-model="form.name" size="mini"></el-input>
					</el-form-item>
					<el-form-item label="岗位名称" prop="gwName" v-if="form.platform!='zxjy'">
						<el-input v-model="form.gwName" size="mini"></el-input>
					</el-form-item>
					<el-form-item label="岗位名称" prop="customizedGwName" v-if="form.platform=='zxjy'">
						<el-input v-model="form.customizedGwName" size="mini"></el-input>
					</el-form-item>
					<!-- 工学云/校友帮 -->
					<el-form-item label="国家" prop="country" v-if="form.platform=='gxy'||form.platform=='xyb'">
						<el-input v-model="form.country" size="mini"></el-input>
					</el-form-item>
					<!-- 工学云/校友帮/习讯云 -->
					<el-form-item label="省" prop="province" v-if="form.platform=='gxy'||form.platform=='xyb'||form.platform=='xxy'">
						<el-input v-model="form.province" size="mini"></el-input>
					</el-form-item>
					<!-- 工学云/校友帮/习讯云 -->
					<el-form-item label="市" prop="city" v-if="form.platform=='gxy'||form.platform=='xyb'||form.platform=='xxy'">
						<el-input v-model="form.city" size="mini"></el-input>
					</el-form-item>
					<!-- 工学云 -->
					<el-form-item label="区/县" prop="area" v-if="form.platform=='gxy'">
						<el-input v-model="form.area" size="mini"></el-input>
					</el-form-item>
					<!-- 校友帮 -->
					<el-form-item label="地区编码" prop="adcode" v-if="form.platform=='xyb'">
						<el-input v-model="form.adcode" size="mini"></el-input>
					</el-form-item>
					<!-- 职校家园/校友帮/学习通 -->
					<el-form-item label="公司地址" prop="addressOld" v-if="form.platform=='zxjy'||form.platform=='xyb'||form.platform=='xxy'||form.platform=='xxt'">
						<el-input v-model="form.addressOld" size="mini"></el-input>
					</el-form-item>
					<!-- 黔直通 -->
					<el-form-item label="公司地址" prop="officialAddress" v-if="form.platform=='qzt'">
						<el-input v-model="form.officialAddress" size="mini"></el-input>
					</el-form-item>
					<!-- 工学云 -->
					<el-form-item label="公司地址" prop="jobAddress" v-if="form.platform=='gxy'">
						<el-input v-model="form.jobAddress" size="mini"></el-input>
					</el-form-item>
					<el-form-item label="打卡地址" prop="address" v-if="form.platform!='xxy'">
						<el-input v-model="form.address" size="mini"></el-input>
					</el-form-item>
					<el-form-item label="打卡地址" prop="address" v-if="form.platform=='xxy'">
						<el-select v-model="form.address" placeholder="请选择打卡地点" size="mini" :disabled="edit" @change="(value)=>xxyCheckAddressChange(value)">
							<el-option
								v-for="item in xxyAddressPois"
								:key="item.textValue"
								:label="item.textValue"
								:value="item.value"
							>
							</el-option>
						</el-select>
					</el-form-item>
					<el-form-item label="经度" prop="lng">
						<el-input v-model="form.lng" size="mini"></el-input>
					</el-form-item>
					<el-form-item label="纬度" prop="lat">
						<el-input v-model="form.lat" size="mini"></el-input>
					</el-form-item>
					<!-- 职校家园 -->
					<el-form-item label="打卡时间" prop="check_time"  v-if="form.platform=='zxjy'">
						<el-time-picker placeholder="选择时间" v-model="form.check_time" value-format="HH:mm:ss" size="mini"></el-time-picker>
					</el-form-item>
					<el-form-item label="上班打卡时间" prop="up_check_time" v-if="form.platform!='zxjy'">
						<el-time-picker placeholder="选择时间" v-model="form.up_check_time" value-format="HH:mm:ss" size="mini"></el-time-picker>
					</el-form-item>
					<el-form-item label="上班打卡类型" prop="up_remark" v-if="form.platform=='xxy'">
						<el-select v-model="form.up_remark" placeholder="请选择上班打卡类型" size="mini" :disabled="edit">
							<el-option
								v-for="item in mark_list"
								:key="item.key"
								:label="item.value"
								:value="item.key"
							>
							</el-option>
						</el-select>
					</el-form-item>
					<el-form-item label="下班打卡" v-if="form.platform=='xxy'" prop="down_check">
						<el-switch
							v-model="formOther.down_check"
							size="mini"
							active-color="#13ce66"
							inactive-color="#DCDFE6">
						</el-switch>
					</el-form-item>
					<el-form-item label="下班打卡时间" prop="down_check_time" v-if="(form.platform=='qzt' || form.platform=='gxy' || formOther.down_check)&&form.platform!='zxjy'">
						<el-time-picker placeholder="选择时间" v-model="form.down_check_time" value-format="HH:mm:ss" size="mini"></el-time-picker>
					</el-form-item>
					<el-form-item label="下班打卡类型" prop="down_remark" v-if="form.platform=='xxy'&&formOther.down_check">
						<el-select v-model="form.down_remark" placeholder="请选择下班打卡类型" size="mini" :disabled="edit">
							<el-option
								v-for="item in mark_list"
								:key="item.key"
								:label="item.value"
								:value="item.key"
							>
							</el-option>
						</el-select>
					</el-form-item>
					<el-form-item label="打卡周期" prop="check_week">
						<el-checkbox-group v-model="form.check_week" size="mini">
							<el-checkbox label="0">周一</el-checkbox>
							<el-checkbox label="1">周二</el-checkbox>
							<el-checkbox label="2">周三</el-checkbox>
							<el-checkbox label="3" >周四</el-checkbox>
							<el-checkbox label="4" >周五</el-checkbox>
							<el-checkbox label="5" >周六</el-checkbox>
							<el-checkbox label="6" >周日</el-checkbox>
						</el-checkbox-group>
					</el-form-item>
					<el-form-item label="结束时间" prop="end_time" >
						<el-date-picker type="date" placeholder="选择日期" v-model="form.end_time" value-format="yyyy-MM-dd" size="mini"></el-date-picker>
						<span style="color:#409eff;margin-left:10px;"> 日期当天是最后一天打卡</span>
					</el-form-item>
					<el-form-item label="日报" prop="day_paper" v-if="form.platform!='qzt'">
						<el-switch
							v-model="form.day_paper"
							size="mini"
							active-color="#13ce66"
							inactive-color="#DCDFE6">
						</el-switch>
					</el-form-item>
					<el-form-item label="周报" prop="week_paper" >
						<el-switch
							v-model="form.week_paper"
							size="mini"
							active-color="#13ce66"
							inactive-color="#DCDFE6">
						</el-switch>
						
					</el-form-item>
					<!-- 职校家园/黔直通 -->
					<el-form-item label="周报提交时间" prop="weekPaperSubmitWeek">
						<el-input-number v-model="form.weekPaperSubmitWeek" :step="1" step-strictly size="mini" :max="7" :min="1"></el-input-number>
						<span style="color:#409eff;margin-left:10px;"> 周一到周七</span>
					</el-form-item>
					<el-form-item label="月报" prop="month_paper" >
						<el-switch
							v-model="form.month_paper"
							size="mini"
							active-color="#13ce66"
							inactive-color="#DCDFE6">
						</el-switch>
					</el-form-item>
					<!-- 职校家园/黔直通 -->
					<el-form-item label="月报提交时间" prop="monthPaperSubmitMonth">
						<el-input-number v-model="form.monthPaperSubmitMonth" :step="1" step-strictly size="mini" :max="28" :min="0"></el-input-number>
						<span style="color:#409eff;margin-left:10px;"> 0 代表为月底最后一天提交</span>
					</el-form-item>
					<el-form-item label="预计扣费" prop="yuji">
						<el-input v-model="yuji" readonly size="mini" v-if="!edit"></el-input>
						<el-input v-model="editYuji" readonly size="mini" v-else></el-input>
					</el-form-item>
				</el-form>
				<div slot="footer" class="dialog-footer">
					<el-button @click="dialog = false">取 消</el-button>
					<el-button type="primary" @click="add" :loading="addloading">{{edit?'修改':'添加'}}</el-button>
				</div>
			</el-dialog>
			<!-- 列表 -->
			<el-card class="box-card">
				<el-alert
					title="copilot ai 实习打卡，欢迎下单"
					type="success"
				></el-alert>
				<div style="height: 10px"></div>
				<?php if($userrow['uid']==1){ ?>
				<el-button type="warning" size="small" @click="update" :loading="updateLoading" plain
					>拉取进度</el-button
				>
				<?php } ?>
				<el-button type="warning" @click="()=>{dialog=true;edit=false;}" size="small" plain
					>提交订单</el-button
				>
				<el-button type="warning" @click="picUpload" size="small" plain
					>图片上传</el-button
				>
				<div style="height: 20px"></div>
				<el-input
					placeholder="模糊查询"
					v-model="cx.qq"
					class="input-with-select"
				>
					<el-select
						v-model="cx.search"
						style="width: 80px"
						placeholder="条件"
						slot="prepend"
					>
						
						<el-option label="账号" value="phone"></el-option>
						<el-option label="密码" value="password"></el-option>
						
					</el-select>
					<el-button slot="append" icon="el-icon-search" @click="query"
						>搜索</el-button
					>
				</el-input>
				<div style="height: 10px"></div>

				<div class="card-body">
					<el-table
						:data="tableData"
						v-loading="loading"
						element-loading-text="载入数据中"
						ref="multipleTable"
						size="small"
						empty-text="啊哦！一条订单都没有哦！"
						highlight-current-row
						border
					>
						<el-table-column type="index" label="序号" width="80">
						</el-table-column>
						<el-table-column label="操作" min-width="120">
							<template slot-scope="scope">
								<el-dropdown @command="handleCommand">
									<span class="el-dropdown-link">
										更多<i class="el-icon-arrow-down el-icon--right"></i>
									</span>
									<el-dropdown-menu slot="dropdown">
										<el-dropdown-item :command="{item:scope.row,type:'nowCheck'}">立即打卡</el-dropdown-item>
										<el-dropdown-item :command="{item:scope.row,type:'log'}">查看日志</el-dropdown-item>
										<el-dropdown-item :command="{item:scope.row,type:'changeCheckCode'}">{{scope.row.code==1?"暂停":"启动"}}</el-dropdown-item>
										<el-dropdown-item :command="{item:scope.row,type:'showErWeiMa'}">微信推送</el-dropdown-item>
										<el-dropdown-item :command="{item:scope.row,type:'editOrderInfo'}">编辑</el-dropdown-item>
										<el-dropdown-item :command="{item:scope.row,type:'del'}">删除</el-dropdown-item>
									</el-dropdown-menu>
								</el-dropdown>
							</template>
						</el-table-column>
						<el-table-column label="平台" width="100">
						<template slot-scope="scope">
								{{scope.row.platform=="zxjy"?"职校家园":
									scope.row.platform=="qzt"?"黔职通":
										scope.row.platform=="xyb"?"校友帮":
											scope.row.platform=="xxy"?"习讯云":
											    scope.row.platform=="xxt"?"学习通":
												    scope.row.platform=="gxy"?"工学云":"未知"
								
								}}
							</template>
						</el-table-column>
						<el-table-column prop="phone" label="账号" width="150">
						</el-table-column>
						<el-table-column prop="password" label="密码" width="150">
						</el-table-column>
						<el-table-column label="状态" width="80" show-overflow-tooltip>
							<template slot-scope="scope">
								<el-tag type="primary" v-if="scope.row.code==1">
									运行中
								</el-tag>
								<el-tag type="warning" v-else> 未运行 </el-tag>
							</template>
						</el-table-column>
						<el-table-column prop="name" label="姓名" width="80">
						</el-table-column>
						<el-table-column prop="address" label="打卡地址" width="250">
						</el-table-column>
						<el-table-column label="微信推送" width="100" show-overflow-tooltip>
							<template slot-scope="scope">
								<el-tag type="primary" v-if="scope.row.wxpush"> 已开启 </el-tag>
								<el-tag type="warning" v-else> 未开启 </el-tag>
							</template>
						</el-table-column>
						<el-table-column
							
							label="上班打卡时间"
							width="120"
						>
							<template slot-scope="scope">
								{{scope.row.check_time||scope.row.up_check_time}}
							</template>
						</el-table-column>
						<el-table-column
							prop="down_check_time"
							label="下班打卡时间"
							width="120"
						>
						</el-table-column>
						<el-table-column label="打卡周期" width="180">
							<template slot-scope="scope">
								<el-tag type="success" v-if='scope.row.check_week.indexOf("0") > -1'>周一</el-tag>
								<el-tag type="success" v-if='scope.row.check_week.indexOf("1") > -1'>周二</el-tag>
								<el-tag type="success" v-if='scope.row.check_week.indexOf("2") > -1'>周三</el-tag>
								<el-tag type="success" v-if='scope.row.check_week.indexOf("3") > -1'>周四</el-tag>
								<el-tag type="success" v-if='scope.row.check_week.indexOf("4") > -1'>周五</el-tag>
								<el-tag type="success" v-if='scope.row.check_week.indexOf("5") > -1'>周六</el-tag>
								<el-tag type="success" v-if='scope.row.check_week.indexOf("6") > -1'>周日</el-tag>
								
							</template>
						</el-table-column>
						<el-table-column label="报告" width="180">
							<template slot-scope="scope">
								<el-tag type="success" v-if='scope.row.day_paper==1'>日报</el-tag>
								<el-tag type="success" v-if='scope.row.week_paper==1'>周报</el-tag>
								<el-tag type="success" v-if='scope.row.month_paper==1'>月报</el-tag>
								
							</template>
						</el-table-column>
						<el-table-column prop="end_time" label="到期时间" width="120">
						</el-table-column>
						<el-table-column prop="createTime" label="创建时间" width="150">
						</el-table-column>
						
					</el-table>
					<el-divider></el-divider
					><!--<by TaoYao 分页>-->
					<el-pagination
						@size-change="sizechange"
						@current-change="pagechange"
						:current-page.sync="currentpage"
						:page-sizes="[10, 20, 50, 100, 200, 500]"
						:page-size="pagesize"
						layout="total,sizes, prev, pager, next, jumper"
						:total="pagecount"
					>
					</el-pagination>
					<el-divider></el-divider
					><!--<by TaoYao 分页>-->
				</div>
			</el-card>
		</div>
	</div>
	<script>
		var vm = new Vue({
			el: "#app",
			data() {
				return {
					loading: false,
					addloading: false,
					getPhoneInfoLoading:false,
					updateLoading:false,
					xxtgetSchoolLoading:false,
					currentpage: 1, //默认在第几页
					pagesize: 20, //每页显示的数量
					pagecount: 100, //总数的默认值，后面会做调整，此数值无参考意义
					price: 0,
					dialog: false,
					edit:false,
					userSchool:true,
					form: { 
						id: 0, //id                          
						platform:"zxjy",  //平台                 
						school:"",//学校
						schoolId:"",//学校id
						url:"",//学校私立服务器
						addressName:"",//习讯云地址名称
						up_remark:0,//上班打卡类型
						down_remark:8,//下班打卡类型
						phone:"",  //手机号                  
						password:"" ,//密码
						name:"",//姓名
						gwName:"",//岗位名称
						customizedGwName:"",
						phone_name:"HUAWEI|HUAWEIELE AL00|11",//手机型号            职校家园
						country: "中国",//国家              工学云 校友帮
						province: "",//省市                 工学云 校友帮
						city: "",//县                       工学云 校友帮
						area: "",//区县                     工学云
						adcode: "",//地区编码               校友帮
						addressOld:"",//公司地址            职校家园 校友帮
						officialAddress: "",//公司地址      黔职通
						jobAddress: "",//公司地址           工学云
						address:"",//打卡地址
						lat:"",//经纬度
						lng:"",//经纬度
						reason: "",//打卡备注               校友帮
						desctext: "",//打卡备注             工学云
						randomLocation: true,//浮动打卡     工学云
						check_time:"",//打卡时间            职校家园
						up_check_time:"",//上班打卡时间     
						down_check_time:"",//下班打卡时间
						check_week:[],//打卡周期
						end_time: "",//结束时间
						wxpush: "",//微信推送
						day_paper:false,//日报开关
						week_paper:false,//周报开关
						month_paper:false,//月报开关
						weekPaperSubmitWeek: 7,//周报提交时间     职校家园
						monthPaperSubmitMonth: 0,//月报提交时间   黔直通
						paper_router: 2,//报告库选择
						payType: 0,//一次新订单
					},
					cx: { qq: "", search: "phone" },
					platFormList: [
						{
							value: "zxjy",
							label: "职校家园",
						},
						{
							value: "qzt",
							label: "黔职通",
						},
						{
							value: "gxy",
							label: "工学云",
						},
						{
							value: "xyb",
							label: "校友帮",
						},
						{
							value: "xxy",
							label: "习迅云",
						},
						{
							value: "xxt",
							label: "学习通",
						},
					],
					formOther:{
						down_check:false,
					},
					addFormRules: {
						platform: [
							{ required: true, message: '请选择打卡平台', trigger: 'blur' },
						],
						schoolId: [
							{ required: true, message: '请选择学校', trigger: 'blur' }
						],
						phone: [
							{ required: true, message: '请输入打卡账号', trigger: 'blur' }
						],
						password: [
							{ required: true, message: '请输入打卡密码', trigger: 'blur' }
						],
						country: [
							{ required: true, message: '请输入国家', trigger: 'blur' }
						],
						province: [
							{ required: true, message: '请输入省份', trigger: 'blur' }
						],
						city: [
							{ required: true, message: '请输入区/县', trigger: 'blur' }
						],
						area: [
							{ required: true, message: '请输入区/县', trigger: 'blur' }
						],
						adcode: [
							{ required: true, message: '请输入地区编码', trigger: 'blur' }
						],
						addressOld: [
							{ required: true, message: '请输入公司地址', trigger: 'blur' }
						],
						officialAddress: [
							{ required: true, message: '请输入打卡地址', trigger: 'blur' }
						],
						jobAddress: [
							{ required: true, message: '请输入打卡地址', trigger: 'blur' }
						],
						address: [
							{ required: true, message: '请输入打卡地址', trigger: 'blur' }
						],
						lat: [
							{ required: true, message: '请输入纬度', trigger: 'blur' }
						],
						lng: [
							{ required: true, message: '请输入经度', trigger: 'blur' }
						],
						check_time: [
							{  required: true, message: '请选择时间', trigger: 'change' }
						],
						up_check_time: [
							{required: true, message: '请选择时间', trigger: 'change' }
						],
						down_check_time: [
							{ required: true, message: '请选择时间', trigger: 'change' }
						],
						check_week: [
							{ type: 'array', required: true, message: '请至少选择一个打卡日期', trigger: 'change' }
						],
						end_time: [
							{ required: true, message: '请选择日期', trigger: 'change' }
						],
					},
					tableData: [
						
					],
					xxySchoolList:[
					
					],
					xxtSchoolList:[],
					xxyAddressPois:[],
					mark_list: [
						{
							key: 0,
							value: "上班",
						},
						{
							key: 1,
							value: "因公外出",
						},
						{
							key: 2,
							value: "假期",
						},
						{
							key: 3,
							value: "请假",
						},
						{
							key: 4,
							value: "轮岗",
						},
						{
							key: 5,
							value: "回校",
						},
						{
							key: 6,
							value: "外宿",
						},
						{
							key: 7,
							value: "在家",
						},
						{
							key: 8,
							value: "下班",
						},
						{
							key: 9,
							value: "学习",
						},
						{
							key: 10,
							value: "毕业设计",
						},
						{
							key: 11,
							value: "院区轮转",
						},
						{
							key: 13,
							value: "集训",
						},
					],
				};
			},
			beforeMount(){
				
			},
			mounted() {
				this.get_price();
				this.query();
				this.xxyGetSchoolList()
			},
			computed: {
				yuji: function () {
					if(this.form.end_time&&this.form.check_week.length>0){
						let day=this.timeCalcTrueday(new Date().getTime(),this.form.end_time,this.form.check_week)
						return (this.price*day).toFixed(2) + "元";
					}else{
						return "0元"
					}
					
				},
				editYuji:function(){
					if(this.form.end_time&&this.form.old_end_time&&this.edit&&this.form.check_week.length>0){
						let oldsjc=new Date(this.form.old_end_time + " 23:59:59").getTime();//01-01
						let tadysjc=new Date().getTime();//02-27
						let endSjc = new Date(this.form.end_time + " 23:59:59").getTime();//12-27
						let day;
						if (tadysjc>=oldsjc&&tadysjc<endSjc){
						    //订单已过期
						    let newDay=this.timeCalcTrueday(new Date().getTime(),this.form.end_time,this.form.check_week)
						    day=newDay;
						}else{
						    //订单未过期
						    let nowsjc=oldsjc;//01-01
						    
    						if (endSjc<=nowsjc&&this.form.old_check_week.length<=this.form.check_week){
    							return "0元"
    						}
    						let oldDay=this.timeCalcTrueday(new Date().getTime(),this.form.old_end_time,this.form.old_check_week)
    						let newDay=this.timeCalcTrueday(new Date().getTime(),this.form.end_time,this.form.check_week)
    						day=newDay-oldDay;
						}
						
						if(day<0){
							return "0元"
						}
						return (this.price*day).toFixed(2) + "元";
					}else{
						return "0元"
					}
				}
			},
			methods: {
				//计算输入日期距离当前日期的天数差-仅计算传入参数二数组包含的周几天数
				timeCalcTrueday(nowsjc,end_time, check_week){
					if (check_week) {
						// 打卡周期0-6排序
						check_week.sort(function (a, b) {
							return a - b;
						});
						// 获取当前时间戳
						// let nowsjc = new Date().getTime();
						// 获取当前周几
						let nowWeekDay = this.getDayOfWeek(nowsjc);
						// 获取结束时间戳
						let endSjc = new Date(end_time + " 23:59:59").getTime();
						// 获取当前周周末时间戳
						let weekEndSjc = new Date(
							this.format(nowsjc + (6 - nowWeekDay) * 86400 * 1000) + " 23:59:59"
						).getTime();
						//获取本周大于等于今天周几的天数，且在打卡周期内的
						let nowWeekLast = check_week.filter((item) => {
							return Number(item) >= nowWeekDay;
						});
						//获取结束当天周几
						let endWeekDay = this.getDayOfWeek(endSjc);
						//判断结束时间戳是否小于等于本周周末时间戳
						if (endSjc <= weekEndSjc) {
							//结束时间在本周内
							//通过打卡周期内本周大于今天周几的数组，来获取结束日期前的周几数组
							let lastWeekLast = nowWeekLast.filter((item) => {
								return Number(item) <= endWeekDay;
							});
							//返回本周可打卡天数
							return lastWeekLast.length;
						} else {
							//结束时间不在本周内
							//获取结束周小于等于结束时间周几的天数，且在打卡周期内
							let endWeekLast = check_week.filter((item) => {
								return Number(item) <= endWeekDay;
							});
							//获取整周总时间戳
							let intSjc = endSjc - (endWeekDay + 1) * 86400 * 1000 - weekEndSjc;
							//返回本周打卡周期内天数+整周打卡周期内天数+结束周打卡周期内天数
							return (
								nowWeekLast.length +
								(intSjc / 7 / 86400 / 1000) * check_week.length +
								endWeekLast.length
							);
						}
					}
				},
				//获取指定时间戳是周几
				getDayOfWeek(timestamp) {
					let date = new Date(timestamp);
					let dayOfWeek = date.getDay();

					let weekdays = [7, 1, 2, 3, 4, 5, 6];

					return weekdays[dayOfWeek] - 1;
				},
				//将时间戳转换为年月日时间
				format(dataString) {
					//dataString是整数，否则要parseInt转换
					var time = new Date(dataString);
					var year = time.getFullYear();
					var month = time.getMonth() + 1;
					var day = time.getDate();

					return (
						year +
						"-" +
						(month < 10 ? "0" + month : month) +
						"-" +
						(day < 10 ? "0" + day : day)
					);
				},
				resetForm(){
					this.form={ 
						id: 0, //id                          
						platform:"zxjy",  //平台                 
						school:"",//学校
						schoolId:"",//学校id
						url:"",//学校私立服务器
						addressName:"",//习讯云地址名称
						up_remark:0,//上班打卡类型
						down_remark:8,//下班打卡类型
						phone:"",  //手机号                  
						password:"" ,//密码
						name:"",//姓名
						gwName:"",//岗位名称
						customizedGwName:"",
						phone_name:"HUAWEI|HUAWEIELE AL00|11",//手机型号            职校家园
						country: "中国",//国家              工学云 校友帮
						province: "",//省市                 工学云 校友帮
						city: "",//县                       工学云 校友帮
						area: "",//区县                     工学云
						adcode: "",//地区编码               校友帮
						addressOld:"",//公司地址            职校家园 校友帮
						officialAddress: "",//公司地址      黔职通
						jobAddress: "",//公司地址           工学云
						address:"",//打卡地址
						lat:"",//经纬度
						lng:"",//经纬度
						reason: "",//打卡备注               校友帮
						desctext: "",//打卡备注             工学云
						randomLocation: true,//浮动打卡     工学云
						check_time:"",//打卡时间            职校家园
						up_check_time:"",//上班打卡时间     
						down_check_time:"",//下班打卡时间
						check_week:[],//打卡周期
						end_time: "",//结束时间
						wxpush: "",//微信推送
						day_paper:false,//日报开关
						week_paper:false,//周报开关
						month_paper:false,//月报开关
						weekPaperSubmitWeek: 7,//周报提交时间     职校家园
						monthPaperSubmitMonth: 0,//月报提交时间   黔直通
						paper_router: 2,//报告库选择
						payType: 0,//一次新订单
					},
					this.formOther.down_check=false

				},
				picUpload(){
					this.$confirm(`支持平台：<br/>黔直通(支持：打卡、立即打卡、周报、月报、补报告)<br/>习讯云(打卡、立即打卡、日报、周报、月报)<br/>工学云/蘑菇钉(打卡、立即打卡、日报、周报、月报)<br/><br/>每使用一张删除一张，图片可上传储备。<p style='color:red'>图片数据库网址：http://58.18.98.250:4000/#/picDatabases</p>`, '打卡图片上传', {
						distinguishCancelAndClose: true,
						dangerouslyUseHTMLString:true,
						confirmButtonText: '跳转',
						cancelButtonText: '取消'
					})
					.then(() => {
						window.open('http://58.18.98.250:4000/#/picDatabases', "_blank");
					})
					.catch(action => {
						
					});
				},
				xxyschoolChange(value){
					let checkSchools=this.xxySchoolList.filter((item)=>{
						return item.value==value
					})
					if (checkSchools.length>0){
						checkSchool=checkSchools[0]
						this.form.school=checkSchool.text
						this.form.url=checkSchool.url
						this.form.schoolId=checkSchool.value
					}else{
						this.$message.error("不存在的学校");
						this.form.school=""
						this.form.url=""
						this.form.schoolId=""
					}
				},
				xxyCheckAddressChange(value){
					let checkAddresss=this.xxyAddressPois.filter((item)=>{
						return item.value==value
					})
					if (checkAddresss.length>0){
						checkAddress=checkAddresss[0]
						this.form.address=checkAddress.value
						this.form.addressName=checkAddress.addressName
						this.form.lat=checkAddress.lat
						this.form.lng=checkAddress.lng
					}else{
						this.$message.error("不存在的地址");
					}
				},
				xxtschoolChange(value){
					let checkSchools=this.xxtSchoolList.filter((item)=>{
						return item.value==value
					})
					if (checkSchools.length>0){
						checkSchool=checkSchools[0]
						this.form.school=checkSchool.text
						this.form.schoolId=checkSchool.value
					}else{
						this.$message.error("不存在的学校");
						this.form.school=""
						this.form.schoolId=""
					}
				},
				xxtLoginTypeChange(value){
				    if(value){
				        this.form.schoolId=""
				        this.form.school=""
				        
				    }
				},
				handleCommand:async function(data){
					if(data.type=="log"){
						this.getLog(data.item)
					}
					if(data.type=="del"){
						this.deleteOrder(data.item)
					}
					if(data.type=="nowCheck"){
						this.nowCheck(data.item)
					}
					if(data.type=="changeCheckCode"){
						this.changeCheckCode(data.item)
					}
					if(data.type=="showErWeiMa"){
						this.getWxPush(data.item)
					}
					if(data.type=="editOrderInfo"){
						
						let sourceOrder=await this.querySourceOrder(data.item)
						if (sourceOrder){
							this.form={
								...sourceOrder,
								platform:data.item.platform,
							}
							this.form.id=data.item.id
							this.form.old_end_time = sourceOrder.end_time;
							this.form.old_check_week = sourceOrder.check_week.split(",");
							this.form.check_week = sourceOrder.check_week.split(",");
							this.form.day_paper = sourceOrder.day_paper == 1;
							this.form.week_paper = sourceOrder.week_paper == 1;
							this.form.month_paper = sourceOrder.month_paper == 1;
							this.form.weekPaperSubmitWeek = sourceOrder.weekPaperSubmitWeek + 1;
							if(sourceOrder.down_check_time){
								this.formOther.down_check=true
							}
							
							this.edit=true;
							this.dialog=true;
						}
						
					}
				},
				getPhoneInfo: function () {
					this.getPhoneInfoLoading=true
					this.$http
						.post(
							"/sxdk/api.php?act=searchPhoneInfo",
							{
								...this.form
							},
							{ emulateJSON: true }
						)
						.then((res) => {
							if(res.data.code==0){
								
								if(this.form.platform=="zxjy"){
									this.form.name=res.data.data.name
									this.form.address=res.data.data.address
									this.form.gwName=res.data.data.gwName
									this.form.customizedGwName=res.data.data.gwName
									this.form.lat=res.data.data.lat
									this.form.lng=res.data.data.lng
									this.form.addressOld=res.data.data.addressOld
									this.$message.success(res.data.msg+"\n地址、经纬度自动配置成功");
								}else if(this.form.platform=="qzt"){
									this.form.name = res.data.data.name;
									this.form.up_check_time = res.data.data.checkInTime;
									this.form.down_check_time = res.data.data.checkOutTime;
									this.form.end_time = res.data.data.endTime;
									this.form.lng = res.data.data.longitude;
									this.form.lat = res.data.data.latitude;
									this.form.officialAddress = res.data.data.address;
									this.form.address = res.data.data.officialAddress;
									this.form.gwName = res.data.data.gwName;
									let weekList = res.data.data.weekList.split(",");
									weekList = weekList.map((item) => {
										if (Number(item) > 1) {
											return (Number(item) - 2).toString();
										} else if (Number(item) == 1) {
											return "6";
										}
									});
									this.form.check_week = weekList;
									this.$message.success(res.data.msg+"\n上下班打卡时间、实习结束时间、打卡周期、地址、经纬度自动配置成功");
								}else if(this.form.platform=="gxy"){
									this.form.name = res.data.data.name;
									this.form.gwName = res.data.data.jobName;
									this.form.lng = res.data.data.lng;
									this.form.lat = res.data.data.lat;
									this.form.jobAddress = res.data.data.jobAddress;
									this.form.address = res.data.data.address;
									this.form.province = res.data.data.jobProvince;
									this.form.city = res.data.data.jobCity;
									this.form.area = res.data.data.jobArea;
									this.$message.success(res.data.msg+"\n地址、经纬度自动配置成功");
								}else if(this.form.platform=="xyb"){
									this.form.addressOld = res.data.data.addressOld;
									this.form.address = res.data.data.address;
									this.form.lng = res.data.data.lng;
									this.form.lat = res.data.data.lat;
									this.form.adcode = res.data.data.adcode;
									this.form.province = res.data.data.province;
									this.form.country = res.data.data.country;
									this.form.city = res.data.data.city;
									this.form.day_paper = res.data.data.checkOrder.needDailyBlogs;
									this.form.week_paper = res.data.data.checkOrder.needWeeklyBlogs;
									this.form.month_paper = res.data.data.checkOrder.needMonthlyBlogs;
									this.form.gwName = res.data.data.checkOrder.gwName;
									this.form.name = res.data.data.checkOrder.name;
									if (res.data.data.checkOrder.clockRuleType == 1) {
										this.formOther.down_check = true;
										this.$confirm('官方信息获取成功，该账号需要进行下班打卡，请不要忘记设置。', '提示', {
											confirmButtonText: '确定',
											cancelButtonText: '取消',
											type: 'warning'
										}).then(() => {
											this.$message.success(res.data.msg+"\n日周月报、地址、经纬度自动配置成功");
										}).catch(() => {
											this.$message.success(res.data.msg+"\n日周月报、地址、经纬度自动配置成功");
										});
										
									} else {
										this.form.down_check_time = "";
										this.formOther.down_check = false;
										this.$confirm('官方信息获取成功，该账号无需进行下班打卡。', '提示', {
											confirmButtonText: '确定',
											cancelButtonText: '取消',
											type: 'warning'
										}).then(() => {
											this.$message.success(res.data.msg+"\n日周月报、地址、经纬度自动配置成功");
										}).catch(() => {
											this.$message.success(res.data.msg+"\n日周月报、地址、经纬度自动配置成功");
										});
									}
									
								}else if(this.form.platform=="xxy"){
									this.form.name = res.data.data.name;
									this.form.lng = res.data.data.lng;
									this.form.lat = res.data.data.lat;
									this.form.province = res.data.data.province;
									this.form.city = res.data.data.city;
									this.form.addressOld = res.data.data.addressOld;
									this.form.gwName = res.data.data.gwName;
									this.form.city = res.data.data.city;
									this.form.day_paper = res.data.data.day_paper;
									this.form.week_paper = res.data.data.week_paper;
									this.form.month_paper = res.data.data.month_paper;
									this.xxyAddressPois=res.data.data.addressPois.map((item) => {
										return {
											...item,
											textValue: item.value + item.text,
										};
									});
									if (res.data.data.addressPois.length > 0) {
										this.form.address = res.data.data.address;
										this.form.addressName = res.data.data.addressName;
									}
									this.$message.success(res.data.msg+"\n日周月报、地址、经纬度自动配置成功");
								}else if(this.form.platform=="xxt"){
									this.form.name = res.data.data.name;
									this.form.lng = res.data.data.lng;
									this.form.lat = res.data.data.lat;
									this.form.address = res.data.data.address;
									this.form.addressOld = res.data.data.addressOld;
									this.form.gwName = res.data.data.gwName;
									this.form.day_paper = res.data.data.day_paper;
									this.form.week_paper = res.data.data.week_paper;
									this.form.month_paper = res.data.data.month_paper;
									if(res.data.data.up_check_time&&res.data.data.down_check_time){
									    this.formOther.down_check = true;
									    this.form.up_check_time = res.data.data.up_check_time;
									    this.form.down_check_time = res.data.data.down_check_time;
									    this.$message.success(res.data.msg+"\n日周月报、地址、经纬度,上下班打卡时间自动配置成功");
									}else{
									    this.form.down_check_time = "";
										this.formOther.down_check = false;
									    this.$message.success(res.data.msg+"\n日周月报、地址、经纬度自动配置成功，无需下班打卡");
									}
									
									
									
								}else{
									this.$message.error("未匹配到项目");
								}

								
							}else{
								this.$message.error(res.data.msg);
							}
							this.getPhoneInfoLoading=false
						}).catch((e)=>{
							this.$message.error("网络错误，超时");
							this.getPhoneInfoLoading=false
						});
				},
				query: function () {
					this.loading = true;
					data = { cx: this.cx, page: this.currentpage, size: this.pagesize };
					this.$http
						.post("/sxdk/api.php?act=order", data, { emulateJSON: true })
						.then(function (data) {
							this.loading = false;
							if (data.data.code == "0") {
								this.pagecount = Number(data.body.count);
								this.tableData = data.body.data;
							} else {
								this.$message.error(data.data.msg);
							}
						});
				},
				get_price(id) {
					if(this.form.platform=="xyb"||this.form.platform=="zxjy"||this.form.platform=="xxy"||this.form.platform=="xxt"){
						this.formOther.down_check=false
						this.form.down_check_time=""
					}else{
						this.formOther.down_check=true
						this.form.down_check_time=""
					}
					this.$http
						.post(
							"/sxdk/api.php?act=price",
							{ platform: this.form.platform },
							{ emulateJSON: true }
						)
						.then(function (data) {
							this.price = data.data.data;
						});
				},
				add: function () {
					this.$refs["Form"].validate((valid) => {
						if (valid) {
					
							this.addloading = true;
							if(this.edit){
								this.$http.post(
								"/sxdk/api.php?act=edit",
								{ 
									form: {
										...this.form,
										check_week: this.form.check_week.join(","),
										day_paper: this.form.day_paper ? 1 : 2,
										week_paper: this.form.week_paper ? 1 : 2,
										month_paper: this.form.month_paper ? 1 : 2,
										weekPaperSubmitWeek: this.form.weekPaperSubmitWeek - 1,
										randomLocation: this.form.randomLocation ? 1 : 2,
									} 
								},
								{ emulateJSON: true }
								)
								.then(function (data) {
									this.addloading = false;
									this.query();
									if (data.data.code == 0) {
										vm.$message.success(data.data.msg);
										this.resetForm()
										this.dialog = false;
										
									} else {
										vm.$message.error(data.data.msg);
									}
								});
							}else{
								this.$http.post(
									"/sxdk/api.php?act=add",
								{ 
									form: {
										...this.form,
										check_week: this.form.check_week.join(","),
										day_paper: this.form.day_paper ? 1 : 2,
										week_paper: this.form.week_paper ? 1 : 2,
										month_paper: this.form.month_paper ? 1 : 2,
										weekPaperSubmitWeek: this.form.weekPaperSubmitWeek - 1,
										randomLocation: this.form.randomLocation ? 1 : 2,
									} 
								},
								{ emulateJSON: true }
								)
								.then(function (data) {
									this.addloading = false;
									this.query();
									if (data.data.code == 0) {
										vm.$message.success(data.data.msg);
										this.resetForm()
										this.dialog = false;
										
									} else {
										vm.$message.error(data.data.msg);
									}
								});
								}
							
						} else {
							this.$message.error("请填写全部必写内容");
							console.log('error submit!!');
							return false;
						}
					});
					
				},
				sizechange: function (val) {
					this.pagesize = val;
					this.query();
				},
				pagechange: function (val) {
					this.currentpage = val;
					this.query();
				},
				handleClose:function(done){
					this.resetForm()
					done();
				},

				deleteOrder:function(item){
					this.$confirm(`确定要删除订单：${item.phone}`, '删除警告', {
						distinguishCancelAndClose: true,
						confirmButtonText: '删除',
						cancelButtonText: '取消'
					})
					.then(() => {
						this.$http.post(
							"/sxdk/api.php?act=del",
							{ 
								...item
							},
							{ emulateJSON: true }
						)
						.then(function (data) {
							this.query();
							if (data.data.code == 0) {
								vm.$message.success(data.data.msg);
							} else {
								vm.$message.error(data.data.msg);
							}
						});
					})
					.catch(action => {
						
					});
					
				},
				getLog:function(item){
					this.$http.post(
							"/sxdk/api.php?act=getLog",
							{ 
								...item
							},
							{ emulateJSON: true }
						)
						.then(function (data) {
							if (data.data.code == 0) {
								let htmlText=data.data.data.map((i)=>{
									return `<p>时间：${i.logTime}<br/>类型：${i.logType}<br/>内容：${i.logText}</p><hr/>`
								}).join("")
								this.$alert(htmlText, `${item.phone}的最近10条日志`, {
									dangerouslyUseHTMLString: true
								});
							} else {
								vm.$message.error(data.data.msg);
							}
						});
				},
				nowCheck:function(item){
					this.$confirm(`账号：${item.phone}，现在要立即打卡么？打卡成功将会扣除该项目一天的余额`, '立即打卡提示', {
						distinguishCancelAndClose: true,
						confirmButtonText: '立即打卡',
						cancelButtonText: '取消'
					})
					.then(() => {
						this.$http.post(
							"/sxdk/api.php?act=nowCheck",
							{ 
								...item
							},
							{ emulateJSON: true }
						)
						.then(function (data) {
							this.query();
							if (data.data.code == 0) {
								vm.$message.success(data.data.msg);
							} else {
								vm.$message.error(data.data.msg);
							}
						});
					})
					.catch(action => {
						
					});
					
				},
				changeCheckCode:function(item){
					this.$confirm(`账号：${item.phone}，是否要${item.code==2?'启动':'暂停'}订单？`, `${item.code==2?'启动':'暂停'}订单`, {
						distinguishCancelAndClose: true,
						confirmButtonText: `${item.code==2?'启动':'暂停'}`,
						cancelButtonText: '取消'
					})
					.then(() => {
						this.$http.post(
							"/sxdk/api.php?act=changeCheckCode",
							{ 
								...item
							},
							{ emulateJSON: true }
						)
						.then(function (data) {
							this.query();
							if (data.data.code == 0) {
								vm.$message.success(data.data.msg);
							} else {
								vm.$message.error(data.data.msg);
							}
						});
					})
					.catch(action => {
						
					});
				},
				getWxPush:function(item){
					this.$http.post(
							"/sxdk/api.php?act=getWxPush",
							{ 
								...item
							},
							{ emulateJSON: true }
						)
						.then(function (data) {
							if (data.data.code == 0) {
								let htmlText=`<img src='${data.data.data.url}' style='width:350px;height:350px'/>`
								this.$alert(htmlText, `${item.phone}的微信推送`, {
									dangerouslyUseHTMLString: true
								});
							} else {
								vm.$message.error(data.data.msg);
							}
						});
				},
				async querySourceOrder(item){
					let res=await this.$http.post(
							"/sxdk/api.php?act=querySourceOrder",
							{ 
								form: item,
									
							},
							{ emulateJSON: true }
						);
						if (res.data.code == 0) {
								return res.data.data;
							} else {
								vm.$message.error(res.data.msg);
								return false;
							}
						
				},
				update(){
				    this.updateLoading=true
					 this.$http.post(
							"/sxdk/api.php?act=yunOrder",
							{ 
								
									
							},
							{ emulateJSON: true }
						).then((res)=>{
							if (res.data.code == 0) {
								vm.$message.success(res.data.msg);
							} else {
								vm.$message.error(res.data.msg);
								
							}
							this.updateLoading=false
						})
						
				},
				xxyGetSchoolList(){
					this.$http.post(
							"/sxdk/api.php?act=xxyGetSchoolList",
							{},
							{ emulateJSON: true }
						)
						.then(function (data) {
							if (data.data.code == 20000) {
								data.data.data.forEach((par) => {
									par.schools.forEach((item) => {
										this.xxySchoolList.push({
											text: item.school_name,
											value: item.school_id,
											url: item.differ_api,
										});
									});
								});
								// console.log(this.xxySchoolList)
							} else {
								vm.$message.error("学校列表加载失败，请向上级反馈");
							}
						});
				},
				xxtGetSchoolList(value){
				    this.xxtgetSchoolLoading=true
					this.$http.post(
							"/sxdk/api.php?act=xxtGetSchoolList",
							{
							    filter:value
							},
							{ emulateJSON: true }
						)
						.then(function ({data}) {
						    console.log(data)
							if (data.result) {
                    			this.xxtSchoolList = data.froms.map((item) => {
                    				return {
                    					text: item.name,
                    					value: item.schoolid,
                    				};
                    			});
                    			console.log(this.xxtSchoolList)
                    		} else {
                    		    this.xxtSchoolList=[]
								vm.$message.error("请输入正确的学校名称");
							}
							this.xxtgetSchoolLoading=false
						});
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
		}
		.el-form-item{
			margin-bottom:15px;
		}
		.el-form-item__label{
			line-height:30px;
			}
		.el-form-item__content{
				line-height:30px;
		}
		.el-form-item__error{
			padding-top:0;
		}
		.el-dialog__body{
			height:65vh;
			overflow:auto;
		}

		
	</style>
</div>


