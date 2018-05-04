import Vue from 'vue';
import Vuex from 'vuex';
import posts from './posts';
import categories from './categories';

Vue.use(Vuex);

const store = () => new Vuex.Store({
  state: {},
  mutations: {},
  modules: {posts, categories}
});

export default store;