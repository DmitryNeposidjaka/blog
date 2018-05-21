import axios from 'axios';
import Vue from 'vue';
import httpWatcher from '../modules/httpWatcher'

const instance = axios.create({
  baseURL: process.env.MIX_HOST+'/api/admin',
});
instance.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
 instance.interceptors.response.use(function (response) {
  return response;
  }, function (error) {
  if(error.response.status === 401){
    Vue.auth.refresh();
    document.cookie = "rememberMe=true"; //TODO поменять эту херь если есть возможность через vue-auth
  }
   httpWatcher.$events.emit('findHttpError', error.response)
   return error.response
});
export default instance;
