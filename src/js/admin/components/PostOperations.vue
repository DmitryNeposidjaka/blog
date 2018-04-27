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
        <!-- Диалог Удаление -->
        <el-dialog
                title="Удалить статью"
                :visible.sync="dialogDelete"
                width="30%"
                center>
            <span slot="footer" class="dialog-footer">
                <el-button @click="deletePost(model.id)">Удалить</el-button>
                <el-button type="primary" @click="dialogDelete = false">Отменить</el-button>
            </span>
        </el-dialog>
        <!-- Диалог Восстановление -->
        <el-dialog
                title="Восстановить статью"
                :visible.sync="dialogGetBack"
                width="30%"
                center>
            <span slot="footer" class="dialog-footer">
                <el-button @click="getBackPost(model.id)">Восстановить</el-button>
                <el-button type="primary" @click="dialogGetBack = false">Отменить</el-button>
            </span>
        </el-dialog>
        <!-- Кнопки -->
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
                @click="dialogDelete = true"
                plain></el-button>
        <el-button v-if="model.disabled"
                size="mini"
                type="success"
                icon="el-icon-upload2"
                title="Вернуть"
                @click="dialogGetBack = true"
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
        dialogDelete: false,
        dialogGetBack: false,
      };
    },
    methods:{
      editPost(){
        this.$events.emit('editPost');
      },
      getBackPost(id){
        this._getBackRequest(id);
      },
      deletePost(id){
        this._deleteRequest(id);
      },
      _deleteRequest(id){
        const vm = this;
        this.axios({
          method: 'delete',
          url: '/posts/'+id,
        }).then(function (request) {
          if(request.status == 200 ) vm.dialogDelete = false
          vm.$events.emit('postUpdated', request.data);
        });
      },
      _getBackRequest(id){
        const vm = this;
        this.axios({
          method: 'get',
          url: '/posts/get-back/'+id,
        }).then(function (request) {
          if(request.status == 200 ) vm.dialogGetBack = false
          vm.$events.emit('postUpdated', request.data);
        });
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