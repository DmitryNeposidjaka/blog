<template>
    <el-form label-position="right" :model="authForm" ref="authFormRef" :rules="rules" label-width="50px" class="auth-form">
        <el-form-item label="Login" prop="login">
            <el-input type="text" v-model="authForm.login"></el-input>
        </el-form-item>
        <el-form-item label="Pass" prop="password">
            <el-input type="password" v-model="authForm.password"></el-input>
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="login('authFormRef')">login</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
export default {
  data(){
    return{
      authForm: {
        login: "",
        password: "",
      },
      rules: {
        login: [
          { required: true, message: "Login is required", trigger: 'blur'},
          { min: 4, max: 10, message: "Length is not available", trigger: 'blur'},
        ],
        password: [
          { required: true, message: "Password is required", trigger: 'blur'},
          { min: 4, max: 10, message: "Length is not available", trigger: 'blur'},
        ],
      }
    }
  },
  methods: {
    login($ref){
      const vm = this;
        const form = this.$refs[$ref];
        form.validate((valid) => {
          if(valid){
            const model = this.$refs[$ref].model;
            vm._sendRequest(
              vm._createFormData(model)
            );
          }
        });
    },
    _createFormData(model){
      const formData = new FormData();
      for (var index in model) {
        formData.set(index, model[index]);
      }
      return formData;
    },
    _sendRequest(formData){
      this.$auth.login({
        method: 'post',
        data: formData
      });
    }
  },
  mounted(){
    console.log(this.$auth);
  }
}
</script>

<style>
.auth-form{
    width: 300px;
    background-color: #e5e9f2;
    padding: 40px;
    border: 2px solid #ced3e0;
}
</style>