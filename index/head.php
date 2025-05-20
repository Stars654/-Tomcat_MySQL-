<?php
include('../confing/common.php');

if($islogin!=1){exit("<script language='javascript'>window.location.href='login';</script>");  }
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
<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
<link rel="stylesheet" href="assets/css/apps.css" type="text/css" />
<link rel="stylesheet" href="assets/css/app.css" type="text/css" />
<link rel="stylesheet" href="assets/layui/css/layui.css" type="text/css" />
<link rel="stylesheet" href="css/oksub.css">
<!--<link href="http://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="assets/LightYear/js/bootstrap-multitabs/multitabs.min.css">
<link href="assets/LightYear/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/LightYear/css/style.min.css" rel="stylesheet">
<link href="assets/LightYear/css/materialdesignicons.min.css" rel="stylesheet">
<script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
<script src="layer/3.1.1/layer.js"></script>



    <script src="assets/js/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="assets/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="assets/css/element.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- 弹窗组件 -->
    <link rel="stylesheet" href="assets/layer/3.1.1/theme/default/layer.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/apps.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/app.css" type="text/css" />
    <link rel="stylesheet" href="assets/layui/css/layui.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/LightYear/js/bootstrap-multitabs/multitabs.min.css">
    <link rel="stylesheet" href="assets/LightYear/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/LightYear/css/style.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/LightYear/css/materialdesignicons.min.css">
    <script src="assets/layer/3.1.1/layer.js"></script>

</head>
<?php
if($userrow['active']=="0"){
alert('您的账号已被封禁！','login');
}
?>
<body>
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
<!--<body style="background-image: url('assets/images/background.jpg'); background-attachment: scroll;">-->
<!--</body>-->