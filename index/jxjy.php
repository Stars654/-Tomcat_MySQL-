<?php
$title = '继续教育';
require_once('head.php');
if ($userrow['uid'] < '1') {
    exit("<script language='javascript'>window.location.href='/login.php';</script>");
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>继续教育</title>
  <meta name="renderer" content="webkit">
  <meta name="referrer" content="never">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!--<link rel="stylesheet" href="/assets/layui/css/admin.css" media="all">-->
  <link rel="stylesheet" href="/assets/layui/css/layui.css" media="all">
</head>

<body>

<div class="layui-fluid">
    <div class="layui-row layui-col-space10">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body">
                    <form class="layadmin-backlog layui-form layui-form-pane" id="searchForm">
                        <div class="layui-form-item">
                            <label class="layui-form-label"><i class="layui-icon layui-icon-website"></i> 网站</label>
                            <div class="layui-input-block">
                                <input type="text" id="siteinfo" name="siteinfo" placeholder="可输入站名、地址或备注查询" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <button type="button" class="layui-btn layui-btn-sm" id="submit">
                                    <i class="layui-icon">&#xe609;</i> 查询数据
                                </button>
                                <button type="reset" class="layui-btn layui-btn-sm layui-btn-primary" id="reset">
                                    <i class="layui-icon">&#xe9aa;</i> 重置选项
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">本类项目需工单联系客服人工录单</div>
                <div class="layui-card-body">
                    <div class="layadmin-backlog">
                        <table id="sitelist" lay-filter="sitelist"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .layui-table-cell {
        height: auto;
        white-space: normal;
    }

    .siterow {
        height: 38px;
        line-height: 38px;
    }

    .yes {
        color: #4caf50;
    }

    .url {
        color: #009688;
    }
</style>
<?php require_once("footer.php"); ?>
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.js"></script>
<script src="/assets/layui/layui.js" charset="utf-8"></script>
<script src="lib/layui/layui.js"></script>
<script src="assets/js/aes.js"></script>
<script src="js/vue.min.js"></script>
<script src="js/vue-resource.min.js"></script>
<script src="assets/layui/js/axios.min.js"></script>
<script type="text/html" id="examTpl">
    <div class="siterow">
        {{# if (d.exam == 1){ }}
        <i class="layui-icon layui-icon-ok-circle yes"></i>
        {{# } }}
    </div>
</script>
<script type="text/html" id="feeTpl">
    {{d.fee}} 份 / {{ d.unit==''?'学时':d.unit}}
</script>
<script type="text/html" id="urlTpl">
    <a href="{{d.url}}" target="_blank" class="url" title="点击可以访问">{{d.url}}</a>
</script>
<script>
    layui.use(['table', 'form'], function() {
        var table = layui.table;
        var form = layui.form;

        // 渲染表格
        var tableIns = table.render({
            elem: '#sitelist',
            id: 'sitelist',
            method: 'post',
            url: 'api.php',

            cols: [
                [{
                        title: '平台名称',
                        field: 'name',
                        align: 'center',
                        minWidth: 150
                    },
                    {
                        title: '备注说明',
                        field: '时长',
                        align: 'center',
                        minWidth: 200
                    },
                    
                    {
                        title: '地址(点击访问)',
                        field: 'url',
                        align: 'center',
                        minWidth: 200,
                        templet: '#urlTpl'
                    },
                ]
            ]
        });

        // 监听查询按钮点击事件
        $("#submit").on('click', function() {
            // 获取搜索关键字
            var keyword = $("#siteinfo").val().trim();
            // 判断是否输入了关键字
            if (keyword === '') {
                layer.msg('请输入关键字', {
                    icon: 0
                });
                return false; // 不执行查询操作
            }
            // 重新加载表格数据
            table.reload('sitelist', {
                method: 'post',
                where: {
                    siteinfo: keyword // 将搜索关键字作为参数传递到后端API
                },
            });
        });

        // 监听表单重置按钮点击事件
        $("#reset").on('click', function() {
            // 清空搜索框内容
            $("#siteinfo").val('');
            // 刷新页面
            location.reload();
        });

        // 监听表单提交事件
        form.on('submit(formSearch)', function(data) {
            // 阻止表单提交的默认行为
            return false;
        });
    });
</script>

</body>

</html>
