<?php
include('../confing/common.php');
if(!file_exists('../install/install.lock')){
    header('location:/install/');
}
if($islogin!=1){exit("<script language='javascript'>window.location.href='login';</script>");}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title><?=$conf['sitename']?></title>
<meta name="keywords" content="<?=$conf['keywords'];?>" />
<meta name="description" content="<?=$conf['description'];?>" />
<link rel="icon" href="../favicon.ico" type="image/ico">
<meta name="author" content=" ">
<script src="assets/layui/js/jquery.min.js"></script>
<script src="layer/3.1.1/layer.js"></script>
<link rel="stylesheet" href="assets/layuiadmin/layui/css/layui.css" media="all">
<link rel="stylesheet" href="assets/layuiadmin/style/admin.css" media="all">
<link href="assets/css/style.css" rel="stylesheet">
<?php if ($separately != '') {?>
<link href="<?=$separately;?>" rel="stylesheet">
<? } ?>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/layuiadmin/layui/layui.js"></script>
</head>
<?php
if($userrow['active']=="0"){
alert('您的账号已被封禁！','login');
}
?>
<body id="content"></body>
<script type="text/javascript">
    /* 鼠标特效 */
    // var a_idx = 0;
    // jQuery(document).ready(function($) {
    //     $("body").click(function(e) {
    //         var a = new Array("富强","民主","文明","和谐","自由","平等","公正","法治","爱国","敬业","诚信","友善");
    //         var $i = $("<span />").text(a[a_idx]);
    //         a_idx = (a_idx + 1) % a.length;
    //         var x = e.pageX
    //           , y = e.pageY;
    //         $i.css({
    //             "z-index": 999999999999999999999999999999999999999999999999999999999999999999999,
    //             "top": y - 20,
    //             "left": x,
    //             "position": "absolute",
    //             "font-weight": "bold",
    //             "color": "#ff6651"
    //         });
    //         $("body").append($i);
    //         $i.animate({
    //             "top": y - 180,
    //             "opacity": 0
    //         }, 1500, function() {
    //             $i.remove();
    //         });
    //     });
    // });
</script>
<script type="text/javascript">
      //禁止鼠标右击
      document.oncontextmenu = function() {
        event.returnValue = false;
      };
      //禁用开发者工具F12
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
<!--<body style="background-image: url('assets/images/background.jpg'); background-attachment: scroll;">-->
<!--</body>-->