import axios from 'axios';
import Vue from 'vue';

const instance = axios.create({
  baseURL: 'http://blog.test/api/admin',
});
 instance.interceptors.response.use(function (response) {
  return response;
  }, function (error) {
  if(error.response.status === 401){
    Vue.auth.refresh();
    document.cookie = "remeberMe=true"; //TODO поменять эту херь если есть возможность через vue-auth
  }
   return error.response
});
export default instance;
