<template>
    <el-row :gutter="10" >
        <el-col :span="14">
            <el-date-picker
                    v-model="value"
                    type="date"
                    placeholder="Выбрать день"
                    @change="dateChange">
            </el-date-picker>
            <calendar-widget :day="selected" :tasks="getTasks" @cwDayChanged="dateChange">
            </calendar-widget>
        </el-col>
        <el-col :span="10">
            <calendar-task :tasks="getTasks">
            </calendar-task>
        </el-col>
    </el-row>
</template>

<script>
import {mapGetters} from 'vuex';
import CalendarWidget from './CalendarWidget';
import CalendarTask from './CalendarTask';

export default {
    data(){
      return{
        selected: null,
        value: '',
      }
    },
  computed: {
    ...mapGetters('tasks',[
      'getTasks'
    ]),
  },
    methods: {
      dateChange(day){
        this.selected = day;
      }
    },
    created(){},
    components: {CalendarWidget,CalendarTask}
}
</script>

<style>

</style>