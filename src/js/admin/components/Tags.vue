<template>
    <el-row>
        <el-card class="box-card tags-box">
            <div slot="header" class="clearfix">
                <span>Метки</span>
                <el-button style="float: right; padding: 5px 5px" type="success" @click="dialogVisible = true">Добавить новую</el-button>
            </div>
            <el-dialog
                    title="Новая метка"
                    :visible.sync="dialogVisible"
                    width="50%"
                    :before-close="handleClose">
                <div>
                    <struct-form form-name="tagNew" :sendData="tagRequest"></struct-form>
                </div>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="handleClose">Отменить</el-button>
                    <el-button type="primary" @click="saveTag">Создать</el-button>
                </span>
            </el-dialog>
            <el-table
                    :data="data"
                    style="width: 100%">
                <el-table-column
                        prop="created_at"
                        label="Дата"
                        width="180">
                </el-table-column>
                <el-table-column
                        prop="name"
                        label="Название"
                        width="180">
                </el-table-column>
                <el-table-column
                        prop="disabled"
                        label="Аут">
                    <template slot-scope="scope">
                        <el-tag
                                :type="scope.row.disabled ? 'info' : 'success'"
                                close-transition>{{scope.row.disabled? 'удален': 'активный'}}</el-tag>
                    </template>
                </el-table-column>
                <el-table-column
                        label="Операции">
                    <template slot-scope="scope">
                        <struct-operations :model="scope.row":delete="deleteRequest" :update="updateRequest" :back="getBackRequest"></struct-operations>
                    </template>
                </el-table-column>
            </el-table>
        </el-card>
    </el-row>
</template>

<script>
  import StructForm from './StructForm';
  import StructOperations from './StructOperations';

  export default {
    props: ['data'],
    data(){
      return {
        dialogVisible: false,
      }
    },
    methods: {
      handleClose(done) {
        this.$confirm('Данные не сохранятся')
          .then(_ => {
            this.dialogVisible = false;
            done();
          })
          .catch(_ => {});
      },
      tagRequest(formData){
        const vm = this;
        vm.axios({
          method: 'post',
          url: '/tags',
          data: formData,
        }).then(function (response) {
          if(response.status == 200){
            vm.$events.emit('addTag', response.data);
            vm.dialogVisible = false;
          }
        });
      },
      deleteRequest(id){
        const vm = this;
        this.axios({
          method: 'delete',
          url: '/tags/'+id,
        }).then(function (request) {
          if(request.status == 200 ) vm.dialogDelete = false
          vm.$events.emit('structUpdated', request.data);
          vm.$events.emit('tagUpdated', request.data );
        });
      },
      updateRequest(formData){
        const vm = this;
        this.axios({
          method: 'post',
          url: '/tags/'+formData.get('id'),
          data: formData,
        }).then(function (request) {
          if(request.status == 200 ) vm.dialogEdit = false
          vm.$events.emit('structUpdated', request.data);
          vm.$events.emit('tagUpdated', request.data );
        });
      },
      getBackRequest(id){
        const vm = this;
        this.axios({
          method: 'get',
          url: '/tags/get-back/'+id,
        }).then(function (request) {
          if(request.status == 200 ) vm.dialogGetBack = false
          vm.$events.emit('structUpdated', request.data);
          vm.$events.emit('tagUpdated', request.data );
        });
      },
      saveTag(){
        this.$events.emit('saveStruct');
      },
    },
    components: {StructForm, StructOperations}
  }
</script>

<style>
    .tags-box{
        max-height: 500px;
        overflow-y: scroll;
    }
</style>