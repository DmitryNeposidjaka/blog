<template>
    <el-header>
        <div>
            <el-radio-group v-model="radio3" fill="#909399">
                <el-radio-button :label="1">Сутки</el-radio-button>
                <el-radio-button :label="2">Неделя</el-radio-button>
                <el-radio-button :label="3">Месяц</el-radio-button>
                <el-radio-button :label="4">Год</el-radio-button>
            </el-radio-group>
        </div>
    </el-header>
</template>

<script>
export default {
  data(){
    return {
      radio3: 1
    }
  }
}
</script>

<style scoped>
@import "../styles/content-header.css";
</style>