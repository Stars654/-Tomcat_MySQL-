


<!DOCTYPE html>
<link rel="stylesheet" href="https://lib.baomitu.com/layui/2.9.6/css/layui.min.css" media="all">

<script src="https://lib.baomitu.com/vue/2.7.7/vue.min.js"></script>

<link href="https://lib.baomitu.com/element-ui/2.15.14/theme-chalk/index.min.css" rel="stylesheet">
<script src="https://lib.baomitu.com/element-ui/2.15.14/index.min.js"></script>

<div id="monitor">
    <div class="layui-panel">
        <div style="padding: 15px;">
            <h3 style="text-align:Center;"><i class="layui-icon layui-icon-chart"></i> 监控中心</h3>
        </div>
    </div>
    <br />
    <!--device().mobile-->
    <div class="layui-panel">
        <div style="padding: 10px 13px;font-size:12px;">
            8秒自动更新一次
        </div>
    </div>
    <br />
    <div class="monitorBox">

        <el-collapse style="min-height:100px" v-loading="!list.length" :value='!device().mobile?[0,1,2,3]:[0]' class="layui-collapse layui-row layui-col-space2">
            <el-row>
                <el-col :xs="24" :sm="8" :md="6" v-if="list.length>0" v-for="(item,index) in list" :key="index">
                    <el-collapse-item class=" layui-colla-item" :name="index" style="margin: 0 2px 5px;">
                        <template slot="title">
                            <i class="layui-icon layui-icon-loading-1 layui-anim layui-anim-rotate layui-anim-loop"></i>&nbsp;{{item.type}}&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:red;">监控中</font>
                        </template>
                        <div style="max-height:400px;overflow: auto;">

                            <template v-if="index==1 && !uid">
                                <pre class="layui-code code-demo" lay-options="{theme: 'dark'}" style="white-space: pre-line;">
        						    权限不足 ，不允查看
        						</pre>
                            </template>
                            <template v-else>
                                <pre class="layui-code code-demo" lay-options="{theme: 'dark'}" style="white-space: pre-line;">
                                {{item.log?item.log:'暂无'}}
                                </pre>
                            </template>

                        </div>
                    </el-collapse-item>
                </el-col>
            </el-row>
        </el-collapse>

    </div>

</div>

<script src="https://lib.baomitu.com/axios/1.6.7/axios.min.js"></script>
<script src="https://lib.baomitu.com/layui/2.9.6/layui.min.js"></script>


<script>
</script>
<script>
    function device() {
        return layui.device()
    }
    var vm = new Vue({
        el: "#monitor",
        data: {
            uid: '1' === '1' ? true : false,
            list: [],
        },
        mounted() {
            this.fetchMonitor();
            setInterval(this.fetchMonitor, 8000);
        },
        methods: {
            fetchMonitor: function() {
                const _this = this;
                axios.get('/redis/monitor.php')
                    .then(function(response) {
                        _this.list = response.data
                    })
                    .catch(function(error) {
                        layer.msg('数据加载失败！');
                        console.error('Error fetching monitor data:', error);
                    });
            }
        }
    })
</script>
<style>
    #monitor {
        min-height: 100vh;
        margin: 10px;
    }

    .monitorBox {
        background: #fff;
    }

    .layui-collapse {
        border: 0;
    }

    .el-collapse-item {
        margin: 0 0 10px;
        border: 1px solid #ebeef5;
        border-top: 1px solid #ebeef5 !important;
    }

    .el-collapse-item__header {
        padding: 0 5px;
    }

    .el-collapse-item__content {
        padding-bottom: 0;
    }

    @media screen and (min-width: 768px) {
        .layui-col-sm3 {
            width: 24% !important;
        }
    }
</style>