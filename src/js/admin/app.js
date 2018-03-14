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

Vue.use(VueEvents);
Vue.use(VueAxios, axios);
Vue.use(VueI18n);
Vue.use(ElementUI, { locale });
Vue.use(moment);
Vue.config.devtools = true  //  Включает Vue devtools
new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: {App},

});