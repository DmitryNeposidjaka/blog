<template>

    <el-button v-on:click="send">SEND</el-button>
</template>

<script>
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
  }
}
</script>

<style>

</style>