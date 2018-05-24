<template>
    <div class="task-widget-wrapper">
        <el-card class="box-card">
            <div slot="header" class="clearfix">
                <span>Задачи</span>
                <task-adder  style="float: right"></task-adder>
            </div>
            <task-widget-item v-for="task in tasks" :item="task" :key="task.id"></task-widget-item>
        </el-card>
    </div>
</template>

<script>
import TaskWidgetItem from './TaskWidgetItem';
import TaskAdder from './TaskAdder';
export default {
  props: ['tasks'],
  data(){
    return{}
  },
  components: {TaskWidgetItem,TaskAdder}
}
</script>

<style>
.task-widget-wrapper{

}
</style>