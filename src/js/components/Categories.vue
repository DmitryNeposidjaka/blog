<template>
    <div  class="category-filter">
        <h3>Категории</h3>
        <router-link v-for="(category, k) in categories" :to="{path: '/category', name: 'category-page', params:{id: category.id}}" :key="k">
        <div :class="['category-filter-item', (category.id == active)? 'active':'',]"
             :key="category.id"
             @click="active = category.id">
            {{category.name}}
        </div>
        </router-link>
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

<style scoped>
@import "../styles/categories.css";
    a{
        text-decoration: none;
        color: #333;
    }
</style>