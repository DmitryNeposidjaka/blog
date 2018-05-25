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
        <div class="task-adder">
            <el-button type="primary" @click="dialogVisible = true" style="padding: 2px">Добавить Задание</el-button>
        </div>
    </el-row>
</template>

<script>
import TaskForm from './TaskForm';
import {mapActions} from 'vuex';

export default {
  data(){
    return{
      dialogVisible: false,
    };
  },
  methods: {
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
    }
  },
  created(){
    const vm = this;
    this.$events.on('addTask', (data) => {
      vm.addTask(data);
      vm.closeModal();
    });
    this.$events.on('updateTask', (data) => {
      vm.updateTask(data);
      vm.closeModal();
    });
  },
  components: {TaskForm}
}
</script>

<style>
    .task-adder{

    }
</style>