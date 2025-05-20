<?php
include('head.php');
?>

<!DOCTYPE html>
<html lang="zh">

<body>
  <div class="layui-container" style="padding: 20px;" id="xj">
    <div class="layui-row" style="margin-bottom: 15px;">
            <div class="layui-card">
                <div class="layui-card-header" style="background-color: #F2F2F2; font-weight: bold;">下架专区【暂停对接】</div>
                <div class="layui-card-body">
            <table class="layui-table"style="table-layout: fixed; width: 100%;">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">项目名称</th>
                                    <!--<th>时间</th>-->
                                    <th style="text-align: center;">课程ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in aaaRankList">
                                    <td style="text-align: center;">{{ item.name }}</td>
                                    <!--<td>{{ item.addtime }}</td>-->
                                    <td style="text-align: center;">{{ item.cid }}</td>
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
                el: "#xj",
                data: {
                    row: null,
                    inte: "",
                    rankList: [],
                    aaaRankList: [],
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
                        this.$http.post('/apisub.php?act=aaaclassrank').then(function (data) {
                          layer.close(load);
                            if (data.data.code == 1) {
                                this.aaaRankList = data.data.data; // 修改为 data.data
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
