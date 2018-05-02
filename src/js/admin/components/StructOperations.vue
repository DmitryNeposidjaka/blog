<template>
    <el-row>
        <el-dialog
                title="Редактирование"
                :visible.sync="dialogEdit"
                width="70%">
            <struct-form :model="model" form-name="structUpdate" :sendData="update"></struct-form>
            <span slot="footer" class="dialog-footer">
                    <el-button type="primary" @click="editStruct">Сохранить</el-button>
                    <el-button @click="dialogEdit = false">Закрыть</el-button>
                </span>
        </el-dialog>
        <!-- Диалог Удаление -->
        <el-dialog
                title="Удалить"
                :visible.sync="dialogDelete"
                width="30%"
                center>
            <span slot="footer" class="dialog-footer">
                <el-button @click="deleteStruct(model.id)">Удалить</el-button>
                <el-button type="primary" @click="dialogDelete = false">Отменить</el-button>
            </span>
        </el-dialog>
        <!-- Диалог Восстановление -->
        <el-dialog
                title="Восстановить"
                :visible.sync="dialogGetBack"
                width="30%"
                center>
            <span slot="footer" class="dialog-footer">
                <el-button @click="getBackStruct(model.id)">Восстановить</el-button>
                <el-button type="primary" @click="dialogGetBack = false">Отменить</el-button>
            </span>
        </el-dialog>
        <!-- Кнопки -->
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
  import StructForm from './StructForm';

  export default {
    props: ['model', 'delete', 'update', 'back'],
    data(){
      return{
        dialogVisible: false,
        dialogEdit: false,
        dialogDelete: false,
        dialogGetBack: false,
      };
    },
    methods:{
      editStruct(){
        this.$events.emit('saveStruct');
      },
      getBackStruct(id){
        this.back(id);
      },
      deleteStruct(id){
        this.delete(id);
      },
      closeModal() {
        this.dialogEdit = false;
        this.dialogVisible = false;
        this.dialogDelete = false;
        this.dialogGetBack = false;
      },
    },
    created(){
      this.$events.on('structUpdated', () => {this.closeModal()})
    },
    components: {PostView,EditPost, StructForm}
  }
</script>

<style>

</style>