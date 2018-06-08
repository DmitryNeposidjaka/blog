<template>
    <div class="task-view-wrapper">
        <el-tag size="mini" :type="priority.type" style="margin-right: 5px">{{priority.name}}</el-tag><strong >{{model.title}}</strong><br>
        <br>
        <div v-if="model.assigned_at != null">
            <strong>Назначен на: </strong><span>{{model.assigned_at}}</span><br>
        </div>
        <strong>Описание : </strong><span>{{model.description}}</span><br>
        <strong>Поставил: </strong><span>{{model.creator}}</span><br>
        <strong>Назначен: </strong><span>{{model.executor}}</span><br>
        <strong>Добавлен: </strong><span>{{model.created_at}}</span><br>
        <div>
            <el-tag v-for="(tag, key) in model.tags" :key="key" class="tag-item">{{ tag.name }}</el-tag>
        </div>
        <task-operations
                v-on:taskEditClicked="$emit('taskEditClicked')"
                v-on:taskDeleteClicked="$emit('taskDeleteClicked')"
        ></task-operations>
    </div>
</template>

<script>
    import TaskOperations from './TaskOperations'
  export default {
    props: ['model', 'priority'],
    data(){
      return{}
    },
    components: {TaskOperations}
  }
</script>

<style>
    .task-view-wrapper{

    }
    .tag-item{
        margin: 5px;
    }
</style>