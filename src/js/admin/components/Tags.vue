<template>
    <el-row>
        <el-card class="box-card">
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
                    <struct-form form-name="tagNew"></struct-form>
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
      saveTag(){
        this.$events.emit('saveStruct');
      },
    },
    components: {StructForm, StructOperations}
  }
</script>

<style>

</style>