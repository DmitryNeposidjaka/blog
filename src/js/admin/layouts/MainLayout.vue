<template>
    <el-container class="main-conteiner">
        <m-sidebar></m-sidebar>
        <el-container>
            <el-header style="text-align: right; font-size: 12px">
                <m-header></m-header>
            </el-header>
            <el-main>
                <router-view></router-view>
            </el-main>
        </el-container>
    </el-container>
</template>

<script>
import MSidebar from '../components/Sidebar';
import MHeader from '../components/Header';

export default {
  components: {MSidebar, MHeader}
}
</script>

<style>
    body{
        margin: 0px;
    }
.main-conteiner{
    width: 100%;
}
</style>