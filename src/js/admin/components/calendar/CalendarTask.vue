<template>
    <div class="calendar-task-wrapper">
        <task-widget :tasks="tasks" :day="day"></task-widget>
    </div>
</template>

<script>

import TaskWidget from '../task/TasksWidget'

export default {
    props: ['tasks', 'day'],
    data(){
        return {

        }
    },
  computed: {
  },
  components: {TaskWidget}
}
</script>

<style>
.calendar-task-wrapper{
    width: 100%;
    min-width: 100px;
    min-height: 500px;
    border-left: 2px solid #d8cccc;
    /*padding: 20px 50px 20px 20px;*/
}
</style>