<template>
    <el-button-group class="task-operations">
        <el-button type="primary" icon="el-icon-edit" size="mini" title="Редактировать" @click="editClick"></el-button>
        <el-button type="danger" icon="el-icon-delete" size="mini" title="Удалить" @click="editDelete"></el-button>
    </el-button-group>
</template>

<script>
export default {
  data(){
    return{}
  },
  methods:{
    editClick(){
      this.$emit('taskEditClicked');
    },
    editDelete(){
      this.$emit('taskDeleteClicked');
    },
  }
}
</script>

<style>
.task-operations{

}
</style>