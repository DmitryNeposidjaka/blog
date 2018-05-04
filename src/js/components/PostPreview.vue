<template>
        <div class="card">
            <time class="time">{{ post.updated_at }}</time><br>
            <h2 class="title">{{post.title}}</h2>
            <div class="description">{{ post.description }}</div>
            <img :src="post.thumbnail" class="image">
            <div class="text-preview">{{textPreview}}</div>
            <div style="padding: 14px;">
                <div class="bottom clearfix">
                    <el-button type="primary" class="button" plain icon="el-icon-arrow-right">Читать дальше</el-button>
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
    .time{
        color: #909399;
        font-size: 12px;
    }
    .title{
        font-family: 'Oswald', sans-serif;
        margin: 20px 0px 40px 0px;
    }
    .card{
        width: 100%;
        padding: 20px 0px;
        text-align: left;
        line-height: 20px
    }
    .description{
        font-family: 'Source Sans Pro', sans-serif;
        margin : 10px 0px;
    }
    .image{
        width: 100%;
    }
    .text-preview{
        font-family: 'Source Sans Pro', sans-serif;
        margin: 40px 0px;
    }
</style>