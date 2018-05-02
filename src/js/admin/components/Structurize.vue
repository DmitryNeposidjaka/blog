<template>
    <el-row :gutter="10">
        <el-col :span="12"><categories :data="getCategories"></categories></el-col>
        <el-col :span="12"><tags :data="getTags"></tags></el-col>
    </el-row>
    <!--    <el-button v-on:click="send">SEND</el-button>-->
</template>

<script>
import Categories from './Categories';
import Tags from './Tags';
import {mapGetters, mapActions} from 'vuex';

  export default {
    data(){
      return {}
    },
    computed: {
      ...mapGetters('categories', [
        'getCategories'
      ]),
      ...mapGetters('tags', [
        'getTags'
      ])
    },
    methods: {
      ...mapActions('categories', [
        'addCategory',
        'updateCategory'
      ]),
      ...mapActions('tags', [
        'addTag',
        'updateTag'
      ]),
      send(){
        this.axios({
          method:'GET',
          url: '/posts/2',
        })
      }
    },
    created(){
      this.$events.on('categoryUpdated', (model) => {this.updateCategory(model)})
      this.$events.on('addCategory', (model) => {this.addCategory(model)})
      this.$events.on('tagUpdated', (model) => {this.updateTag(model)})
      this.$events.on('addTag', (model) => {this.addTag(model)})
    },
    components: {Categories,Tags}
  }
</script>

<style>

</style>