<template>
    <el-row>
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
        <!-- Диалог Удаление -->
        <el-dialog
                title="Удалить статью"
                :visible.sync="dialogDelete"
                width="30%"
                center>
            <span slot="footer" class="dialog-footer">
                <el-button @click="deleteTask()">Удалить</el-button>
                <el-button type="primary" @click="dialogDelete = false">Отменить</el-button>
            </span>
        </el-dialog>
        <!-- Диалог Восстановление -->
        <el-dialog
                title="Восстановить статью"
                :visible.sync="dialogGetBack"
                width="30%"
                center>
            <span slot="footer" class="dialog-footer">
                <el-button @click="getBackTask()">Восстановить</el-button>
                <el-button type="primary" @click="dialogGetBack = false">Отменить</el-button>
            </span>
        </el-dialog>
        <!-- Кнопки -->
        <el-button
                size="mini"
                type="primary"
                icon="el-icon-view"
                title="Просмотреть"
                @click="dialogVisible = true"
                plain></el-button>
        <el-button
                size="mini"
                type="warning"
                icon="el-icon-edit"
                title="Редактировать"
                @click="dialogEdit = true"
                plain></el-button>
        <el-button v-if="!item.disabled"
                size="mini"
                type="danger"
                icon="el-icon-delete"
                title="Удалить"
                @click="dialogDelete = true"
                plain></el-button>
        <el-button v-if="item.disabled"
                size="mini"
                type="success"
                icon="el-icon-upload2"
                title="Вернуть"
                @click="dialogGetBack = true"
                plain></el-button>
    </el-row>
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
        dialogDelete: false,
        dialogGetBack: false,
        tags: [
          {id: 'MAX', name: 'важно', type: 'danger'},
          {id: 'MIDDLE', name: 'нормально', type: 'primary'},
          {id: 'MIN', name: 'мин', type: 'success'},
        ]
      };
    },
    computed: {
      tag(){
        return this.tags.find(x => this.item.important == x.id)
      },
    },
    methods:{
      editTask(){
        this.dialogVisible = false;
        this.dialogEdit = true;
      },
      deleteTask(){
        this.sendDelete()
      },
      getBackTask(){
        this.sendBack()
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
            vm.dialogDelete = false;
          }
        });
      },
      sendBack(){
        const vm = this;
        vm.axios({
          method: 'get',
          url: '/task/get-back/' + this.item.id,
        }).then(function (response) {
          if(response.status == 200){
            vm.$events.emit('updateTask', response.data);
            vm.dialogVisible = false;
            vm.dialogGetBack = false;
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

</style>