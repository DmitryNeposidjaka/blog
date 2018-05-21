import Vue from 'vue';
import VueI18n from 'vue-i18n';
import ElementUI from 'element-ui';
import VueAxios from 'vue-axios';
import VueEvents from 'vue-events';
import moment from 'vue-moment';
import locale from 'element-ui/lib/locale/lang/ru-RU';
import App from './App';
import router from './router';
import axios from './config/axios';
import store from './store';
import 'element-ui/lib/theme-chalk/index.css';



Vue.router = router;
Vue.use(VueEvents);
Vue.use(VueAxios, axios);
Vue.use(VueI18n);
Vue.use(ElementUI, { locale });
Vue.use(moment);
console.log(process.env.MIX_HOST)

Vue.use(require('@websanova/vue-auth'), {
  auth: require('./auth/token.js'),
  http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
  tokenStore: ['cookie'],
  tokenDefaultName: 'myToken',
  tokenExpired: ()=> {
    console.log('tokenExpired')
  },
  refreshData: {url: 'auth/refresh', method: 'GET', enabled: true, interval: 30, rememberMe: true}
});

Vue.config.devtools = true  //  Включает Vue devtools
new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: {App,},
  created(){
    this.$auth.ready()
  }
});