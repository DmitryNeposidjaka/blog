<template>
    <el-form :ref="formName"  :rules="rules" :model="model" label-width="120px">
        <el-form-item label="Название" prop="title">
            <el-input v-model="model.title"></el-input>
        </el-form-item>
        <el-form-item label="Описание" prop="description">
            <el-input  type="textarea" v-model="model.description"></el-input>
        </el-form-item>
        <el-form-item label="Приоритет" prop="important">
            <el-radio-group v-model="model.important">
                <el-radio class="radio-max" label="MAX">Высокий</el-radio>
                <el-radio class="radio-mid" label="MIDDLE">Средний</el-radio>
                <el-radio class="radio-min" label="MIN">Низкий</el-radio>
            </el-radio-group>
        </el-form-item>
        <el-form-item label="Исполнитель">
            <el-select v-model="model.exec" filterable placeholder="На себя"
             :disabled="true">
                <el-option
                        v-for="item in []"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value">
                </el-option>
            </el-select>
        </el-form-item>
        <el-form-item label="На время">
            <el-date-picker
                    :disabled="Boolean(model.unlimited)"
                    v-model="model.assigned_at"
                    type="datetime"
                    placeholder="Выберите дату назначения">
            </el-date-picker>
            <el-checkbox v-model="model.unlimited" label="Безсрочный"></el-checkbox>
        </el-form-item>
    </el-form>
</template>

<script>
export default {
  props: {task: {default: null}},
  data(){
    return{
      formName: 'taskForm',
      noTime: false,
      model: {
        title: '',
        description: '',
        important: '',
        exec: null,
        assigned_at: '',
        unlimited: false,
      },
      rules:{
        title: [
          {required: true, message: 'Название должно быть заполнени'},
          {min: 5, max: 255, message: 'Длина заголовка должна быть между 5-ю и 255-ти'}
        ],
        description: [
          {required: true, message: 'Описание должно быть заполнени'},
          {max: 255, message: 'Максимальная дляна 255'},
        ],
        important: [
          {required: true, message: 'Выставь свои приоритеты!!'},
        ]
      }
    }
  },
  methods: {
    save(){
      const data = this.$refs[this.formName];
      data.validate((valid) => {
        if (valid) {
          const formData = this.getFormData(data.model);
          this.sendTask(formData);

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
          this.editTask(formData);
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    sendTask(formData){
      const vm = this;
      vm.axios({
        method: 'post',
        url: '/task',
        data: formData,
      }).then(function (response) {
        if(response.status == 200){
          vm.$events.emit('addTask', response.data);
          vm.formSaved();
        }
      });
    },
    editTask(formData){
      const vm = this;
      vm.axios({
        method: 'post',
        url: '/task/' + this.model.id,
        data: formData,
      }).then(function (response) {
        if(response.status == 200){
          vm.$events.emit('updateTask', response.data);
          vm.formSaved();
        }
      });
    },
    formSaved(){
      this.$refs[this.formName].resetFields();
      this.$events.emit('TaskCreated');
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
    if(this.task != null) Object.assign(this.model, this.task);
    this.$events.on('createTask', () => {return this.save()})
    this.$events.on('editTask', () => {return this.edit()})
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