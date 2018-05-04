<template>
    <el-row>
        <post-preview v-for="post in sorted" :key="post.id" :post="post"></post-preview>
    </el-row>
</template>

<script>
import PostPreview from './PostPreview';

export default {

  props: ['posts'],
  data(){
    return {};
  },
  computed: {
    sorted(){
      const vm = this;
      return this.posts.sort(function (a, b) {
        const timeA = vm.$moment(a.updated_at);
        const timeB = vm.$moment(b.updated_at);
        return timeB - timeA
      })
    }
  },
  components: {PostPreview}


}
</script>

<style>

</style>