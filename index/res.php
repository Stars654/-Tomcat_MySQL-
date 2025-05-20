<?php
include('header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>资源下载</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://layuimini.99php.cn/iframe/v2/lib/layui-v2.5.5/css/layui.css" media="all">
    <link rel="stylesheet" href="https://layuimini.99php.cn/iframe/v2/lib/font-awesome-4.7.0/css/font-awesome.min.css" media="all">
    <link rel="stylesheet" href="https://layuimini.99php.cn/iframe/v2/css/public.css" media="all">
    <style>
        .layui-card {border:1px solid #f2f2f2;border-radius:5px;}
        .icon {margin-right:10px;color:#1aa094;}
        .icon-cray {color:#ffb800!important;}
        .icon-blue {color:#1e9fff!important;}
        .icon-tip {color:#ff5722!important;}
        .layuimini-qiuck-module {text-align:center;margin-top: 10px}
        .layuimini-qiuck-module a i {display:inline-block;width:100%;height:60px;line-height:60px;text-align:center;border-radius:2px;font-size:30px;background-color:#F8F8F8;color:#333;transition:all .3s;-webkit-transition:all .3s;}
        .layuimini-qiuck-module a cite {position:relative;top:2px;display:block;color:#666;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;font-size:14px;}
        .welcome-module {width:100%;height:210px;}
        .panel {background-color:#fff;border:1px solid transparent;border-radius:3px;-webkit-box-shadow:0 1px 1px rgba(0,0,0,.05);box-shadow:0 1px 1px rgba(0,0,0,.05)}
        .panel-body {padding:10px}
        .panel-title {margin-top:0;margin-bottom:0;font-size:12px;color:inherit}
        .label {display:inline;padding:.2em .6em .3em;font-size:75%;font-weight:700;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:baseline;border-radius:.25em;margin-top: .3em;}
        .layui-red {color:red}
        .main_btn > p {height:40px;}
        .layui-bg-number {background-color:#F8F8F8;}
        .layuimini-notice:hover {background:#f6f6f6;}
        .layuimini-notice {padding:7px 16px;clear:both;font-size:12px !important;cursor:pointer;position:relative;transition:background 0.2s ease-in-out;}
        .layuimini-notice-title,.layuimini-notice-label {
            padding-right: 70px !important;text-overflow:ellipsis!important;overflow:hidden!important;white-space:nowrap!important;}
        .layuimini-notice-title {line-height:28px;font-size:14px;}
        .layuimini-notice-extra {position:absolute;top:50%;margin-top:-8px;right:16px;display:inline-block;height:16px;color:#999;}
    </style>
</head>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">

                <div class="layui-card">
                    <div class="layui-card-header">资源列表</div>
                    <div class="layui-card-body layui-text"><hr>
                        <div class="layuimini-notice">
                            <div class="layuimini-notice-title">修改密码，暂停，秒刷接口</div>
                            <div class="layuimini-notice-extra">2024-4-6</div>
                            <div class="layuimini-notice-content layui-hide">里面是对接文档接口 自己慢慢看，只要源台支持，就可以加入这些</div>
                            <div class="layuimini-notice-url layui-hide">../assets/download/more学习平台修改密码，暂停，秒刷接口.zip</div>
                        </div><hr><div class="layuimini-notice">
                            <div class="layuimini-notice-title">1000u智慧树接口</div>
                            <div class="layuimini-notice-extra">2024-4-6</div>
                            <div class="layuimini-notice-content layui-hide">以前倒腾出来的库存，能用 你们自己看吧</div>
                            
                            
                            <div class="layuimini-notice-url layui-hide">../assets/download/1000u对接29.zip</div>
                        </div><hr>
                        <div class="layuimini-notice">
                            <div class="layuimini-notice-title">29销量统计代码</div>
                            <div class="layuimini-notice-extra">2024-4-6</div>
                            <div class="layuimini-notice-content layui-hide">可能有些模板资源不适配，自己改一下ui就行</div>
                            <div class="layuimini-notice-url layui-hide">../assets/download/xlph.zip</div>
                        </div><hr>                    
                        
                        <div class="layuimini-notice">
                            <div class="layuimini-notice-title">29货源销量统计代码</div>
                            <div class="layuimini-notice-extra">2024-4-28</div>
                            <div class="layuimini-notice-content layui-hide">上传到index目录下面，访问这个，你就明白了</div>
                            <div class="layuimini-notice-url layui-hide">../assets/download/ddtj.zip</div>
                        </div><hr> 
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        </div>
                </div>

            </div>
        </div>
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
<script src="http://layuimini.99php.cn/iframe/v2/js/lay-config.js?v=1.0.4" charset="utf-8"></script>
<script>
    layui.use(['layer', 'miniTab','echarts'], function () {
        var $ = layui.jquery,
            layer = layui.layer,
            miniTab = layui.miniTab,
            echarts = layui.echarts;

        miniTab.listen();

        /**
         * 查看公告信息
         **/
        $('body').on('click', '.layuimini-notice', function () {
            var title = $(this).children('.layuimini-notice-title').text(),
                noticeTime = $(this).children('.layuimini-notice-extra').text(),
                url = $(this).children('.layuimini-notice-url').text(),
                content = $(this).children('.layuimini-notice-content').html();
            var html = '<div style="padding:15px 20px; text-align:justify; line-height: 22px;border-bottom:1px solid #e2e2e2;background-color: #2f4056;color: #ffffff">\n' +
                '<div style="text-align: center;margin-bottom: 20px;font-weight: bold;border-bottom:1px solid #718fb5;padding-bottom: 5px"><span style="color: #b1b3b9;margin-top: 1px">' + title + '</span></div>\n' +
                '<div style="font-size: 12px">' + content + '</div>\n' +
                '</div>\n';
            parent.layer.open({
                type: 1,
                title: title+'<span style="float: right;right: 1px;font-size: 12px;color: #b1b3b9;margin-top: 1px">'+noticeTime+'</span>',
                area: '300px;',
                shade: 0.8,
                id: 'layuimini-notice',
                btn: ['立即下载', '关闭'],
                btnAlign: 'c',
                moveType: 1,
                content:html,
                success: function (layero) {
                    var btn = layero.find('.layui-layer-btn');
                    btn.find('.layui-layer-btn0').attr({
                        href: url,
                        target: '_blank'
                    });
                }
            });
        });

    });
</script>
</body>
</html>
