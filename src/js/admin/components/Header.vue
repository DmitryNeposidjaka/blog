<template>
    <div class="s-header">
        <note-adder></note-adder>
        <el-button size="mini" icon="el-icon-edit" title="Добавить заметку" @click="openNoteAdder"></el-button>
        <el-dropdown>
            <i class="el-icon-setting" style="margin-right: 15px"></i>
            <el-dropdown-menu slot="dropdown">
                <el-dropdown-item>View</el-dropdown-item>
                <el-dropdown-item>Add</el-dropdown-item>
                <el-dropdown-item>Delete</el-dropdown-item>
            </el-dropdown-menu>
        </el-dropdown>
        <span>Dima</span>
    </div>
</template>

<script>
    import NoteAdder from './note/NoteAdder';
export default {
  data(){
    return {
      noteAdderOpened: false,
    };
  },
  methods: {
    openNoteAdder(){
      if(!this.noteAdderOpened){
        this.$events.emit('open-note-adder');
        this.noteAdderOpened = true;
      };
    },
  },
  components: {NoteAdder},
  created(){
    this.$events.on('close-note-adder', () => {this.noteAdderOpened = false});
  }
}
</script>

<style>
.s-header{
    background: #e5e9f2;
    /* width: 100%; */
    padding: 15px;
    border-bottom: 1px solid #c0c4cc;
}
</style>