<template>
    <div class="task-widget-wrapper">
        <el-card class="box-card">
            <div slot="header" class="clearfix">
                <span>Задачи</span>
                <task-adder  style="float: right"></task-adder>
            </div>
            <task-widget-item v-for="task in dataFiltered" :item="task" :key="task.id"></task-widget-item>
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
  computed:{
    dataFiltered(){
      let filtered = this.tasks;
      filtered = this._closeFilter(filtered);
      filtered = this._deleteFilter(filtered);
      return filtered;
    },
  },
  methods:{
    _closeFilter(data){
        return data.filter(function(item, i, arr){
          console.log(item)
          return item.close == false;
        });
    },
    _deleteFilter(data){
        return data.filter(function(item, i, arr){
          console.log(item)
          return item.disabled == false;
        });
    },
  },
  components: {TaskWidgetItem,TaskAdder}
}
</script>

<style>
.task-widget-wrapper{

}
</style>