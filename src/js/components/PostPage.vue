<template>
    <el-row>
        <div class="card">
            <time class="time">{{ post.updated_at }}</time><br>
            <h2 class="title">{{post.title}}</h2>
            <div class="description">{{ post.description }}</div>
            <img :src="post.thumbnail" class="image">
            <div class="text-preview">{{post.text}}</div>
            <div>
                <span style="font-weight: bold">Метки: </span> <router-link class="tag" v-for="(tag, k) in post.tags" :to="{path: '/tag', params:{id: tag.id}}" :key="k"><span>{{ tag.name }} {{ (k == (post.tags.length - 1))? '.' : ',' }} </span></router-link>
            </div>
        </div>
    </el-row>
</template>

<script>
export default {
  data(){
    return {
        post: {}
    }
  },
  methods: {
    loadPost(id){
      const vm = this;
      this.axios({
        method: 'get',
        url: '/post/'+id,
      }).then(function (response) {
        vm.post = response.data;
      })
    },
  },
  computed: {
  },
  created(){
    const id = this.$route.params.id;
    this.loadPost(id);
  }
}
</script>

<style>
    @import "../styles/post-preview.css";
    .tag{
        color: #f44336;
        text-decoration: none;
    }
</style>