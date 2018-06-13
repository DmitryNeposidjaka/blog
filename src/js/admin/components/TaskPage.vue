<template>
    <el-row>
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
      this.getData();
    },
    components: { TaskTable}
  }
</script>

<style>
.paginator{
    width: 550px;
    margin: auto;
}
</style>