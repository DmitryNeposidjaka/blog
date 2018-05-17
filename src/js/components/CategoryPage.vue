<template>
    <posts :posts="getCategoryPost($route.params.id)"></posts>
</template>

<script>
import {mapGetters, mapActions} from 'vuex';
import Posts from './Posts';
export default {
  data(){
    return {};
  },
  computed: {
    ...mapGetters('posts', [
        'getPosts',
        'getCategoryPost'
    ]),
  },
  created(){},
  components: {Posts},
}
</script>

<style>

</style>