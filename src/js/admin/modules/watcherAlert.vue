<template>
  <div>
  <el-alert
          v-for="(alert, key) in alerts"
          :key="key"
          :title="alert.title"
          type="error"
          :description="alert.description"
          show-icon>
  </el-alert>
  </div>
</template>

<script>
export default {
  data(){
    return{
      alerts: [],
    };
  },
  methods:{
    close(){
      this.alert = false;
      this.title = '';
      this.description = '';
    },
    addAlert(title = '', description = ''){
      const alert = {};
      alert.title = String(title);
      alert.description = String(description);
      this.alerts.push(alert);
    }
  },
  mounted(){},
  created(){
    this.$events.on('findHttpError', (i) => {this.addAlert(i.status, i.data)})
  }
};
</script>

<style>
</style>
