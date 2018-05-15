<template>
        <div class="card">
            <time class="time">{{ post.updated_at }}</time><br>
            <h2 class="title">{{post.title}}</h2>
            <div class="description">{{ post.description }}</div>
            <img :src="post.thumbnail" class="image">
            <div class="text-preview">{{textPreview}}</div>
            <div style="padding: 14px;">
                <div class="bottom clearfix">
                    <router-link :to="{ path: 'post', name: 'post-page', params: { id: post.id }}"><el-button type="primary" class="button" plain icon="el-icon-arrow-right">Читать дальше</el-button></router-link>
                </div>
            </div>
        </div>
</template>

<script>

  export default {
    props: ['post'],
    data(){
      return {};
    },
    computed: {
      sorted(){
        return this.posts
      },
      textPreview(){
        return this.post.text.substring(0, 200) + '...';
      }
    },


  }
</script>

<style>
    @import "../styles/post-preview.css";

</style>