<template>
    <div>
        <el-row :gutter="10">
            <el-col :span="12"><categories :data="getCategories"></categories></el-col>
            <el-col :span="12"><tags :data="getTags"></tags></el-col>
        </el-row>
        <el-row :gutter="10">
            <el-col :span="12"><task-tags :data="getTaskTags"></task-tags></el-col>
        </el-row>
    </div>
    <!--    <el-button v-on:click="send">SEND</el-button>-->
</template>

<script>
import Categories from './Categories';
import Tags from './Tags';
import TaskTags from './TaskTags';
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
      ]),
      ...mapGetters('taskTags', {
        getTaskTags: 'getTags'
      })
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
      ...mapActions('taskTags', {
        addTaskTag: 'addTag',
        updateTaskTag: 'updateTag',
      }),
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
      this.$events.on('taskTagUpdated', (model) => {this.updateTaskTag(model)})
      this.$events.on('addTaskTag', (model) => {this.addTaskTag(model)})
    },
    components: {Categories,Tags, TaskTags}
  }
</script>

<style>

</style>