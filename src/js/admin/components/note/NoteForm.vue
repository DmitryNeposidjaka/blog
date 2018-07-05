<template>
    <el-form :ref="formName"  :rules="rules" :model="model" label-width="120px">
        <el-form-item label="Описание" prop="title">
            <el-input  type="textarea" v-model="model.title"></el-input>
        </el-form-item>
        <el-form-item label="Тэги">
            <el-select
                    multiple
                    filterable
                    allow-create
                    default-first-option
                    value-key="id"
                    v-model="model.tags">
                <el-option
                        v-for="item in getNoteTags"
                        :key="item.id"
                        :label="item.name"
                        :value="item.id">
                </el-option>
            </el-select>
        </el-form-item>
    </el-form>
</template>

<script>
  import {mapGetters} from 'vuex';
  export default {
    props: {note: {default: null}},
    data(){
      return{
        formName: 'noteForm',
        noTime: false,
        model: {
          title: '',
          tags: [],
        },
        rules:{
          title: [
            {required: true, message: 'Описание должно быть заполнени'},
            {max: 255, message: 'Максимальная дляна 255'},
          ],
        }
      }
    },
    computed: {
      ...mapGetters('noteTags',{
        getNoteTags: 'getTags'
      })
    },
    methods: {
      save(){
        const data = this.$refs[this.formName];
        data.validate((valid) => {
          if (valid) {
            const formData = this.getFormData(data.model);
            this.sendNote(formData);

          } else {
            console.log('error submit!!');
            return false;
          }
        });
      },
      edit(){
        const data = this.$refs[this.formName];
        data.validate((valid) => {
          if (valid) {
            const formData = this.getFormData(data.model);
            this.editNote(formData);
          } else {
            console.log('error submit!!');
            return false;
          }
        });
      },
      sendNote(formData){
        const vm = this;
        vm.axios({
          method: 'post',
          url: '/note',
          data: formData,
        }).then(function (response) {
          if(response.status == 200){
            vm.$events.emit('addNote', response.data);
            vm.formSaved();
          }
        });
      },
      editNote(formData){
        const vm = this;
        vm.axios({
          method: 'post',
          url: '/note/' + this.model.id,
          data: formData,
        }).then(function (response) {
          if(response.status == 200){
            vm.$events.emit('updateNote', response.data);
            vm.formSaved();
          }
        });
      },
      formSaved(){
        this.$refs[this.formName].resetFields();
        this.noTime = false;
        this.$events.emit('NoteCreated');
      },
      getFormData(data = {}){
        const formData = new FormData();
        for(var key in data){
          formData.append(key, data[key]);
        }
        return formData;
      },
    },
    mounted() {
      if(this.note != null) this.model.tags = this.note.tags.map(item => item.id);
    },
    created(){
      if(this.note != null) Object.assign(this.model, this.note);
      this.$events.on('createNote', () => {return this.save()})
      this.$events.on('editTNote', () => {return this.edit()})
    },
  }
</script>

<style>
    .el-radio-group{
        vertical-align: middle;
        float: left;
        font-size: 14px;
        color: #606266;
        line-height: 40px;
        margin-left: 15%;
    }
    .radio-max{
        color: #f44336;
    }
    .radio-mid{
        color: #2196f3;
    }
    .radio-min{
        color: #4caf50;
    }
</style>