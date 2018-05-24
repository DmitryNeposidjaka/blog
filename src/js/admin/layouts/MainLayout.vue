<template>
    <el-container class="main-conteiner">
        <m-sidebar></m-sidebar>
        <el-container>
            <el-header style="text-align: right; font-size: 12px">
                <m-header></m-header>
            </el-header>
            <el-main>
                <el-row>
                    <div class="main-location">
                        <el-breadcrumb separator-class="el-icon-arrow-right">
                            <el-breadcrumb-item :to="{ path: '/' }">Главная</el-breadcrumb-item>
                            <el-breadcrumb-item>Страница</el-breadcrumb-item>
                        </el-breadcrumb>
                        <watcher-alert></watcher-alert>
                    </div>
                </el-row>
                <router-view></router-view>
            </el-main>
        </el-container>
    </el-container>
</template>

<script>
import MSidebar from '../components/Sidebar';
import MHeader from '../components/Header';
import watcherAlert from '../modules/watcherAlert';
import { mapGetters } from 'vuex';
import { mapActions } from 'vuex';



export default {
  data(){
    return{};
  },
  computed:{
    ...mapGetters('posts',[
      'getPosts',
      'getPost',
    ]),
    ...mapGetters('categories',[
      'getCategories',
      'getCategory',
    ]),
    ...mapGetters('tags',[
      'getTags',
      'getTag',
    ]),
  },
  methods:{
    ...mapActions('posts',[
      'setPosts',
      'addPost',
    ]),
    ...mapActions('categories',[
      'setCategories',
      'addCategory',
    ]),
    ...mapActions('tags',[
      'setTags',
      'addTag',
    ]),
    ...mapActions('tasks',[
      'setTasks',
      'addTask',
    ]),
    ...mapActions('notes',[
      'setNotes',
      'addNote',
    ]),
    ...mapActions('achieves',[
      'setAchieves',
      'addAchieve',
    ]),
    loadPosts(){
      const vm = this;
      this.axios({
        method: 'get',
        url: '/posts'
      }).then(function (response) {
        vm.setPosts(response.data)
      });
    },
    loadCategories(){
      const vm = this;
      this.axios({
        method: 'get',
        url: '/categories'
      }).then(function (response) {
        vm.setCategories(response.data)
      });
    },

    loadTags(){
      const vm = this;
      this.axios({
        method: 'get',
        url: '/tags'
      }).then(function (response) {
        vm.setTags(response.data)
      });
    },
    loadTasks(){
      const vm = this;
      this.axios({
        method: 'get',
        url: '/task-all/'
      }).then(function (response) {
        vm.setTasks(response.data)
      });
    },
    loadNotes(){
      const vm = this;
      this.axios({
        method: 'get',
        url: '/note-all/'
      }).then(function (response) {
        vm.setNotes(response.data)
      });
    },
    loadAchieves(){
      const vm = this;
      this.axios({
        method: 'get',
        url: '/achieve-all/'
      }).then(function (response) {
        vm.setAchieves(response.data)
      });
    },

    checkUser(){
      if(!this.$auth.check()){
        this.$router.push('/login');
        return false;
      }
      return true;
    }
  },
  created(){
    if(this.checkUser()){
      this.loadPosts();
      this.loadCategories();
      this.loadTags();
      this.loadTasks();
      this.loadNotes();
      this.loadAchieves();
    }
  },
  components: {MSidebar, MHeader,watcherAlert}
}
</script>

<style>
    body{
        margin: 0px;
    }
.main-conteiner{
    width: 100%;
}
    .el-header{
        padding: 0px;
    }
    .main-location{
        margin-bottom: 30px;
    }
    .el-breadcrumb{
        margin-bottom: 10px;
    }
</style>