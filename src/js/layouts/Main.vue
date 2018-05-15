<template>
    <el-container class="main-conteiner">
        <el-header id="el-header" style="text-align: right; font-size: 12px">
            <m-header></m-header>
        </el-header>
        <el-container class="main-container">

            <el-container :class="[{menuOpen: menuOpen}]">
                <el-main>
                    <el-header id="c-header" >
                        <c-header></c-header>
                    </el-header>
                    <el-row>
                        <div class="main-location">
                        </div>
                    </el-row>
                    <router-view></router-view>
                </el-main>
            </el-container>
            <m-sidebar :categories="getCategories"></m-sidebar>
        </el-container>
    </el-container>
</template>

<script>
import MHeader from '../components/Header';
import MSidebar from '../components/Sidebar';
import CHeader from '../components/ContentHeader';
import {mapGetters, mapActions} from 'vuex';

export default {
  data(){
    return {
      menuOpen: false,
    }
  },
  computed: {
    ...mapGetters('posts', [
      'getPosts',
  //    'getPost',
    ]),
    ...mapGetters('categories', [
      'getCategories',
  //    'getPost',
    ]),
  },
  methods: {
    ...mapActions('posts', [
      'setPosts'
    ]),
    ...mapActions('categories', [
      'setCategories'
    ]),
    loadPosts(){
        const vm = this;
        this.axios({
          method: 'get',
          url: '/posts'
        }).then(function (response) {
          vm.setPosts(response.data);
        })
    },
    loadCategories(){
        const vm = this;
        this.axios({
          method: 'get',
          url: '/categories'
        }).then(function (response) {
          vm.setCategories(response.data);
        })
    },
    menuChange(f){
      this.menuOpen = f;
    }
  },
  created(){
    this.loadPosts()
    this.loadCategories()
    this.$events.on('menuChange', (f) => {this.menuChange(f)})
  },
  components: {MHeader, MSidebar, CHeader},
}
</script>

<style>
    @import url('https://fonts.googleapis.com/css?family=Oswald');
    @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro');
    @import "../styles/main.css";
    .menuOpen{
        position: relative;
        left: -200px;
    }
    /*.main-container{
        margin-top: 50px;
        position: absolute;
        top: 50px;
        overflow: hidden;
    }*/
    .el-container:nth-child(5) .el-aside,
    .el-container:nth-child(6) .el-aside {
        line-height: 260px;
    }

    .el-container:nth-child(7) .el-aside {
        line-height: 320px;
    }
</style>