import Vue from 'vue';
import App from './App';
import router from './router';
import ElementUI from 'element-ui';
import VueI18n from 'vue-i18n';
import VueAxios from 'vue-axios';
import VueEvents from 'vue-events';
import moment from 'vue-moment';
import locale from 'element-ui/lib/locale/lang/ru-RU';
import store from './store';

import 'element-ui/lib/theme-chalk/index.css';
import axios from "./config/axios";

Vue.use(VueAxios, axios);
Vue.use(VueEvents);
Vue.use(VueI18n);
Vue.use(ElementUI, { locale });
Vue.use(moment);

new Vue({
  el: '#app',
  template: '<App/>',
  router,
  store,
  components: {App}
});