<template>
    <el-row>
        <el-dialog
                title="Поставить новое задание"
                :visible.sync="dialogVisible"
                width="50%"
                :before-close="handleClose">
            <task-form></task-form>
            <span slot="footer" class="dialog-footer">
                <el-button @click="dialogVisible = false">Отмена</el-button>
                <el-button type="primary" @click="createTask">Поставить</el-button>
            </span>
        </el-dialog>
        <el-card class="box-card">
            <div slot="header" class="clearfix">
                <span>Задачи</span>
                <el-button style="float: right; padding: 5px 5px" type="success" @click="dialogVisible = true">Добавить новую</el-button>
            </div>
            <task-table
                    :models="tasks"
                    :categories="[]"
                    :tags="[]"
            ></task-table>
            <div class="paginator">
                <el-pagination
                        :page-size="paginator.per_page"
                        :pager-count="5"
                        @current-change="handleCurrentChange"
                        layout="prev, pager, next"
                        :total="paginator.total">
                </el-pagination>
            </div>
        </el-card>
    </el-row>
</template>

<script>
  import TaskTable from './task/TaskTable';
  import {mapGetters} from 'vuex';
  import {mapActions} from 'vuex';
  import TaskForm from './task/TaskForm';

  export default {
    data(){
      return {
        dialogVisible: false,
        tasks: [],
        paginator: {
          current_page: 1,
          first_page_url: null,
          from: 1,
          last_page: 1,
          last_page_url: null,
          next_page_url: null,
          path: null,
          per_page: 20,
          prev_page_url: null,
          to: null,
          total: null
        }
      }
    },
    computed:{
    },
    methods:{
      ...mapActions('tasks', [
        'addTask',
        'updateTask'
      ]),
      handleClose(done) {
        this.$confirm('Отменить добавление ?')
          .then(_ => {
            done();
          })
          .catch(_ => {});
      },
      createTask(){
        this.$events.emit('createTask');
      },
      closeModal(){
        this.dialogVisible = false;
      },
      handleCurrentChange(val){
        this.getData(val);
      },
      setData(data){
        this.tasks = data
      },
      setPaginator(data){
        this.paginator = data
      },
      getData(page = 1){
        const vm = this;
        this.axios({
          method: 'get',
          url: '/task-pager',
          params: {page: page}
        }).then(function (response) {
          if(response.status == 200){

            vm.setData(response.data.data)
            delete response.data.data
            vm.setPaginator(response.data)
          }
        });
      }
    },
    created(){
      const vm = this;
      this.getData();
      this.$events.on('addTask', (data) => {
        vm.addTask(data);
        vm.closeModal();
      });
      this.$events.on('updateTask', (data) => {
        vm.updateTask(data);
        vm.closeModal();
      });
    },
    components: { TaskTable, TaskForm}
  }
</script>

<style>
.paginator{
    width: 550px;
    margin: auto;
}
</style>