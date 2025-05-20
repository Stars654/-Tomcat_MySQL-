<?php
$mod='blank';
$separately = '//unpkg.com/element-ui@2.15.10/lib/theme-chalk/index.css';
require_once('header.php');
?>

<div id="demo">
    <el-table :data="studentList">
            <!-- 循环列表内容 -->
            <el-table-column  :label= "item.label" :prop= "item.prop" v-for="(item, index) in columns" :key="index" :align="item.align" >
            </el-table-column>
            <!-- 操作可以是一个固定的列 -->
             <el-table-column label="操作" prop="action" align="center">
              <template  slot-scope="scope">
                <el-button @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                <el-button >删除</el-button>
              </template>
            </el-table-column>
          </el-table>
</div>
          


<?php require_once("footer.php");?>

<script src="//unpkg.com/element-ui@2.15.10/lib/index.js"></script>

<script>
const vm = new Vue({
  el: "#demo",
  data: {
    studentList: [],
    columns: [
      {
        label: "姓名",
        prop: "name",
        align: "center"
      },
      {
        label: "年龄",
        prop: "age",
        align: "center"
      },
      {
        label: "地址",
        prop: "address",
        align: "center"
      }
    ]
  },
  mounted: function () {
    this.getStudent();
    console.log(this.columns);
  },
  methods: {
    // 获取学生列表
    getStudent() {
      this.$axios.get("/api/studentList").then((result) => {
        console.log(result.data);
        this.studentList = result.data;
      });
    },
    handleEdit(index, row) {
      // JSON.stringify 将对象转换成字符串
      alert(JSON.stringify(row));
    }
  }
});
</script>