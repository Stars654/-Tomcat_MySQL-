
<?php
include('../confing/common.php');

    
$yqm=$_GET['yqm'];
if ($yqm=="") {
    $loginType=true;
} else {
    $loginType=false;
}
if($islogin==1){exit("<script language='javascript'>window.location.href='../';</script>");  }


?>
<!DOCTYPE html>
<html lang="en">
    

<head>
    <meta charset="UTF-8">
    
  	<title><?=$conf['sitename']?></title>
    <link rel="stylesheet" href="css/style.css">
  
        <link rel="icon" href="../favicon.ico" type="image/ico">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title><?=$conf['sitename']?></title>
        <meta name="keywords" content="<?=$conf['keywords'];?>"/>
        <meta name="description" content="<?=$conf['description'];?>"/>
        <!--<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"/>-->
       
        <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.js"></script>
        <link href="assets/LightYear/css/bootstrap.min.css" rel="stylesheet">

</head>

<div class="box" id="login">
  <!-- 登录 - 开始 -->
  <div class="forms" v-if="loginType">
    <div class="form-wrapper">
      <div class="title">
        <h1>Sign in</h1>
        <span>Welcome to
          More        </span>
      </div>
      <div class="input-wrapper">
        <div class="input-item">
          <span class="input-title">Uesr*</span>
          <input type="text" class="ipt" v-model="dl.user" placeholder="Uesr">
        </div>
        <div class="input-item">
          <span class="input-title">Password*</span>
          <input type="password" class="ipt" v-model="dl.pass" placeholder="Password">
        </div>
         <div class="input-item">
          <span class="input-title">验证码*</span>
          <input type="password" class="ipt" v-model="dl.captcha" placeholder="请输入验证码">
          <img src="captcha.php" alt="验证码" onclick="this.src='captcha.php?' + Math.random();" style="cursor: pointer;">
        </div>
        
        
          
 

        
        
        
        
        
        
        
        
        
        <button class="btn" style="margin-top: 1.25rem;" @click="login">Sign in</button>
        <!--<div class="other-login">-->
        <!--  <svg t="1695533780568" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"-->
        <!--    p-id="5066" width="128" height="128">-->
        <!--    <path-->
        <!--      d="M664.250054 368.541681c10.015098 0 19.892049 0.732687 29.67281 1.795902-26.647917-122.810047-159.358451-214.077703-310.826188-214.077703-169.353083 0-308.085774 114.232694-308.085774 259.274068 0 83.708494 46.165436 152.460344 123.281791 205.78483l-30.80868 91.730191 107.688651-53.455469c38.558178 7.53665 69.459978 15.308661 107.924012 15.308661 9.66308 0 19.230993-0.470721 28.752858-1.225921-6.025227-20.36584-9.521864-41.723264-9.521864-63.862493C402.328693 476.632491 517.908058 368.541681 664.250054 368.541681zM498.62897 285.87389c23.200398 0 38.557154 15.120372 38.557154 38.061874 0 22.846334-15.356756 38.156018-38.557154 38.156018-23.107277 0-46.260603-15.309684-46.260603-38.156018C452.368366 300.994262 475.522716 285.87389 498.62897 285.87389zM283.016307 362.090758c-23.107277 0-46.402843-15.309684-46.402843-38.156018 0-22.941502 23.295566-38.061874 46.402843-38.061874 23.081695 0 38.46301 15.120372 38.46301 38.061874C321.479317 346.782098 306.098002 362.090758 283.016307 362.090758zM945.448458 606.151333c0-121.888048-123.258255-221.236753-261.683954-221.236753-146.57838 0-262.015505 99.348706-262.015505 221.236753 0 122.06508 115.437126 221.200938 262.015505 221.200938 30.66644 0 61.617359-7.609305 92.423993-15.262612l84.513836 45.786813-23.178909-76.17082C899.379213 735.776599 945.448458 674.90216 945.448458 606.151333zM598.803483 567.994292c-15.332197 0-30.807656-15.096836-30.807656-30.501688 0-15.190981 15.47546-30.477129 30.807656-30.477129 23.295566 0 38.558178 15.286148 38.558178 30.477129C637.361661 552.897456 622.099049 567.994292 598.803483 567.994292zM768.25071 567.994292c-15.213493 0-30.594809-15.096836-30.594809-30.501688 0-15.190981 15.381315-30.477129 30.594809-30.477129 23.107277 0 38.558178 15.286148 38.558178 30.477129C806.808888 552.897456 791.357987 567.994292 768.25071 567.994292z"-->
        <!--      p-id="5067"></path>-->
        <!--  </svg>-->
        <!--  <span>WeChat</span>-->
        <!--</div>-->
        <div class="login-tips">
          Don't have an account?<span @click="newlogin">Sign up</span>
        </div>
      </div>
    </div>
  </div>
  <!-- 登录 - 结束 -->
  <!-- 注册 - 开始 -->
  <div class="forms" v-else>
    <div class="form-wrapper">
      <div class="title">
        <h1>Sign up</h1>
        <span>Start Your Fantasy Journey</span>
      </div>
      <div class="input-wrapper">
        <div class="input-item">
          <span class="input-title">昵称*</span>
          <input type="text" class="ipt" v-model="reg.name" placeholder="NickName">
        </div>
        <div class="input-item">
          <span class="input-title">邀请码*</span>
          <input type="text" class="ipt" v-model="reg.yqm" placeholder="InvateCode">
        </div>
      
        
        
        <div class="input-item">
          <span class="input-title">账号*</span>
          <input type="text" class="ipt" v-model="reg.user" placeholder="User(Email)">
        </div>
        

        

<div class="input-item">
    <span class="input-title">pushplus*</span>
    <div class="input-container">
        <input type="text" class="ipt" v-model="reg.pushplus" placeholder="请输入pushplus(选填)">
        <button type="button" onclick="window.open('/index/smgz', '_blank');" class="btn">点击获取</button>
    </div>
</div>

<style>

</style>


        
        
        
        
        
        <div class="input-item">
          <span class="input-title">密码*</span>
          <input type="password" class="ipt" v-model="reg.pass" placeholder="Password">
          <span class="tips">Mast be at least 8 characters</span>
        </div>
        
        
        
        <button class="btn" @click="register">Get Started</button>
        <!--<div class="other-login">-->
        <!--  <svg t="1695533780568" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"-->
        <!--    p-id="5066" width="128" height="128">-->
        <!--    <path-->
        <!--      d="M664.250054 368.541681c10.015098 0 19.892049 0.732687 29.67281 1.795902-26.647917-122.810047-159.358451-214.077703-310.826188-214.077703-169.353083 0-308.085774 114.232694-308.085774 259.274068 0 83.708494 46.165436 152.460344 123.281791 205.78483l-30.80868 91.730191 107.688651-53.455469c38.558178 7.53665 69.459978 15.308661 107.924012 15.308661 9.66308 0 19.230993-0.470721 28.752858-1.225921-6.025227-20.36584-9.521864-41.723264-9.521864-63.862493C402.328693 476.632491 517.908058 368.541681 664.250054 368.541681zM498.62897 285.87389c23.200398 0 38.557154 15.120372 38.557154 38.061874 0 22.846334-15.356756 38.156018-38.557154 38.156018-23.107277 0-46.260603-15.309684-46.260603-38.156018C452.368366 300.994262 475.522716 285.87389 498.62897 285.87389zM283.016307 362.090758c-23.107277 0-46.402843-15.309684-46.402843-38.156018 0-22.941502 23.295566-38.061874 46.402843-38.061874 23.081695 0 38.46301 15.120372 38.46301 38.061874C321.479317 346.782098 306.098002 362.090758 283.016307 362.090758zM945.448458 606.151333c0-121.888048-123.258255-221.236753-261.683954-221.236753-146.57838 0-262.015505 99.348706-262.015505 221.236753 0 122.06508 115.437126 221.200938 262.015505 221.200938 30.66644 0 61.617359-7.609305 92.423993-15.262612l84.513836 45.786813-23.178909-76.17082C899.379213 735.776599 945.448458 674.90216 945.448458 606.151333zM598.803483 567.994292c-15.332197 0-30.807656-15.096836-30.807656-30.501688 0-15.190981 15.47546-30.477129 30.807656-30.477129 23.295566 0 38.558178 15.286148 38.558178 30.477129C637.361661 552.897456 622.099049 567.994292 598.803483 567.994292zM768.25071 567.994292c-15.213493 0-30.594809-15.096836-30.594809-30.501688 0-15.190981 15.381315-30.477129 30.594809-30.477129 23.107277 0 38.558178 15.286148 38.558178 30.477129C806.808888 552.897456 791.357987 567.994292 768.25071 567.994292z"-->
        <!--      p-id="5067"></path>-->
        <!--  </svg>-->
        <!--  <span>WeChat</span>-->
        <!--</div>-->
        <div class="login-tips">
          Already have an account?<span @click="newlogin">Log in</span>
        </div>
      </div>
    </div>
  </div>
  <!-- 注册 - 结束 -->
  <div class="bg">
    <div class="text">REACH FOR THE STARS</div>
    <img src="assets/asset/1.jpg" class="bg-img img-one" alt="img-one">
    <img src="assets/asset/2.jpg" class="bg-img img-two" alt="img-two">
  </div>
</div>

<script type="text/javascript" src="assets/LightYear/js/jconfirm/jquery-confirm.min.js"></script>
<script type="text/javascript" src="assets/LightYear/js/main.min.js"></script>
<script src="layer/3.1.1/layer.js"></script>
<script src="assets/js/vue.min.js"></script>
<script src="assets/js/vue-resource.min.js"></script>
<script src="assets/layui/js/axios.min.js"></script>
<script>
    var vm = new Vue({
        el: "#login",
        data: {
            loginType: true,
            title: "你在看什么呢？我写的代码好看吗",
            dl: {},
            reg: {
                yqm:"<?=$yqm;?>",
            }
        },
        methods: {
            newlogin: function() {
                this.loginType = !this.loginType
            },
            login: function() {
                if (!this.dl.user || !this.dl.pass
                || !this.dl.captcha
                
                ) {
                    layer.msg('账号、密码及验证码不能为空', {
                        icon: 2
                    });
                    return
                }
                var loading = layer.load();
                vm.$http.post("/apisub.php?act=login", {
                    user: this.dl.user,
                    pass: this.dl.pass,
                    captcha: this.dl.captcha // 添加验证码数据
                }, {
                    emulateJSON: true
                }).then(function(data) {
                    layer.close(loading);
                    if (data.data.code == 1) {
                        layer.msg(data.data.msg, {
                            icon: 1
                        });
                        setTimeout(function() {
                            window.location.href = "/"
                        }, 1000);
                    } else if (data.data.code == 5) {
                        vm.login2();
                    } else {
                        layer.msg(data.data.msg, {
                            icon: 2
                        });
                    }
                });

            },
           register: function() {
    if (!this.reg.user || !this.reg.pass || !this.reg.name || !this.reg.yqm) {
        layer.msg('用户名、密码、昵称和邀请码不能为空', {
            icon: 2
        });
        return;
    }
    
    var loading = layer.load();
    
    // 声明 postData 对象
    var postData = {
        name: this.reg.name,
        user: this.reg.user,
        pass: this.reg.pass,
        yqm: this.reg.yqm
    };

    // 如果 pushplus 有值，则添加到 postData 中
    if (this.reg.pushplus) {
        postData.pushplus = this.reg.pushplus;
    }

    this.$http.post("/apisub.php?act=register", postData, {
        emulateJSON: true
    }).then(function(data) {
        layer.close(loading);
        if (data.data.code == 1) {
            this.loginType = true;
            this.dl.user = this.reg.user;
            this.dl.pass = this.reg.pass;
            layer.msg(data.data.msg, {
                icon: 1
            });
        } else {
            layer.msg(data.data.msg, {
                icon: 2
            });
        }
    });
},

            login2: function() {
                layer.prompt({
                    title: '管理二次验证',
                    formType: 3
                }, function(pass2, index) {
                    var loading = layer.load();
                    vm.$http.post("/apisub.php?act=login", {
                        user: vm.dl.user,
                        pass: vm.dl.pass,
                        pass2: pass2
                    }, {
                        emulateJSON: true
                    }).then(function(data) {
                        layer.close(loading);
                        if (data.data.code == 1) {
                            layer.msg(data.data.msg, {
                                icon: 1
                            });
                            setTimeout(function() {
                                window.location.href = "/"
                            }, 1000);
                        } else {
                            layer.msg(data.data.msg, {
                                icon: 2
                            });
                        }
                    });
                });
            }
        }
    });

    $('#connect_qq').click(function() {
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
    });
    
</script>
<script>
  const imgs = document.querySelectorAll('.bg-img')
  let flag = false
  setInterval(function () {
    if (flag) {
      imgs[0].style.opacity = 0
      imgs[1].style.opacity = 1
    } else {
      imgs[0].style.opacity = 1
      imgs[1].style.opacity = 0
    }
    flag = !flag
  }, 5000)
</script>

<body>
</body>

</html>