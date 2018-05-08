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
@import "../styles/categories.css";
</style>