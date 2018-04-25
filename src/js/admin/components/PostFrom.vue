<template>
    <el-form ref="postForm" :model="postForm" :rules="rules" label-width="120px" :ref="formName" >
        <el-collapse>
            <el-collapse-item title="Название, миниатюра, описание" name="1">
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
                <el-row>
                    <el-col :span="24">
                        <el-upload
                                class="avatar-uploader"
                                action="https://jsonplaceholder.typicode.com/posts/"
                                :show-file-list="false"
                                :on-success="handleAvatarSuccess"
                                :before-upload="beforeAvatarUpload"
                        >
                            <img v-if="postForm.thumbnail" :src="postForm.thumbnail" class="avatar">
                            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                        </el-upload>
                    </el-col>
                </el-row>
                <el-row :gutter="20">
                    <el-col :span="12">
                        <el-form-item label="Описание" >
                            <el-input type="textarea" v-model="postForm.description" :rows="3"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="11">
                        <vue-markdown :source="postForm.description" class="my-markdown-description"></vue-markdown>
                    </el-col>
                    <el-col :span="1">
                        <span :class="{danger: isMaxDescription, warning: isWarningDescription}">{{descriptionLength}}</span>
                    </el-col>
                </el-row>            </el-collapse-item>
        </el-collapse>

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
import ElRow from "element-ui/packages/row/src/row";
export default {
  data(){
    return{
      formName: 'postForm',
      postForm: {
        thumbnail: '',
        description: '',
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
    descriptionLength(){
      return this.postForm.description.length;
    },
    isMaxDescription(){
      return this.postForm.description.length >= 255;
    },
    isWarningDescription(){
      return this.postForm.description.length >= 200;
    },
  },
  methods: {
    save(){
      const data = this.$refs[this.formName];

      if (data.validate() == true){
        const formData = this.getFormData(data.model);
        this.sendPost(formData);
      }
    },
    sendPost(formData){
      const vm = this;
      vm.axios({
        method: 'post',
        url: '/posts',
        data: formData,
      }).then(function (response) {
        if(response.status == 200){
          vm.formSaved();
        }
      });
    },
    formSaved(){
      this.$refs[this.formName].resetFields();
      this.$events.emit('postSaved');
    },
    getFormData(data = {}){
      const formData = new FormData();
      for(var key in data){
        formData.append(key, data[key]);
      }
      return formData;
    },
    handleAvatarSuccess(res, file) {
      this.postForm.thumbnail = URL.createObjectURL(file.raw);
    },
    beforeAvatarUpload(file) {
      const isJPG = file.type === 'image/jpeg';
      const isLt2M = file.size / 1024 / 1024 < 2;

      if (!isJPG) {
        this.$message.error('Avatar picture must be JPG format!');
      }
      if (!isLt2M) {
        this.$message.error('Avatar picture size can not exceed 2MB!');
      }
      return isJPG && isLt2M;
    }
  },
  created(){
    this.$events.on('savePost', () => {return this.save()})
  },
  components: {
    ElRow,
    VueMarkdown}
}
</script>

<style>
    .danger{
        color: red;
    }
    .warning{
        color: orange;
    }
    .my-markdown{
        border: 1px solid #66b1ff;
        padding: 5px 15px;
        border-radius: 4px;
        min-height: 200px;
    }
    .my-markdown-description{
        border: 1px solid #66b1ff;
        padding: 5px 15px;
        border-radius: 4px;
        min-height: 50px;
    }
    .avatar-uploader .el-upload {
        border: 1px dashed #d9d9d9;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;

        width: 100%;
        height: 300px;
    }
    .avatar-uploader {
        margin: 5px 5px 30px 120px;
    }
    .avatar-uploader .el-upload:hover {
        border-color: #409EFF;
    }
    .avatar-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 178px;
        height: 178px;
        line-height: 278px;
        text-align: center;
    }
    .avatar {
        width: 178px;
        height: 178px;
        display: block;
    }
</style>