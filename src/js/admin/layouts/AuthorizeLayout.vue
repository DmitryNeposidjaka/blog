<template>
    <el-container  class="auth-background">
        <el-main style="padding-top: 0px">
            <el-row :gutter="20" justify="center" align="middle" type="flex">
                <el-col :span="24" >
                    <div class="auth-container" >
                <authorize-form class="authorize-form"></authorize-form>
                    </div>
                </el-col>
            </el-row>
        </el-main>
    </el-container>
</template>

<script>
import AuthorizeForm from '../components/Authorize';

export default {
  components: { AuthorizeForm },
};
</script>

<style>
    body {
        margin: 0px;
    }
.auth-background{
    background-color: #fff;
    height: 800px;
}
.auth-container{
    min-width: 200px;
    margin: auto;
}
    .authorize-form{
        width: 250px;
        margin: auto;
    }
</style>