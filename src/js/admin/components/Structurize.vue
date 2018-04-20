<template>
    <el-row :gutter="10">
        <el-col :span="12"><categories></categories></el-col>
        <el-col :span="12"><tags></tags></el-col>
    </el-row>
    <!--    <el-button v-on:click="send">SEND</el-button>-->
</template>

<script>
    import Categories from './Categories';
    import Tags from './Tags';
  export default {
    data(){
      return {}
    },
    methods: {
      send(){
        this.axios({
          method:'GET',
          url: '/posts/2',
        })
      }
    },
    created(){
      console.log(this)
    },
    components: {Categories,Tags}
  }
</script>

<style>

</style>