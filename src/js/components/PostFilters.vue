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
.post-filter{
    width: 100%;
}
.post-filter-item{
    width: 100%;
    height: 20px;
    padding: 10px 0px;
    border: 1px solid #c0c4cc;
    margin: 5px;
    border-radius: 3px;
    cursor: default;
}
.active{
    background-color: #e6a23c;
    color: #fff;
}
.post-filter-item:hover{
    background-color: #e6a23c;
    color: #fff;
}
</style>