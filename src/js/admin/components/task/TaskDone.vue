<template>
    <el-button-group>
        <el-button type="success" icon="el-icon-check" size="mini" title="Завершить" round @click="$emit('taskDoneClicked');"></el-button>
    </el-button-group>
</template>

<script>
  export default {
    data(){
      return{}
    },
    methods:{
    }
  }
</script>

<style>
</style>