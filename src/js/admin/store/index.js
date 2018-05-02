import Vue from 'vue';
import Vuex from 'vuex';
import posts from './posts';
import tags from './tags';
import categories from './categories';

Vue.use(Vuex);

const store = () => new Vuex.Store({
  state: {},
  mutations: {},
  modules: {posts, categories, tags},
  strict: true,
});

export default store;
