import Vue from 'vue';
import ElementUI from 'element-ui';
import VueEvents from 'vue-events';
import locale from 'element-ui/lib/locale/lang/ru-RU';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI, { locale });
Vue.use(VueEvents);

const vm = new Vue();

export default vm;