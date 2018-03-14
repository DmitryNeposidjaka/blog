<template>
    <el-container class="main-conteiner">
        <m-sidebar></m-sidebar>
        <el-container>
            <m-header></m-header>
            <m-content></m-content>
        </el-container>
    </el-container>
</template>

<script>
import MSidebar from '../components/Sidebar';
import MHeader from '../components/Header';
import MContent from '../components/Content';

export default {
  components: {MSidebar, MHeader, MContent}
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