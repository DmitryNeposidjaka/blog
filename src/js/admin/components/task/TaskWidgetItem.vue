<template>
    <div class="task-widget-item">
        <el-tag size="mini" :type="tag.type" style="margin-right: 5px">{{tag.name}}</el-tag><span>{{ item.title }}</span>
    </div>
</template>

<script>
export default {
  props: ['item'],
  data(){
    return{
      tags: [
        {id: 'MAX', name: 'важно', type: 'danger'},
        {id: 'MIDDLE', name: 'нормально', type: 'primary'},
        {id: 'MIN', name: 'мин', type: 'success'},
      ]
    }
  },
  computed: {
    tag(){
      return this.tags.find(x => this.item.important == x.id)
    }
  },
}
</script>

<style>
.task-widget-item{
    padding: 10px;
    width: 100%;
    min-height: 20px;
    color: #9c27b0;
    border-bottom: 1px solid #eaeaea;
}
</style>