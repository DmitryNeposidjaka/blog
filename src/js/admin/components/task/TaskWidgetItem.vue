<template>
    <div class="task-item-wrapper">
        <el-dialog
                title="Редактирование"
                :visible.sync="dialogEdit"
                width="40%">
            <task-form :task="item" type="edit"/>
            <span slot="footer" class="dialog-footer">
                <el-button @click="dialogEdit = false">Отмена</el-button>
                <el-button type="primary" @click="$events.emit('editTask')">Поставить</el-button>
            </span>
        </el-dialog>
        <el-dialog
                title="Просмотр"
                :visible.sync="dialogVisible"
                width="40%">
            <task-view
                :model="item"
                :priority="tag"
                v-on:taskEditClicked="editTask()"
                v-on:taskDeleteClicked="deleteTask()"
            />
        </el-dialog>
        <el-row class="task-widget-item" >
            <div @click="dialogVisible=true">
            <el-col :span="3">
                <el-tag size="mini" :type="tag.type" style="margin-right: 5px">{{tag.name}}</el-tag>
            </el-col>

                <el-col :span="19">
                    <span>{{ item.title }}</span>
                </el-col>
            </div>

            <el-col :span="2">
                <done v-on:taskDoneClicked="doneTask()"/>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    import Done from './TaskDone';
    import TaskView from './TaskView';
    import TaskForm from './TaskForm';
export default {
  props: ['item'],
  data(){
    return{
      dialogVisible: false,
      dialogEdit: false,
      tags: [
        {id: 'MAX', name: 'важно', type: 'danger'},
        {id: 'MIDDLE', name: 'нормально', type: 'primary'},
        {id: 'MIN', name: 'мин', type: 'success'},
      ]
    }
  },
  computed: {
    tag(){
      return this.tags.find(x => this.item.important == x.id)
    }
  },
  methods:{
    editTask(){
      this.dialogVisible = false;
      this.dialogEdit = true;
    },
    deleteTask(){
      this.sendDelete()
    },
    doneTask(){
        this.sendDone();
    },
    sendDelete(){
      const vm = this;
      vm.axios({
        method: 'delete',
        url: '/task/' + this.item.id,
      }).then(function (response) {
        if(response.status == 200){
          vm.$events.emit('updateTask', response.data);
          vm.dialogVisible = false;
        }
      });
    },
    sendDone(){
      const vm = this;
      vm.axios({
        method: 'get',
        url: '/task/close/' + this.item.id,
      }).then(function (response) {
        if(response.status == 200){
          vm.$events.emit('updateTask', response.data);
        }
      });
    }
  },
  created(){
    this.$events.on('updateTask', () => {this.dialogEdit = false});
  },
  components: {Done,TaskView,TaskForm}
}
</script>

<style>
.task-widget-item{
    padding: 10px;
    width: 100%;
    min-height: 20px;
    color: #9c27b0;
    border-bottom: 1px solid #eaeaea;
}
</style>