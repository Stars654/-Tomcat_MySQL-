<?php
include('../confing/common.php');
?>
<!DOCTYPE html>
<html>

    <head>
          
        <meta charset="utf-8"/>
        <link rel="icon" href="../favicon.ico" type="image/ico">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title><?=$conf['sitename']?></title>
        <meta name="keywords" content="<?=$conf['keywords'];?>"/>
        <meta name="description" content="<?=$conf['description'];?>"/>
        <!--<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"/>-->
        <link rel="stylesheet" href="../assets/layui/css/layui.css"/>
        <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.js"></script>
        <link href="assets/LightYear/css/bootstrap.min.css" rel="stylesheet">
        <script>
            $(function(){
                	//  给 input 类型绑定回车事件
                $('#pwd').bind('keypress',function(event){
                    if(event.keyCode == "13"){
            	    $("#login_btn").click();
                }
         });
            });
        </script>
    <style>
        /* 默认背景 */
body {
    background-image: url("default-background.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    min-height: 100vh;
}

/* 移动设备背景 */
@media only screen and (max-width: 768px) {
    body {
        background-image: url("https://pic1.imgdb.cn/item/644227bb0d2dde5777245460.jpg");
    }
}

/* 桌面设备背景 */
@media only screen and (min-width: 769px) {
    body {
        background-image: url("https://pic1.imgdb.cn/item/644226450d2dde577722220c.jpg");
    }
}

        body:before {
            content: "";
            background-color: rgba(0, 0, 0, .2);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .login-wrapper {
            max-width: 420px;
            padding: 20px;
            margin: 0 auto;
            position: relative;
            box-sizing: border-box;
            z-index: 2;
        }

        .login-wrapper>.layui-form {
            padding: 25px 30px;
            background-color: #fff;
            box-shadow: 0 3px 6px -1px rgba(0, 0, 0, 0.19);
            box-sizing: border-box;
            border-radius: 4px;
        }

        .login-wrapper>.layui-form>h2 {
            color: #333;
            font-size: 18px;
            text-align: center;
            margin-bottom: 25px;
        }

        .login-wrapper>.layui-form>.layui-form-item {
            margin-bottom: 25px;
            position: relative;
        }

        .login-wrapper>.layui-form>.layui-form-item:last-child {
            margin-bottom: 0;
        }

        .login-wrapper>.layui-form>.layui-form-item>.layui-input {
            height: 46px;
            line-height: 46px;
            border-radius: 2px !important;
        }

        .login-wrapper .layui-input-icon-group>.layui-input {
            padding-left: 46px;
        }

        .login-wrapper .layui-input-icon-group>.layui-icon {
            width: 46px;
            height: 46px;
            line-height: 46px;
            font-size: 20px;
            color: #909399;
            position: absolute;
            left: 0;
            top: 0;
            text-align: center;
        }

        .login-wrapper>.layui-form>.layui-form-item.login-captcha-group {
            padding-right: 135px;
        }

        .login-wrapper>.layui-form>.layui-form-item.login-captcha-group>.login-captcha {
            height: 46px;
            width: 120px;
            cursor: pointer;
            box-sizing: border-box;
            border: 1px solid #e6e6e6;
            border-radius: 2px !important;
            position: absolute;
            right: 0;
            top: 0;
        }

        .login-wrapper>.layui-form>.layui-form-item>.layui-form-checkbox {
            margin: 0 !important;
            padding-left: 25px;
        }

        .login-wrapper>.layui-form>.layui-form-item>.layui-form-checkbox>.layui-icon {
            width: 15px !important;
            height: 15px !important;
        }

        .login-wrapper>.layui-form .layui-btn-fluid {
            height: 48px;
            line-height: 48px;
            font-size: 16px;
            border-radius: 2px !important;
        }

        .login-wrapper>.layui-form>.layui-form-item.login-oauth-group>a>.layui-icon {
            font-size: 26px;
        }

        .login-copyright {
            color: #eee;
            padding-bottom: 20px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        @media screen and (min-height: 550px) {
            .login-wrapper {
                margin: -250px auto 0;
                position: absolute;
                top: 50%;
                left: 0;
                right: 0;
                width: 100%;
            }

            .login-copyright {
                position: absolute;
                bottom: 0;
                right: 0;
                left: 0;
            }
        }

        .layui-btn {
            background-color: #5FB878;
            border-color: #5FB878;
        }

        .layui-link {
            color: #5FB878 !important;
        }

        .layui-input {
            border-top: none;
            border-left: none;
            border-right: none;
        }

        .layui-input:hover,
        .layui-textarea:hover {
            border-color: #00a65a !important;
        }
    </style>
</head>

<body>
   <div id="login1">
    <div v-if="loginType" class="login-wrapper layui-anim layui-anim-scale " >
        <div class="layui-form" style="opacity:0.8">
      
          <center> <img class="layui-anim layui-anim-scale" src="<?=$conf['logo']?>" width="80%"/></center>

            <div class="layui-form-item layui-input-icon-group">
                <i class="layui-icon layui-icon-username"></i>
                <input class="layui-input" v-model="dl.user" placeholder="Yun Pro User" 
                    lay-verify="required" required />
            </div>
            <div class="layui-form-item layui-input-icon-group">
                <i class="layui-icon layui-icon-password"></i>
                <input class="layui-input" v-model="dl.pass" placeholder="Yun Pro Pass" type="password" 
                    lay-verify="required" required />
            </div>

            <div class="layui-form-item">
                <button class="layui-btn layui-btn-fluid layui-bg-black" @click="login" lay-submit>登入平台</button>
            </div>
             <div class="layui-form-item">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a href="http://ck.alwk.pro/" tppabs="http://www.ilayuis.com/doc/element/button.html" class="btn btn-sm btn-warning" target="_blank">自助查询</a>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a @click="newlogin" tppabs="http://www.ilayuis.com/doc/element/button.html" class="layui-btn layui-btn-sm layui-btn-normal" target="_blank">限时注册</a>

                                   </div>
    <center>
    <p>
        <small class="text-muted">
            alwaystay &copy; 2023 期待和你相遇
        </small>
    </p>
    </center>   
        </div>
     </div>
     
  
     
   <div v-else class="login-wrapper layui-anim layui-anim-scale">
        <div class="layui-form">
            <h2>用户注册</h2>
             <div class="layui-form-item layui-input-icon-group">
                <i class="layui-icon layui-icon-release"></i>
                <input class="layui-input" name="text" v-model="reg.name" placeholder="请输入昵称" type="text" lay-verType="tips"
                    lay-verify="equalTo" required />
            </div>
            <div class="layui-form-item layui-input-icon-group">
                <i class="layui-icon layui-icon-link"></i>
                <input class="layui-input" name="Invitation" v-model="reg.yqm" placeholder="请输入邀请码" autocomplete="off" lay-verType="tips"
                    lay-verify="required" required />
            </div>

            <div class="layui-form-item layui-input-icon-group">
                <i class="layui-icon layui-icon-username"></i>
                <input class="layui-input" name="user" v-model="reg.user" placeholder="请输入账号(QQ号)" autocomplete="off"
                    lay-verType="tips" lay-verify="required|email" required />
            </div>

            <div class="layui-form-item layui-input-icon-group">
                <i class="layui-icon layui-icon-password"></i>
                <input class="layui-input" name="password" v-model="reg.pass" placeholder="请输入登录密码" type="text" lay-verType="tips"
                    lay-verify="required|psw" required />
            </div>
           

            <div class="layui-form-item">
                <a @click="newlogin" class="layui-link">返回登录</a>
            </div>
            <div class="layui-form-item" style="margin-bottom: 20px;">
                <button  class="layui-btn layui-btn-fluid layui-bg-black" 
                    lay-submit  @click="register">注册</button>
            </div>
        </div>
    </div>
    
    
   </div>



<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="layer/3.1.1/layer.js"></script>
<script src="https://cdn.staticfile.org/vue/2.6.11/vue.min.js"></script>
<script src="https://cdn.staticfile.org/vue-resource/1.5.1/vue-resource.min.js"></script>
<script src="https://cdn.staticfile.org/axios/0.18.0/axios.min.js"></script>
<!--script>
    var img = document.querySelector('.layui-fluid');
    var audio = document.createElement('audio');
    audio.src = 'http://api.1o.pw/api/wyjx?id=1406642934';
    audio.autoplay = true;
    document.body.appendChild(audio);
</script-->
<script>
    var vm = new Vue({
        el: "#login1",
        data: {
            loginType: true,
            title: "你在看什么呢？我写的代码好看吗",
            dl: {},
            reg: {}
        },
        methods: {
            newlogin: function() {
                this.loginType = !this.loginType
            },
            login: function() {
                if (!this.dl.user || !this.dl.pass) {
                    layer.msg('账号密码不能为空', {
                        icon: 2
                    });
                    return
                }
                var loading = layer.load();
                vm.$http.post("/apisub.php?act=login", {
                    user: this.dl.user,
                    pass: this.dl.pass
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
                    layer.msg('所有项不能为空', {
                        icon: 2
                    });
                    return
                }
                var loading = layer.load();
                this.$http.post("/apisub.php?act=register", {
                    name: this.reg.name,
                    user: this.reg.user,
                    pass: this.reg.pass,
                    yqm: this.reg.yqm
                }, {
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
<script type="text/javascript">
    /* 鼠标特效 */
    var a_idx = 0;
    jQuery(document).ready(function($) {
        $("body").click(function(e) {
            var a = new Array("富强","民主","文明","和谐","自由","平等","公正","法治","爱国","敬业","诚信","友善");
            var $i = $("<span />").text(a[a_idx]);
            a_idx = (a_idx + 1) % a.length;
            var x = e.pageX
              , y = e.pageY;
            $i.css({
                "z-index": 999999999999999999999999999999999999999999999999999999999999999999999,
                "top": y - 20,
                "left": x,
                "position": "absolute",
                "font-weight": "bold",
                "color": "#ff6651"
            });
            $("body").append($i);
            $i.animate({
                "top": y - 180,
                "opacity": 0
            }, 1500, function() {
                $i.remove();
            });
        });
    });
</script>
