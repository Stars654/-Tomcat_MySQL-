<?php
$mod='blank';
$title='课程ID对比';
require_once('head.php');
?>

<body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
<script type="text/javascript">
    // /* 鼠标特效 */
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
</script> <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/layui/dist/css/layui.css" media="all">
    <style>
        .app-content-body {
            background-color: #f2f2f2; /* 背景颜色 */
            padding: 20px; /* 内边距 */
        }

        .control-header {
            display: flex; /* 使用Flex布局 */
            align-items: center; /* 垂直居中 */
            justify-content: space-between; /* 元素间隔均匀分布 */
            background-color: #fff; /* 背景颜色改为白色 */
            padding: 10px 20px; /* 内边距 */
            border-radius: 7px; /* 圆角 */
            box-shadow: 3px 3px 8px #d1d9e6, -3px -3px 8px #d1d9e6; /* 阴影 */
            margin-bottom: 20px; /* 与下方元素的间距 */
        }

        .panel {
            background-color: #fff; /* 面板背景颜色 */
            border-radius: 7px; /* 圆角 */
            padding: 20px; /* 内边距 */
            box-shadow: 3px 3px 8px #d1d9e6, -3px -3px 8px #d1d9e6; /* 阴影 */
        }

        .layui-btn {
            background-color: #5FB878; /* 按钮颜色 */
            color: #fff; /* 按钮文字颜色 */
            border-radius: 5px; /* 按钮圆角 */
        }

        .layui-input {
            border-radius: 5px; /* 输入框圆角 */
            border: 1px solid #e6e6e6; /* 输入框边框颜色 */
        }

        .table-responsive {
            overflow-x: auto; /* 如果表格宽度超出容器宽度，可横向滚动 */
        }
    </style>
</head>
<body>

<div class="app-content-body">
    <div class="wrapper-md control">        
        <div class="row">
            <div class="col-sm-12">
                <div class="control-header">
                    <div class="panel-heading font-bold">课程ID对比</div>
                    <div>
                        <div class="layui-inline">
                            <input class="layui-input" name="searchOid" id="searchOid" placeholder="搜索订单ID">
                        </div>
                        <div class="layui-inline">
                            <input class="layui-input" name="searchUser" id="searchUser" placeholder="搜索账号">
                        </div>
                        <button class="layui-btn" id="searchBtn">搜索</button>
                    </div>
                </div>
                <div class="panel">    
                    <div class="table-responsive"> 
                        <table class="layui-hide" id="kcidlist"></table>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</div>


<script src="assets/js/aes.js"></script>
<script src="assets/layui/layui.js"></script>
<script>
layui.use(['table', 'jquery'], function(){
    var table = layui.table;
    var $ = layui.jquery;
  
    // 初始化表格
    var inst = table.render({
        elem: '#kcidlist',
        url: '../apisub.php?act=kcidlist',
        response: {
            statusCode: 1 // 重新规定成功的状态码为 200，table 组件默认为 0
        },
        parseData: function(res){ // 将原始数据解析成 table 组件所规定的数据
            return {
                "code": "1", //解析接口状态
                "msg": "", //解析提示文本
                "count": res.count, //解析数据长度
                "data": res.data //解析数据列表
            };
        },
        page: {
            layout: ['prev', 'page', 'next', 'limit'], //自定义分页布局
            groups: 5, //只显示 1 个连续页码
            first: '首页', //不显示首页
            last: '尾页', //不显示尾页
            limits: [20, 50, 100],
            theme: '#1E9FFF',
            limit: 20 // 每页默认显示的数量
        },
        cols: [[ //标题栏
            {field: 'oid', title: '订单ID', width: 95,},
            {field: 'ptname', title: '商品名称', width: 240},
            {field: 'user', title: '下单账号', width: 150, minWidth: 100},
            {field: 'kcname', title: '课程名称', width: 400},
            {field: 'kcid', title: '课程ID', width: 200},
            {field: 'addtime', title: '提交时间', width: 250},
            {field: 'status', title: '订单状态', width: 250}
        ]],
    });
  
    // 搜索按钮点击事件
    $('#searchBtn').on('click', function(){
        // 使用表格重载功能，传入新的参数
        inst.reload({
            where: { //设定异步数据接口的额外参数
                oid: $('#searchOid').val(), // 订单ID搜索条件
                user: $('#searchUser').val() // 账号搜索条件
            },
            page: {
                curr: 1 // 重新从第 1 页开始
            }
        });
    });
});
</script>