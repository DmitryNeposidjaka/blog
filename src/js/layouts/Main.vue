<template>
    <el-container class="main-conteiner">
        <el-header id="el-header" style="text-align: right; font-size: 12px">
            <m-header></m-header>
        </el-header>
        <el-container class="main-container">

            <el-container>

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
            <m-sidebar></m-sidebar>
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

    }
  },
  computed: {
    ...mapGetters('posts', [
      'getPosts',
  //    'getPost',
    ]),
  },
  methods: {
    ...mapActions('posts', [
      'setPosts'
    ]),
    loadPosts(){
        const vm = this;
        this.axios({
          method: 'get',
          url: '/posts'
        }).then(function (response) {
          vm.setPosts(response.data);
        })
    }
  },
  created(){
    this.loadPosts()
  },
  components: {MHeader, MSidebar, CHeader},
}
</script>

<style>
    @import url('https://fonts.googleapis.com/css?family=Oswald');
    @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro');
    #el-header {
        background-color: #333;
        color: #333;
        text-align: center;
        line-height: 60px;
    }
    #c-header {
        background-color: #fff;
        border-bottom: 1px solid #e4e4e4;
        color: #333;
        text-align: center;
        line-height: 60px;
    }

    .el-aside {
        background-color: #fff;
        color: #333;
        text-align: center;
        line-height: 200px;
        margin-right: 300px;
        border-left: solid 1px gray;
        padding: 20px;
    }

    .el-main {
        background-color: #fff;
        color: #333;
        text-align: center;
        line-height: 160px;
        margin-left: 25%;
        margin-right: 5%;
        padding: 20px;
    }

    body > .el-container {
        margin-bottom: 40px;
    }
    .main-container{
        margin-top: 50px;
    }
    .el-container:nth-child(5) .el-aside,
    .el-container:nth-child(6) .el-aside {
        line-height: 260px;
    }

    .el-container:nth-child(7) .el-aside {
        line-height: 320px;
    }
</style>