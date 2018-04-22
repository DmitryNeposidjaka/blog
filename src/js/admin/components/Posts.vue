<template>
        <el-row>
            <el-dialog
                    title="Новая статья"
                    :visible.sync="dialogVisible"
                    width="50%"
                    :before-close="handleClose">
                <div>
                    <span></span>
                    <post-form>

                    </post-form>
                </div>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="handleClose">Отменить</el-button>
                    <el-button type="primary" @click="dialogVisible = false">Создать</el-button>
                </span>
            </el-dialog>

            <el-card class="box-card">
                <div slot="header" class="clearfix">
                    <span>Статьи</span>
                    <el-button style="float: right; padding: 5px 5px" type="success" @click="dialogVisible = true">Добавить новую</el-button>
                </div>
            <el-table
                    :data="tableData"
                    style="width: 100%">
                <el-table-column
                        prop="date"
                        label="Date"
                        width="180">
                </el-table-column>
                <el-table-column
                        prop="name"
                        label="Name"
                        width="180">
                </el-table-column>
                <el-table-column
                        prop="address"
                        label="Address">
                </el-table-column>
            </el-table>
            </el-card>
        </el-row>
<!--    <el-button v-on:click="send">SEND</el-button>-->
</template>

<script>
  import PostForm from './PostFrom';

export default {
  data(){
    return {
      dialogVisible: false,
      tableData: [{
        date: '2016-05-03',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-02',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-04',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-01',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }]
    }
  },
  methods: {
    send(){
      this.axios({
        method:'GET',
        url: '/posts/2',
      })
    },
    handleClose(done) {
      this.$confirm('Данные будут потеряны')
        .then(_ => {
          this.dialogVisible = false;
          done();
        })
        .catch(_ => {});
    }
  },
  created(){
    console.log(this)
  },
  components: {PostForm}
}
</script>

<style>

</style>