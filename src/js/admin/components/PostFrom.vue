<template>
    <el-form ref="form" :model="form" label-width="120px">
        <el-form-item label="Название">
            <el-input v-model="form.name"></el-input>
        </el-form-item>
        <vue-markdown :source="form.content"></vue-markdown>
        <el-form-item label="Контент">
            <el-input type="textarea" v-model="form.content" :rows="6"></el-input>
        </el-form-item>
        <el-form-item>
            <el-button type="primary">Create</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
  import VueMarkdown from 'vue-markdown'
export default {
  data(){
    return{
      form: {
        name: '',
        content: '',
      }
    }
  },
  components: {VueMarkdown}
}
</script>

<style>

</style>