<?php
$mod='blank';
$title='平台对接';
require_once('header.php');
?>

  <div class="layui-fluid" id="LAY-component-grid-mobile">
    <div class="layui-row layui-col-space10">
      <div class="layui-col-xs12">
        <!-- 填充内容 -->
        <div class="layui-card">
          <div class="layui-card-header">学习对接</div>
          <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
  <ul class="layui-tab-title">
                <li class="layui-this">29对接参数</li>
                <li>小储对接参数</li>
                <li>课程ID</li>
                <li>29对接代码</li>
                <li>查询课程</li>
                <li>查询进度</li>
                <li>课程补刷</li>
                <li>小沐一键对接插件</li>
              </ul>
              <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                  <blockquote class="layui-elem-quote">
                      对接地址：<span style="color: #5FB878;">http://<?echo($_SERVER['SERVER_NAME']);?>/api.php?act=add</span>
                  </blockquote>
                  <blockquote class="layui-elem-quote">
                      请求方式：POST
                  </blockquote>
                  <blockquote class="layui-elem-quote">
                      请求头部：<span style="color: #5FB878;">Content-Type: application/json; charset=UTF-8</span>
                  </blockquote>
                  <div id="loglist">
                      <blockquote class="layui-elem-quote">
                      对接UID：{{row.uid}}
                      </blockquote>
                      <blockquote class="layui-elem-quote">
                          对接KEY：{{row.key}}
                      </blockquote>
                  </div>
<pre class="layui-code" lay-title="json" lay-skin="notepad">//示例请求参数
{
    "uid": 你的uid,
    "key": 你的key密匙,
    "platform": 平台ID,
    "school": 学校,
    "user": 账号,
    "pass": 密码,
    "kcname": 课程名字
}</pre>
                  
<pre class="layui-code" lay-title="json" lay-skin="notepad">//代码区域
{
    "code": 0,
    "msg": "提交成功",
    "status": 0,
    "message": "提交成功",
    // ...
}
</pre>
                  
                </div>
                
                <div class="layui-tab-item">
                    <blockquote class="layui-elem-quote">
                      对接地址：<span style="color: #5FB878;">http://<?echo($_SERVER['SERVER_NAME']);?>/api.php?act=add</span>
                  </blockquote>
                  <blockquote class="layui-elem-quote">
                      请求方式：POST
                  </blockquote>
                  <blockquote class="layui-elem-quote">
                      请求头部：<span style="color: #5FB878;">Content-Type: application/json; charset=UTF-8</span>
                  </blockquote>
                  <div id="loglist">
                      <blockquote class="layui-elem-quote">
                      对接UID：<?php echo $userrow['uid'];?>
                      </blockquote>
                      <blockquote class="layui-elem-quote">
                          对接KEY：<?php echo $userrow['key'];?>
                      </blockquote>
                  </div>
<pre class="layui-code" lay-title="json" lay-skin="notepad">//必填请求参数
{
    uid | 你的uid,
    key | 你的key密匙,
    platform | 平台ID,
    school | 学校,
    user | 账号,
    pass | 密码,
    kcname | 课程名字
}</pre>
                  
<pre class="layui-code" lay-title="json" lay-skin="notepad">//返回日志参数
{
    "code": 0,
    "msg": "提交成功",
    "status": 0,
    "message": "提交成功",
    // ...
}
</pre>
                </div>
                <div class="layui-tab-item">
                 <table class="layui-table">
                  <thead>
                    <tr>
                      <th>课程ID</th>
                      <th>平台名称</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                	$a=$DB->query("select * from qingka_wangke_class where status=1 ORDER BY `cid` ASC");
                    while($rs=$DB->fetch($a)){ echo "
                    <tr>
                      <td>".$rs['cid']."</td>
                      <td>".$rs['name']."</td>
                    </tr>"; 
                    }?>
                  </tbody>
                </table>
                </div>
                <div class="layui-tab-item">
                        <blockquote class="layui-elem-quote">
                <span style="color: #00aaaa">会就搞吧，不会的不懂的就拉倒</span>
                
                </blockquote>
                <blockquote class="layui-elem-quote">29对接地址： <span
                                    onclick="copyToClip('http://<?echo($_SERVER['SERVER_NAME']);?>/api.php?act=chadan','复制成功')"
                                    style="color: #00aaaa">http://<?echo($_SERVER['SERVER_NAME']);?>/</span>
                </blockquote>
                         <pre lay-title="平台标识[PHP]" class="layui-code">//more标识 放在/Checkorder/xdjk.php 文件，小沐模板则无视
"more" => "more学习平台", </pre>
                <hr>
                          <pre lay-title="查课代码[PHP]" class="layui-code">//more学习平台查课接口 放在/Checkorder/ckjk.php 文件，小沐模板则无视
if ($type == "more") {
		$data = array("uid" => $a["user"], "key" => $a["pass"], "school" => $school, "user" => $user, "pass" => $pass, "platform" => $noun, "kcid" => $kcid);
		$more_rl = $a["url"];
		$more_url = "$more_rl/api.php?act=get";
		$result = get_url($more_url, $data);
		$result = json_decode($result, true);
		return $result;}</pre>
                <hr>
                <pre lay-title="下单代码[PHP]" class="layui-code">//more学习平台下单接口 放在/Checkorder/xdjk.php 文件，小沐模板则无视
	else if ($type == "more") {
		$data = array("uid" => $a["user"], "key" => $a["pass"], "platform" => $noun, "school" => $school, "user" => $user, "pass" => $pass, "kcname" => $kcname, "kcid" => $kcid);
		$more_rl = $a["url"];
		$more_url = "$more_rl/api.php?act=add";
		$result = get_url($more_url, $data);
		$result = json_decode($result, true);
		if ($result["code"] == "0") {
			$b = array("code" => 1, "msg" => "下单成功");
		} else {
			$b = array("code" => -1, "msg" => $result["msg"]);
		}
		return $b;} </pre>
<hr>
 <pre lay-title="进度代码[PHP]" class="layui-code">//more学习平台进度新接口 放在/Checkorder/jdjk.php 文件，小沐模板则无视
 if ($type == "more") {
    $more_rl = $a["url"];
    $kcname_encoded = urlencode($kcname);
    $user_encoded = urlencode($user);
    $more_url = "$more_rl/api/search?uid=".$a["user"]."&key=".$a["pass"]."&kcname=".$kcname_encoded."&username=".$user_encoded."&cid=".$d["noun"];
    $result = get_url($more_url,$data);
    $result = json_decode($result, true);
    if ($result["code"] == "1") {
        foreach ($result["data"] as $res) {
            $yid = $res["id"];
            $kcname = $res["kcname"];
            $status = $res["status"];
            $process = $res["process"];
            $remarks = $res["remarks"];
            $kcks = $res["courseStartTime"];
            $kcjs = $res["courseEndTime"];
            $ksks = $res["examStartTime"];
            $ksjs = $res["examEndTime"];
            $zhgx = $res["zhgx"];
            $b[] = array("code" => 1, "msg" => "查询成功", "yid" => $yid, "kcname" => $kcname, "user" => $user, "pass" => $pass, "ksks" => $ksks, "ksjs" => $ksjs, "status_text" => $status, "process" => $process, "remarks" => $remarks,"zhgx" =>  $zhgx);
        }
    } else {
        $b[] = array("code" => -1, "msg" => $result["msg"]);
    }
    return $b;
}
 <!--else if ($type == "more") {
		$data = array("username" => $user);
		$more_rl = $a["url"];
		$more_url = "$more_rl/api.php?act=chadan";
		$result = get_url($more_url, $data);
		$result = json_decode($result, true);
		if ($result["code"] == "1") {
			foreach ($result["data"] as $res) {
				$yid = $res["id"];
				$kcname = $res["kcname"];
				$status = $res["status"];
				$process = $res["process"];
				$remarks = $res["remarks"];
				$kcks = $res["courseStartTime"];
				$kcjs = $res["courseEndTime"];
				$ksks = $res["examStartTime"];
				$ksjs = $res["examEndTime"];
				$b[] = array("code" => 1, "msg" => "查询成功", "yid" => $yid, "kcname" => $kcname, "user" => $user, "pass" => $pass, "ksks" => $ksks, "ksjs" => $ksjs, "status_text" => $status, "process" => $process, "remarks" => $remarks);
			}
		} else {
			$b[] = array("code" => -1, "msg" => $result["msg"]);
		}
		return $b;}--></pre>
                <hr>
                <pre lay-title="补刷代码[PHP]" class="layui-code">//more学习平台补刷 放在/Checkorder/bsjk.php 文件，小沐模板则无视
	if ($type == "more") {
		$data = array("uid" => $a["user"], "key" => $a["pass"], "id" => $yid);
		$more_rl = $a["url"];
		$more_url = "$more_rl/api.php?act=budan";
		$result = get_url($more_url, $data);
		$result = json_decode($result, true);

		return $result;}</pre>
		<hr>
		<blockquote class="layui-elem-quote">
                <span style="color: red">你的平台支持就安排下面代码，不支持就无视</span>
                
                </blockquote>
		<pre lay-title="暂停代码[PHP]" class="layui-code">//more学习平台暂停 放在/Checkorder/ztjk.php 文件，小沐模板则无视	    
	if ($type == "more") {
$data = array("uid" => $a["user"], "key" => $a["pass"], "id" => $yid);
$more_rl = $a["url"];
$more_url = "$more_rl/api.php?act=zt";
$result = get_url($more_url, $data);
$result = json_decode($result, true);
return $result;}
	else {
				$b = array("code" => -1, "msg" => "接口异常，请联系管理员");
		}
}	</pre><hr>
		<pre lay-title="修改代码[PHP]" class="layui-code">//more学习平台改密 放在/Checkorder/xgjk.php文件，小沐模板则无视
		    if ($type == "more") {
$data = array("uid" => $a["user"], "key" => $a["pass"], "id" => $yid, "xgmm" => $xgmm);
$more_rl = $a["url"];
$more_url = "$more_rl/api.php?act=xgmm";
$result = get_url($more_url, $data);
$result = json_decode($result, true);
return $result;}
	else {
				$b = array("code" => -1, "msg" => "接口异常，请联系管理员");
		}
} </pre><hr>
		    <pre lay-title="秒刷代码[PHP]" class="layui-code">//more学习平台秒刷 放在/Checkorder/msjk.php文件，小沐模板则无视
		    if ($type == "more") {
$data = array("uid" => $a["user"], "key" => $a["pass"], "id" => $yid);
$more_rl = $a["url"];
$more_url = "$more_rl/api.php?act=ms_order";
$result = get_url($more_url, $data);
$result = json_decode($result, true);
return $result;}
	else {
				$b = array("code" => -1, "msg" => "接口异常，请联系管理员");
		}
}</pre>
		    
		    
                    </div>
        <div class="layui-tab-item">
                        
                        <blockquote class="layui-elem-quote">请求接口： <span
                                    onclick="copyToClip('http://<?echo($_SERVER['SERVER_NAME']);?>/api.php?act=get','复制成功')"
                                    style="color: #00aaaa">http://<?echo($_SERVER['SERVER_NAME']);?>/api.php?act=get</span>
                </blockquote>
                <blockquote class="layui-elem-quote">请求方式：POST</blockquote>
                <blockquote class="layui-elem-quote">请求头部：<span
                                    onclick="copyToClip('Content-Type: application/json; charset=UTF-8','复制成功')"
                                    style="color: #00aaaa">Content-Type: application/json; charset=UTF-8</span></blockquote>
                <blockquote class="layui-elem-quote">对接UID：<span
                            style="color:#f07178"
                            onclick="copyToClip('<?php echo $userrow['uid'];?>')"><?php echo $userrow['uid'];?></span></blockquote>
                  <blockquote class="layui-elem-quote">对接KEY：<span
                            style="color:#f07178"
                            onclick="copyToClip('<?php echo $userrow['key'];?>')"><?php echo $userrow['key'];?></span>
                </blockquote>  
                <hr>
                <pre lay-title="请求字段[JSON]" class="layui-code">{
    "uid": "1001", //你的对接UID，必须提交
    "key": "aaaaaaaaaaaaaaaa", //你的对接KEY，必须提交
    "platform": "11", //平台课程ID
    "school": "苏黎世联邦理工大学", //学生学校全称
    "user": "14250", //学生账号
    "pass": "54188", //学生密码
}</pre>
                <hr>
                <pre lay-title="返回字段[JSON]" class="layui-code">{
    "code": 0, 
    "msg": "提示信息",//返回信息
    "data":[{
            "id":"43543", //对应的课程ID
            "name":"怎么吸引异性", //课程名字
           }]
    "userinfo":"学校 账号 密码", 你提交的学校 账号 密码
}</pre>
                    </div>
                    <div class="layui-tab-item">
                        <blockquote class="layui-elem-quote">请求接口： <span
                                    onclick="copyToClip('http://<?echo($_SERVER['SERVER_NAME']);?>/api.php?act=chadan','复制成功')"
                                    style="color: #00aaaa">http://<?echo($_SERVER['SERVER_NAME']);?>/api.php?act=chadan</span>
                </blockquote>
                <blockquote class="layui-elem-quote">请求方式：POST</blockquote>
                <blockquote class="layui-elem-quote">请求头部：<span
                                    onclick="copyToClip('Content-Type: application/json; charset=UTF-8','复制成功')"
                                    style="color: #00aaaa">Content-Type: application/json; charset=UTF-8</span></blockquote>
                <blockquote class="layui-elem-quote">对接UID：<span
                            style="color:#f07178"
                            onclick="copyToClip('<?php echo $userrow['uid'];?>')"><?php echo $userrow['uid'];?></span></blockquote>
                 <blockquote class="layui-elem-quote">对接KEY：<span
                            style="color:#f07178"
                            onclick="copyToClip('<?php echo $userrow['key'];?>')"><?php echo $userrow['key'];?></span>
                </blockquote>  
                <hr>
                <pre lay-title="请求字段[JSON]" class="layui-code">{
    "uid": "1001", //你的对接UID，必须提交
    "key": "aaaaaaaaaaaaaaaa", //你的对接KEY，必须提交
    "username": "14250", //学生账号
}</pre>
                <hr>
                <pre lay-title="返回字段[JSON]" class="layui-code">{
    太多了懒得打了，自己post看吧
}</pre>
                    </div>
                     <div class="layui-tab-item">
                         <blockquote class="layui-elem-quote">请求接口： <span
                                    onclick="copyToClip('http://<?echo($_SERVER['SERVER_NAME']);?>/api.php?act=budan','复制成功')"
                                    style="color: #00aaaa">http://<?echo($_SERVER['SERVER_NAME']);?>/api.php?act=budan</span>
                </blockquote>
                <blockquote class="layui-elem-quote">请求方式：POST</blockquote>
                <blockquote class="layui-elem-quote">请求头部：<span
                                    onclick="copyToClip('Content-Type: application/json; charset=UTF-8','复制成功')"
                                    style="color: #00aaaa">Content-Type: application/json; charset=UTF-8</span></blockquote>
                <blockquote class="layui-elem-quote">对接UID：<span
                            style="color:#f07178"
                            onclick="copyToClip('<?php echo $userrow['uid'];?>')"><?php echo $userrow['uid'];?></span></blockquote>
                  <blockquote class="layui-elem-quote">对接KEY：<span
                            style="color:#f07178"
                            onclick="copyToClip('<?php echo $userrow['key'];?>')"><?php echo $userrow['key'];?></span>
                </blockquote>  
                <hr>
                <pre lay-title="请求字段[JSON]" class="layui-code">{
    "uid": "1001", //你的对接UID，必须提交
    "key": "aaaaaaaaaaaaaaaa", //你的对接KEY，必须提交
    "id": "14250", //订单号
}</pre>
                <hr>
                <pre lay-title="返回字段[JSON]" class="layui-code">{
    "code": 1, //1成功，其他失败
    "msg": "提示信息",//返回信息
}</pre>
                    </div>
                <div class="layui-tab-item">
                    <blockquote class="layui-elem-quote">
                     小沐系统一键对接【所有29对接小沐系统】上架插件 <a href="../assets/download/小沐对接插件.zip" class="layui-btn layui-btn-xs layui-btn-normal">点击下载&gt;&gt;</a>
                    </blockquote>
                </div>
                <div class="layui-tab-item">
                    <blockquote class="layui-elem-quote">
                      等待添加 ...
                    </blockquote>
                </div>
                <div class="layui-tab-item">
                    <blockquote class="layui-elem-quote">
                      等待添加 ...
                    </blockquote>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 

<?php require_once("footer.php");?>

<script type="text/javascript">
  layui.config({
    base: 'assets/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index', 'code'], function(){
    layui.code({
      elem: 'pre'
    });
  });
</script>
	
<script>
new Vue({
	el:"#loglist",
	data:{
		row:null
	},
	methods:{
		userinfo: function () {
          var load = layer.load();
          this.$http.post("/apisub.php?act=userinfo").then(function (data) {
            layer.close(load);
            if (data.data.code == 1) {
              this.row = data.data;
            } else {
              layer.alert(data.data.msg, { icon: 2 });
            }
          });
        }
	},
	mounted() {
        this.userinfo();
    }
});
</script>