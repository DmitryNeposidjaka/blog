<template>
        <el-row>
            <el-dialog
                    title="Новая статья"
                    :visible.sync="dialogVisible"
                    width="70%"
                    :before-close="handleClose">
                <div>
                    <span></span>
                    <post-form
                            :categories="getCategories"
                            :tags="getTags">
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
                <posts-table
                        :models="getPosts"
                        :categories="getCategories"
                        :tags="getTags"
                ></posts-table>
            </el-card>
        </el-row>
</template>

<script>
import PostsTable from './PostsTable';
import PostForm from './PostFrom';
import {mapGetters} from 'vuex';
import {mapActions} from 'vuex';

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
    ...mapGetters('categories', [
      'getCategories'
    ]),
    ...mapGetters('tags', [
      'getTags'
    ]),
  },
  methods: {
    ...mapActions('posts', [
      'updatePost',
      'addPost'
    ]),
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
    this.$events.on('postUpdated', (model) => {this.updatePost(model)})
    this.$events.on('addPost', (model) => {this.addPost(model)})
    this.$events.on('postSaved', () => {this.closeModal()})
  },
  components: {PostForm, PostsTable}
}
</script>

<style>

</style>