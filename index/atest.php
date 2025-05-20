<?php
include('head.php');
?>

<!DOCTYPE html>
<html lang="zh">

<body>
  <div class="layui-container" style="padding: 20px;" id="sx">
    <div class="layui-row" style="margin-bottom: 15px;">
            <div class="layui-card">
                <div class="layui-card-header" style="background-color: #F2F2F2; font-weight: bold;">最新上架【8天内】</div>
                <div class="layui-card-body">
            <table class="layui-table"style="table-layout: fixed; width: 100%;">
                            <thead>
                                <tr>
                                    <th>平台名称</th>
                                    <th>时间</th>
                                    <th>课程ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in newRankList">
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.addtime }}</td>
                                    <td>{{ item.cid }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once("footer.php"); ?>
    
        <script>
         
      

            var vm = new Vue({
                el: "#sx",
                data: {
                    row: null,
                    inte: "",
                    rankList: [],
                    newRankList: [],
                    orderList: [],
                },
                methods: {
                    userinfo: function () {
                        var load = layer.load();
                        this.$http.post("/apisub.php?act=userinfo").then(function (data) {
                            layer.close(load);
                            if (data.data.code == 1) {
                                this.row = data.data.data; // 修改为 data.data
                            } else {
                                layer.alert(data.data.msg, { icon: 2 });
                            }
                        });
                    },
                    getnewclassrank: function () {
                        var load = layer.load(2);
                        this.$http.post('/apisub.php?act=newclassrank').then(function (data) {
                          layer.close(load);
                            if (data.data.code == 1) {
                                this.newRankList = data.data.data; // 修改为 data.data
                            } else {
                                layer.msg(data.data.msg, { icon: 2 });
                            }
                        });
                    },
                    getrank: function () {
                        var load = layer.load(2);
                        this.$http.post('/apisub.php?act=getclassrank').then(function (data) {
                            layer.close(load);
                            if (data.data.code == 1) {
                                this.rankList = data.data.data; // 修改为 data.data
                            } else {
                                layer.msg(data.data.msg, { icon: 2 });
                            }
                        });
                    },
                },
                created() {
                    this.getnewclassrank();
                }
            });
        </script>
    </div>
</body>

</html>
