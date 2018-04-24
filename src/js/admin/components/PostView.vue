<template>
    <el-row>
        <p><span></span></p>
        <h2>{{model.title}}</h2>
        <vue-markdown :source="model.text"></vue-markdown>
    </el-row>
</template>

<script>
  import VueMarkdown from 'vue-markdown'
export default {
  props: ['model'],
  data(){
    return{};
  },
    components: {VueMarkdown}
}
</script>

<style>

</style>