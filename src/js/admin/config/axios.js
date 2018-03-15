import axios from 'axios';

const instance = axios.create({
  baseURL: 'http://blog.test/api/admin',
});
/* instance.interceptors.response.use(function (response) {
  // Do something with response data
  console.log(response);
  return response;
}, function (error) {
  // Do something with response error
  if(error.response.status === 401){
    alert('Вы не авторезированы');
  }
}); */
export default instance;
