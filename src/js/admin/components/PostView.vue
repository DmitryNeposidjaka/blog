<template>
    <el-row>
        <p><span></span></p>
        <h2>{{model.title}}</h2>
        <img :src="model.thumbnail" class="image">
        <strong>{{model.description}}</strong>
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
    .image{
        width: 100%;
    }
</style>