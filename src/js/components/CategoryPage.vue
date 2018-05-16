<template>
    <posts :posts="getCategoryPost"></posts>
</template>

<script>
import {mapGetters, mapActions} from 'vuex';
import Posts from './Posts';
export default {
  data(){
    return {};
  },
  computed: {
    getCategoryPost(){
      const id = this.$route.params.id

      return this.getPosts.filter(function (item, i, arr) {
        const c = item.categories.filter(function (item, i, arr) {
          return item.category_id == id;
        });
        return c.length > 0
      })
    },
    ...mapGetters('posts', [
        'getPosts'
    ]),
  },
  created(){},
  components: {Posts},
}
</script>

<style>

</style>