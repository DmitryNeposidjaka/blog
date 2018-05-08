<template>
    <div  class="post-filter">
        <div :class="['post-filter-item', (filter.id == active)? 'active':'',]"
             v-for="filter in filters"
             :key="filter.id"
             @click="active = filter.id">

            {{filter.name}}
        </div>
    </div>
</template>

<script>
  export default {
    data(){
      return {
        active: '',
        filters: [
          {
            id: 1,
            name: 'Популярные',
          },
          {
            id: 2,
            name: 'Популярные1',
          },
          {
            id: 3,
            name: 'Популярные2',
          },
        ]
      };
    }
  }
</script>

<style>
@import "../styles/post-filter.css";
</style>