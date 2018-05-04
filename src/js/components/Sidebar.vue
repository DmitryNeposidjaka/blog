<template>
    <el-aside width="200px">
        <post-filter></post-filter>
        <categories :categories="categories"></categories>
    </el-aside>
</template>

<script>
    import PostFilter from './PostFilters';
    import Categories from './Categories';

    export default {
      props: ['categories'],
      data(){
        return {};
      },
      components: {PostFilter,Categories}
    }
</script>

<style>
    .el-aside{
        line-height: 20px;
    }
</style>