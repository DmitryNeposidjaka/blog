<template>
    <el-form ref="form" :model="form" :rules="rules" label-width="120px" :ref="formName">
        <el-row :gutter="10">
            <el-col :span="23">
                <el-form-item label="Название" prop="title">
                    <el-input v-model="form.name"></el-input>
                </el-form-item>
            </el-col>
        </el-row>
    </el-form>
</template>

<script>
export default {
  props: ['formName', 'sendData'],
  data(){
    return {
      form: {
        name: ''
      },
      rules: {
        name: [
          {required: true, message: 'Название обязательно!'},
          {min: 3, max: 56, message: 'Длина между 3-я и 56-ю символами'},
        ]
      }
    }
  },
  methods: {
    saveForm(){
      const data = this.$refs[this.formName];
      data.validate((valid) => {
        if (valid) {
          const formData = this.getFormData(data.model);
          this.sendData(formData);

        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    getFormData(data = {}){
      const formData = new FormData();
      for(var key in data){
        formData.append(key, data[key]);
      }
      return formData;
    },
  },
  created(){
    this.$events.on('saveStruct', () => {this.saveForm()})
  }
}
</script>

<style>

</style>