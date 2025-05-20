<?php
include('header.php');

?>
<script src="assets/js/bootstrap.min.js"></script>
<body class="layui-layout-body">
  
  <div id="LAY_app">
    <div class="layui-layout layui-layout-admin">
      <div class="layui-header">
        <!-- 头部区域 -->
        
        <ul class="layui-nav layui-layout-left">
          <li class="layui-nav-item layadmin-flexible" lay-unselect>
            <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
              <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
            </a>
          </li>
         
          <li class="layui-nav-item" lay-unselect>
            <a href="javascript:;" layadmin-event="refresh" title="刷新">
              <i class="layui-icon layui-icon-refresh-3"></i>
            </a>
          </li>
          
          
          
          
          
          
         <?php if($userrow['vip']==1){
    $isMobile = false;
    if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/(android|iphone|ipad|ipod)/i', $_SERVER['HTTP_USER_AGENT'])) {
        $isMobile = true;
    }
?>
    <li class="layui-nav-item" lay-unselect>
        <img src="vip.png" width="30px">
        <?php if ($isMobile) { ?>
            <span style="display: none;">尊贵的会员欢迎登录</span>
        <?php } else { ?>
            <span style="color: black;">尊贵的会员欢迎登录</span>
        <?php } ?>
    </li>
<?php } ?>

          
          
          
          
        </ul>
        
        
        
        
        <div style="position: absolute; left: 50%; transform: translateX(-50%); color: white; line-height: 60px;">
        <span id="runtime">本站已运行: 计算中...</span>
    </div>
        
        
        <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">
          <!--<li class="layui-nav-item" lay-unselect>-->
          <!--  <a lay-href="app/message/index.html" layadmin-event="message" lay-text="消息中心">-->
          <!--    <i class="layui-icon layui-icon-notice"></i>-->
      
              <!-- 如果有新消息，则显示小圆点 -->
            <!--  <span class="layui-badge-dot"></span>-->
            <!--</a>-->
          <!--</li>-->
          
          <!--<li class="layui-nav-item layui-hide-xs" lay-unselect>-->
          <!--  <a href="javascript:;"  title="小储对接商城">-->
          <!--    <i class="layui-icon layui-icon-cart"></i>-->
          <!--     站长小储对接商城：<?=$conf['zzqq']?>-->
          <!--  </a>-->
          <!--</li>-->
       
          <!--<li class="layui-nav-item layui-hide-xs" lay-unselect>-->
          <!--  <a href="javascript:;" title="微信">-->
          <!--    <i class="layui-icon layui-icon-login-wechat"></i>-->
          <!--     站长联系方式2：<?=$conf['zzvx']?>-->
          <!--  </a>-->
          <!--</li>-->
          <!--<li class="layui-nav-item layui-hide-xs" lay-unselect>-->
          <!--  <a href="" target="_blank" title="Roois商城">-->
          <!--    <i class="layui-icon layui-icon-cart"></i> 官方商城-->
          <!--  </a>-->
          <!--</li>-->
          <!--<li class="layui-nav-item layui-hide-xs" lay-unselect>-->
          <!--<a href="javascript:;" layadmin-event="note">-->
          <!--   <i class="layui-icon layui-icon-note"></i>-->
          <!--  </a>-->
          <!--</li>-->
         
          <li class="layui-nav-item" lay-unselect>
            <a href="javascript:;">
                <img class="img-avatar img-avatar-48 m-r-10" style="border-radius: 6px;width:30px;height:30px;border:0px;" src="https://q2.qlogo.cn/headimg_dl?dst_uin=<?=$userrow['user'];?>&spec=100" >
                  
              <cite><?php echo $userrow['user']?></cite>
            </a>
            <dl class="layui-nav-child">
                <?php if ($conf['sjqykg']==1) {?>
              <dd><a id="sjqy"><i class=" layui-icon layui-icon-upload-drag"></i> 上级迁移</a></dd>
              <hr>
              <?}?>
              
               <dd><a  lay-href="userinfo"><i class=" layui-icon layui-icon-upload-drag"></i> 个人中心</a></dd>
              
              <dd><a lay-href="passwd"><i class=" layui-icon layui-icon-auz"></i> 修改密码</a></dd>
              <hr>
              <dd style="text-align: center;"><a href="../apisub.php?act=logout"><i class="layui-icon layui-icon-close-fill"></i>退出</a></dd>
            </dl>
          </li>
          
          
          
          
          
          
           <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:" layadmin-event="theme">
                        <i class="layui-icon layui-icon-theme"></i>
                    </a>
                </li>
       <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="fullscreen" title="全屏">
              <i class="layui-icon layui-icon-screen-full"></i>
            </a>
          </li>
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="about"><i class="layui-icon layui-icon-more-vertical"></i></a>
          </li>
          <li class="layui-nav-item layui-show-xs-inline-block layui-hide-sm" lay-unselect>
            <a href="javascript:;" layadmin-event="more" ><i class="layui-icon layui-icon-more-vertical"></i></a>
          </li>
        </ul>
      </div>
     
      <!-- 侧边菜单 -->
      <div class="layui-side layui-side-menu">
        <div class="layui-side-scroll">
          <div class="layui-logo" lay-href="home/console.html">
            <span><?=$conf['sitename']?></span>
          </div>



          <ul class="layui-nav layui-nav-tree" lay-filter="test" id="LAY-system-side-menu"
            lay-filter="layadmin-system-side-menu">
              
            <li data-name="home" class="layui-nav-item layui-nav-itemed">
              <a href="" lay-tips="主页" lay-direction="2">
                <i class="layui-icon layui-icon-home"></i>
                <cite>主页</cite>
              </a>
            </li>
            
            <?php if($userrow['uid']==1){ ?>
                <li data-name="set" class="layui-nav-item">
                  <a href="javascript:;" lay-tips="设置" lay-direction="2">
                    <i class="layui-icon layui-icon-set"></i>
                    <cite>设置</cite>
                  </a>
                  <dl class="layui-nav-child">
                    <dd data-name="console">
                      <a lay-href="webmsg" >系统信息</a>
                    </dd>
                 
                    <dd data-name="console" class="layui-this">
                      <a lay-href="webset" >系统设置</a>
                    </dd>
                    <dd data-name="console">
                     <a lay-href="zzbz">站长帮助</a>
                    </dd>
                      <dd data-name="console">
                     <a lay-href="gglist">公告列表</a>
                    </dd>
                    <dd data-name="console">
                      <a lay-href="huoyuan">接口配置</a>
                    </dd>
                    <dd data-name="console">
                      <a lay-href="class">网课设置</a>
                    </dd>
                    <dd data-name="console">
                      <a lay-href="fenlei">分类设置</a>
                    </dd>
                    <dd data-name="console">
                      <a lay-href="dengji">等级设置</a>
                    </dd>
                    <dd data-name="console">
                      <a lay-href="mijia">密价设置</a>
                    </dd>
                   <dd data-name="console">
                      <a lay-href="ddtj">货源统计</a>
                    </dd>
                    <dd data-name="console">
                      <a lay-href="data">今日数据</a>
                    </dd>
                    <dd data-name="console">
                      <a lay-href="guanx">充值卡密</a>
                      </dd>
                      <dd data-name="console">
                      <a lay-href="paylist">支付订单</a>
                      </dd>
                      <dd data-name="console">
                      <a lay-href="yjdj">一键对接</a>
                      </dd>
                      
                  </dl>
                </li>
            <?php } ?>
            
     
   
           
            <li data-name="user" class="layui-nav-item layui-nav-itemed">
    <a href="javascript:;" lay-tips="学习中心" lay-direction="2">
        <i class="layui-icon layui-icon-username"></i>
        <cite>学习中心</cite>
    </a>
    <dl class="layui-nav-child">
        <!--<dd>-->
        <!--<i class="layui-icon layui-icon-add-circle"></i>  <a lay-href="add2" >立即学习</a>-->
        <!--</dd>-->
        <dd>
            <i class="layui-icon layui-icon-release"></i>  <a lay-href="add" >马上学习</a>
        </dd>
        <dd>
            <i class="layui-icon layui-icon-add-circle-fine"></i>  <a lay-href="addpl" >批量学习</a>
        </dd>
        <dd>
            <i class="layui-icon layui-icon-upload-circle"></i>  <a lay-href="addtj" >无查提交</a>
        </dd>
        <dd>
            <i class="layui-icon layui-icon-form" ></i><a lay-href="jxjy">继续教育</a>
        </dd>
        <dd>
            <i class="layui-icon layui-icon-add-circle"></i>  <a lay-href="qg.php" >鸡儿强国</a>
        </dd>    
        <dd>
            <i class="layui-icon layui-icon-form" ></i><a lay-href="copilot">实习打卡</a>
        </dd>
    </dl>
</li>

<li data-name="ydsj_xd" class="layui-nav-item">
    <a href="javascript:;" lay-tips="运动世界" lay-direction="2">
        <i class="layui-icon layui-icon-read"></i>
        <cite>运动世界</cite>
    </a>
    <dl class="layui-nav-child">
        <dd>
            <i class="layui-icon layui-icon-form" ></i><a lay-href="ydsj_xd">提交</a>
        </dd>
        <dd>
            <i class="layui-icon layui-icon-form" ></i><a lay-href="ydsj_dd">订单</a>
        </dd>   
    </dl>   
</li>


           
           
             <li data-name="list2" class="layui-nav-item">
                        <a lay-href="list2" lay-text="订单汇总" lay-tips="订单汇总" lay-direction="3">
                            <i class="layui-icon layui-icon-form" ></i>
                            <cite>订单汇总</cite>
                        </a>
                    </li>
          
            
            <!-- <li data-name="user" class="layui-nav-item">-->
            <!--  <a href="javascript:;" lay-tips="其他项目" lay-direction="2">-->
            <!--    <i class="layui-icon layui-icon-form"></i>-->
            <!--    <cite>其他项目</cite>-->
            <!--  </a>-->
            <!--  <dl class="layui-nav-child">-->
            <!--    <dd>-->
            <!--        ydsj_xd.php-->
                    
            <!--    <i class="layui-icon layui-icon-add-circle"></i>  <a lay-href="qg.php" >爱学强国</a>-->
            <!--    </dd>-->
            <!--    <dd>-->
            <!--    <i class="layui-icon layui-icon-form" ></i><a lay-href="copilot">实习打卡</a>-->
            <!--    </dd>-->
             
            <!--  </dl>-->
            <!--</li>-->
             
            
                  
            
      
            <li data-name="user" class="layui-nav-item">
              <a href="javascript:;" lay-tips="其他管理" lay-direction="2">
                <i class="layui-icon layui-icon-app"></i>
                <cite>我的信息</cite>
              </a>
              <dl class="layui-nav-child">
            
            <dd>
                  <a lay-href="userinfo">我的资料</a>
                </dd>
                <dd>
                  <a lay-href="userlist">代理管理</a>
                </dd>
                
                <dd>
                 <a lay-href=" atest">最新上架</a>
                </dd>
                <dd>
                 <a lay-href=" atesa">下架专区</a>
                </dd>
                 <dd>
                 <a lay-href="rd">热度排行</a>
                </dd>
                <dd>
                 <a lay-href="kcid">kcid对比</a>
                </dd>
                <dd>
                 <a lay-href="dingdan">可用项目<span class="layui-badge layui-bg-orange">自己查询</span></a>
                </dd>
                
                
                
                
               
                <dd>
                  <a lay-href="log">操作日志</a>
                </dd>
               
                <dd>
                  <a lay-href="help">必看说明</a>
                </dd>
                
                
                <dd>
                  <a lay-href="myprice">学习价格</a>
                </dd>
                
                
                <dd>
                  <a lay-href="docking">串货对接</a>
                </dd>
                
                
                
             <dd data-name="grid" class>
<a href="javascript:;"><i class="layui-icon layui-icon-down"></i>充值方式<span class="layui-nav-more"></span></a>
<dl class="layui-nav-child">
<dd><a lay-href="pay">卡密充值</a>
<dd><a lay-href="charge">在线充值</a>
</dl>
</dl>
</dd>
</dl>
</li>
    </dd>           
                <!--<dd>-->
                <!--  <a lay-href="pay">充值方式</a>-->
                <!--</dd>-->
     
                
                
                
                
                
               
             
                
                
                
                
            
            </li>
            
            
            <li data-name="workorder" class="layui-nav-item">
                        <a lay-href="workorder" lay-text="问题反馈" lay-tips="问题反馈" lay-direction="3">
                            <i class="layui-icon layui-icon-service" ></i>
                            <cite>问题反馈</cite>
                        </a>
                    </li>
                    
                 <li data-name="res" class="layui-nav-item">
                <a lay-href="res"  lay-text="资源分享" lay-tips="资源分享" lay-direction="3">
                                    <i class="layui-icon layui-icon-share"></i>
                                    <cite>资源分享</cite>
                                </a>
                            </li>
     
            
             <li data-name="logout" class="layui-nav-item">
              <a href="../apisub.php?act=logout" lay-tips="退出登录" lay-direction="2">
                <i class="layui-icon layui-icon-close-fill"></i>
                  
                     <cite>退出登录</cite></a> </li>
          </ul>
        </div>
      </div>

      <!-- 页面标签 -->
      <div class="layadmin-pagetabs" id="LAY_app_tabs">
        <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
        <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
        <div class="layui-icon layadmin-tabs-control layui-icon-down">
          <ul class="layui-nav layadmin-tabs-select" lay-filter="layadmin-pagetabs-nav">
            <li class="layui-nav-item" lay-unselect>
              <a href="javascript:;"></a>
              <dl class="layui-nav-child layui-anim-fadein">
                <dd layadmin-event="closeThisTabs"><a href="javascript:;">关闭当前标签页</a></dd>
                <dd layadmin-event="closeOtherTabs"><a href="javascript:;">关闭其它标签页</a></dd>
                <dd layadmin-event="closeAllTabs"><a href="javascript:;">关闭全部标签页</a></dd>
              </dl>
            </li>
          </ul>
        </div>
        <div class="layui-tab" lay-unauto lay-allowClose="true" lay-filter="layadmin-layout-tabs">
          <ul class="layui-tab-title" id="LAY_app_tabsheader">
            <li lay-id="home/console.html" lay-attr="home/console.html" class="layui-this"><i class="layui-icon layui-icon-home"></i></li>
          </ul>
        </div>
      </div>
      
      
      <!-- 主体内容 -->
      <div class="layui-body" id="LAY_app_body">
        <div class="layadmin-tabsbody-item layui-show">
          <iframe src="main" frameborder="0" class="layadmin-iframe"></iframe>
        </div>
      </div>
      
      <!-- 辅助元素，一般用于移动设备下遮罩 -->
      <div class="layadmin-body-shade" layadmin-event="shade"></div>
    </div>
  </div>

  <script src="/index/assets/js/shuiyin.js"></script>
  <!--<script src="assets/layuiadmin/layui/layui.js"></script>-->
  <?php if ($conf['sykg']==1) {?>
  <script>
  watermark('<?=$conf['sitename'];?>','账号 : <?=$userrow['uid'];?>','截图封号');
  </script>
  <?}?>

<script>
  layui.config({
    base: './assets/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use('index');

  layui.use('layer', function(){
    var layer = layui.layer;
    
    $('#sjqy').click(function() {
      layer.prompt({title: '请输入要转移的上级UID', formType: 3}, function(uid, index){
        layer.close(index);
        layer.prompt({title: '请输入要转移的上级邀请码', formType: 3}, function(yqm, index){
          layer.close(index);
          var load = layer.load();
          $.ajax({
            type: "POST",
            url: "../apisub.php?act=sjqy",
            data: {"uid":uid,"yqm":yqm},
            dataType: 'json',
            success: function(data) {
              layer.close(load);
              if (data.code == 1) {
                layer.msg(data.msg,{icon:1});
              } else {
                layer.msg(data.msg,{icon:2});
              }
            }
          });           
        });           
      });
    });

    $('#setPushPlusToken').click( function () {
      var vm = this; // 保存当前Vue实例的引用
      layer.open({
        type: 1, // 表示内容类型为HTML
        title: "设置PushPlus Token",
        area: ['400px', '300px'], // 调整弹窗的宽度和高度
        content: `
          <div style="padding: 20px; text-align: center;"> <!-- 增加居中显示 -->
            <img src="https://img2.imgtp.com/2024/04/27/nVaDCYKn.png" alt="图片说明" style="max-width: 100%; height: auto; max-height: 100px;"> <!-- 调整图片尺寸 -->
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
    });
  });
</script>

<script charset="UTF-8" id="LA_COLLECT" src="//sdk.51.la/js-sdk-pro.min.js?id=Jn7D2bUCe2U5jXJk&ck=Jn7D2bUCe2U5jXJk"></script>
   <script type="text/javascript">
</script>
<style>
#run<style>time {
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  color: white;
  line-height: 60px;
}

/* 当屏幕宽度小于768px时，#runtime元素不可见 */
@media screen and (max-width: 768px) {
  #runtime {
    display: none;
  }
}
</style>


<script>
function calculateRuntime() {
    const start = new Date('2022-09-01T17:00:00'); // 开始时间
    const now = new Date(); // 当前时间
    const diff = now - start; // 差值，单位毫秒

    // 将差值转换为天、小时、分钟、秒
    let days = Math.floor(diff / (1000 * 60 * 60 * 24));
    let hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((diff % (1000 * 60)) / 1000);

    // 更新页面上的显示
    document.getElementById('runtime').innerText = `本站已运行: ${days}天${hours}小时${minutes}分钟${seconds}秒`;
}

// 每秒更新一次运行时间
setInterval(calculateRuntime, 1000);
</script>


</body>
</html>