<template>
    <div class="task-widget-wrapper">
        <el-card class="box-card">
            <div slot="header" class="clearfix">
                <span>Задачи</span>
                <task-adder  style="float: right"></task-adder>
            </div>
            <el-collapse :value="[(aDay.length > 0)? 'aDay' : 'unlimited']">
                <el-collapse-item title="Бессрочные" name="unlimited">
                    <task-widget-item v-for="task in unlimited" :item="task" :key="task.id"></task-widget-item>
                </el-collapse-item>
                <el-collapse-item title="На сегодня" name="aDay">
                    <task-widget-item v-for="task in aDay" :item="task" :key="task.id"></task-widget-item>
                </el-collapse-item>
            </el-collapse>

        </el-card>
    </div>
</template>

<script>
import TaskWidgetItem from './TaskWidgetItem';
import TaskAdder from './TaskAdder';
export default {
  props: ['tasks', 'day'],
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
    unlimited(){
      return this.dataFiltered.filter(function(item, i, arr){
        return item.unlimited;
      });
    },
    aDay(){
      const vm = this;
      return this.dataFiltered.filter(function(item, i, arr){
        const assigned = vm.$moment(item.assigned_at)
        return assigned.isSame(vm.day, 'day');
      });
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