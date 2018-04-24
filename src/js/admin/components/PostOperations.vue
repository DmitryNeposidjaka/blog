<template>
    <el-row>
        <el-dialog
                title="Просмотр"
                :visible.sync="dialogVisible"
                width="50%">
            <div>
            <post-view :model="model"></post-view>
            </div>
            <span slot="footer" class="dialog-footer">
                    <el-button @click="dialogVisible = false">Закрыть</el-button>
                </span>
        </el-dialog>

        <el-dialog
                title="Редактирование"
                :visible.sync="dialogEdit"
                width="70%">
            <div>
                <edit-post :model="model"></edit-post>
            </div>
            <span slot="footer" class="dialog-footer">
                    <el-button type="primary" @click="editPost">Сохранить</el-button>
                    <el-button @click="dialogEdit = false">Закрыть</el-button>
                </span>
        </el-dialog>
        <el-button
                size="mini"
                type="primary"
                icon="el-icon-view"
                title="Просмотреть"
                @click="dialogVisible = true"
                plain></el-button>
        <el-button
                size="mini"
                type="warning"
                icon="el-icon-edit"
                title="Редактировать"
                @click="dialogEdit = true"
                plain></el-button>
        <el-button v-if="!model.disabled"
                size="mini"
                type="danger"
                icon="el-icon-delete"
                title="Удалить"
                @click="deletePost(model.id)"
                plain></el-button>
        <el-button v-if="model.disabled"
                size="mini"
                type="success"
                icon="el-icon-upload2"
                title="Вернуть"
                @click=""
                plain></el-button>
    </el-row>
</template>

<script>
    import PostView from './PostView';
    import EditPost from './EditPost';
  export default {
    props: ['model'],
    data(){
      return{
        dialogVisible: false,
        dialogEdit: false,
      };
    },
    methods:{
      editPost(){
        this.$events.emit('editPost');
      },
      deletePost(id){
        this.axios({
          method: 'delete',
          url: '/posts/'+id,
        }).then(function (request) {
          console.log(request);
        })
      },
      closeModal() {
        this.dialogEdit = false;
      },
    },
    created(){
      this.$events.on('postUpdated', () => {this.closeModal()})
    },
    components: {PostView,EditPost}
  }
</script>

<style>

</style>