import axios from 'axios';
import Vue from 'vue';


const instance = axios.create({
  baseURL: 'http://blog.test/',
});
/*instance.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
instance.interceptors.response.use(function (response) {
  return response;
}, function (error) {
  if(error.response.status === 401){
    Vue.auth.refresh();
    document.cookie = "rememberMe=true"; //TODO поменять эту херь если есть возможность через vue-auth
  }
  return error.response
});*/
export default instance;
