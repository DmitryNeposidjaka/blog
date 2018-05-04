<template>
    <div  class="category-filter">
        <h3>Категории</h3>
        <div :class="['category-filter-item', (category.id == active)? 'active':'',]"
             v-for="category in categories"
             :key="category.id"
             @click="active = category.id">

            {{category.name}}
        </div>
    </div>
</template>

<script>

  export default {
    props: ['categories'],
    data(){
      return {
        active: '',
      };
    }
  }
</script>

<style>
.category-filter{
    width: 100%;
}
.category-filter-item{
    width: 100%;
    height: 20px;
    padding: 10px 0px;
    border: 1px solid #c0c4cc;
    margin: 5px;
    border-radius: 3px;
    cursor: default;
}
.category-filter .active{
    background-color: #f56c6c;
    color: #fff;
}
.category-filter-item:hover{
    background-color: #f56c6c;
    color: #fff;
}
</style>