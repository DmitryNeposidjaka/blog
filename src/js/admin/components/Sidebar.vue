<template>
    <el-aside width="200px" style="background-color: rgb(238, 241, 246)">
        <el-menu :default-openeds="['2']"  :router="true">
            <el-menu-item index="1" route="/">Главная</el-menu-item>
            <el-submenu index="2">
                <template slot="title"><i class="el-icon-message"></i>Контент</template>
                <el-menu-item index="2-1" route="/posts">Статьи</el-menu-item>
                <el-menu-item index="2-2" route="/structurize">Структуризация </el-menu-item>
                <el-menu-item index="2-3" route="/calendar">Календарь </el-menu-item>
            </el-submenu>
            <el-submenu index="3">
                <template slot="title"><i class="el-icon-more-outline"></i>Работа</template>
                <el-menu-item-group>
                    <el-menu-item index="3-1" route="/tasks">Задачи</el-menu-item>
                    <el-menu-item index="3-2" route="/notes">Заметки</el-menu-item>
                </el-menu-item-group>
            </el-submenu>

        </el-menu>
    </el-aside>
</template>

<script>

</script>

<style scope>
    .el-aside {
        color: #333;
    }
    .el-menu-item a{
        text-decoration: none;
        color: #303133;
    }
</style>