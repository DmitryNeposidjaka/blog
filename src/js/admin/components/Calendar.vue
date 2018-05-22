<template>
    <el-row :gutter="10" >
        <el-col :span="18">
            <el-date-picker
                    v-model="value"
                    type="date"
                    placeholder="Pick a day"
                    @change="dateChange">
            </el-date-picker>
            <calendar-widget :day="selected">

            </calendar-widget>
        </el-col>
        <el-col :span="6">
            <calendar-task></calendar-task>
        </el-col>
    </el-row>
</template>

<script>
import CalendarWidget from './CalendarWidget';
import CalendarTask from './CalendarTask';
export default {
    data(){
      return{
        selected: null,
        value: '',
      }
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