<template>
        <el-row>
            <el-dialog
                    title="Новая статья"
                    :visible.sync="dialogVisible"
                    width="70%"
                    :before-close="handleClose">
                <div>
                    <span></span>
                    <post-form>

                    </post-form>
                </div>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="handleClose">Отменить</el-button>
                    <el-button type="primary" @click="savePost">Создать</el-button>
                </span>
            </el-dialog>

            <el-card class="box-card">
                <div slot="header" class="clearfix">
                    <span>Статьи</span>
                    <el-button style="float: right; padding: 5px 5px" type="success" @click="dialogVisible = true">Добавить новую</el-button>
                </div>
            <el-table
                    :data="getPosts"
                    style="width: 100%">
                <el-table-column
                        prop="created_at"
                        label="Дата"
                        width="180">
                    <template slot-scope="scope">
                        <span style="color: #909399">{{scope.row.created_at}}</span>
                    </template>
                </el-table-column>
                <el-table-column
                        prop="title"
                        label="Название"
                        width="400">
                    <template slot-scope="scope">
                        <span style="color: #3a8ee6">{{scope.row.title}}</span>
                    </template>
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
            </el-table>
            </el-card>
        </el-row>
</template>

<script>
  import PostForm from './PostFrom';
import {mapGetters} from 'vuex';

export default {
  data(){
    return {
      dialogVisible: false,
    }
  },
  computed:{
    ...mapGetters('posts', [
      'getPosts'
    ]),
  },
  methods: {
    send(){
      this.axios({
        method:'GET',
        url: '/posts/2',
      })
    },
    closeModal() {
      this.dialogVisible = false;
    },
    handleClose(done) {
      this.$confirm('Данные будут потеряны')
        .then(_ => {
          this.dialogVisible = false;
          done();
        })
        .catch(_ => {});
    },
    savePost(){
      this.$events.emit('savePost');
    }
  },
  created(){
    this.$events.on('postSaved', () => {this.closeModal()})
  },
  components: {PostForm}
}
</script>

<style>

</style>