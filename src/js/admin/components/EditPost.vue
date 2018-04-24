<template>
    <el-form ref="postForm" :model="postForm" :rules="rules" label-width="120px" :ref="formName" >
        <el-row :gutter="10">
            <el-col :span="23">
                <el-form-item label="Название" prop="title">
                    <el-input v-model="postForm.title"></el-input>
                </el-form-item>
            </el-col>
            <el-col :span="1">
                <span :class="{danger: isMaxTitle, warning: isWarningTitle}">{{titleLength}}</span>
            </el-col>
        </el-row>
        <el-row :gutter="20">
            <el-col :span="12">
                <el-form-item label="Контент" prop="text">
                    <el-input type="textarea" v-model="postForm.text" :rows="10"></el-input>
                </el-form-item>
            </el-col>
            <el-col :span="12">
                <vue-markdown :source="postForm.text" class="my-markdown"></vue-markdown>
            </el-col>
        </el-row>
    </el-form>
</template>

<script>
  import VueMarkdown from 'vue-markdown'
  export default {
    props: ['model'],
    data(){
      return{
        formName: 'postForm',
        postForm: {
          title: '',
          text: '',
        },
        rules:{
          title: [
            {required: true, message: 'Название должно быть заполнени'},
            {min: 5, max: 255, message: 'Длина заголовка должна быть между 5-ю и 255-ти'}
          ],
          text: [
            {required: true, message: 'В статье должен быть контент'},
          ]
        },
      }
    },
    computed: {
      titleLength(){
        return this.postForm.title.length;
      },
      isMaxTitle(){
        return this.postForm.title.length >= 255;
      },
      isWarningTitle(){
        return this.postForm.title.length >= 200;
      },
    },
    methods: {
      save(){
        const data = this.$refs[this.formName];
        if (!data.validate()) return false;

        const formData = this.getFormData(data.model);
        this.sendPost(this.model.id, formData);
      },
      sendPost(id, formData){
        const vm = this;
        vm.axios({
          method: 'post',
          url: '/posts/'+id,
          data: formData,
        }).then(function (response) {
          if(response.status == 200){
            vm.postUpdated();
          }
        });
      },
      postUpdated(){
        this.$events.emit('postUpdated');
      },
      getFormData(data = {}){
        const formData = new FormData();
        for(var key in data){
          formData.append(key, data[key]);
        }
        return formData;
      }
    },
    created(){
      this.postForm = this.model;   //TODO переписать под модель в форму
      this.$events.on('editPost', () => {this.save()})
    },
    components: {VueMarkdown}
  }
</script>

<style>

</style>