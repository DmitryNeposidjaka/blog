<template>
    <div class="note-adder">
        <el-dialog
                title="Новая заметочка"
                :visible.sync="dialogVisible"
                width="50%"
                :before-close="handleClose">
            <note-form ></note-form>
            <span slot="footer" class="dialog-footer">
                <el-button @click="close">Отменить</el-button>
                <el-button type="primary" @click="save()">Добавить</el-button>
             </span>
        </el-dialog>
    </div>
</template>

<script>
    import NoteForm from './NoteForm'
export default {
  data(){
    return {
      dialogVisible: false,
    }
  },
  methods: {
    handleClose(){
      this.dialogVisible = false;
      this.$events.emit('close-note-adder');
      return true;
    },
    open(){
      this.dialogVisible = true;
    },
    save(){
      this.$events.emit('createNote');
      this.dialogVisible = false;
      this.$events.emit('close-note-adder');
    },
    close(){
      this.dialogVisible = false;
      this.$events.emit('close-note-adder');
    }
  },
  components: {NoteForm},
  created(){
    this.$events.on('open-note-adder', () => {this.open()});
    this.$events.on('NoteCreated', () => {this.close()});
  //  this.$events.on('close-note-adder', () => {this.close()});
  }
}
</script>

<style>
    .note-adder{
text-align: left;
    }
</style>