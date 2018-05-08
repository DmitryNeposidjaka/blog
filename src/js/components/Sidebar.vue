<template>
    <div>
        <el-button class="menu-button" @click="ff" icon="el-icon-menu"></el-button>
        <el-aside  :class="[{open: open}]">
            <post-filter></post-filter>
            <categories :categories="categories"></categories>
        </el-aside>
    </div>

</template>

<script>
    import PostFilter from './PostFilters';
    import Categories from './Categories';

    export default {
      props: ['categories'],
      data(){
        return {
          open: false,
        };
      },
      methods: {
        ff(){
          this.open = this.open? false : true;
          this.$events.emit('menuChange', this.open)
        }
      },
      components: {PostFilter,Categories}
    }
</script>

<style scoped>
@import "../styles/sidebar.css";
</style>