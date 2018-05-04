<template>
<posts :posts="getPosts"></posts>
</template>

<script>
import {mapGetters, mapActions} from 'vuex';
import Posts from './Posts';

export default {
  props:['posts'],
  data(){
    return {};
  },
  computed: {
    ...mapGetters('posts', [
      'getPosts',
      //    'getPost',
    ]),
  },
  components: {Posts}
}
</script>

<style>

</style>