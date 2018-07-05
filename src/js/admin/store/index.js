import Vue from 'vue';
import Vuex from 'vuex';
import posts from './posts';
import tags from './tags';
import taskTags from './tasktags';
import noteTags from './notetags';
import tasks from './tasks';
import notes from './notes';
import achieves from './achieves';
import categories from './categories';

Vue.use(Vuex);

const store = () => new Vuex.Store({
  state: {},
  mutations: {},
  modules: {posts, categories, tags, tasks, notes, achieves, taskTags, noteTags},
  strict: true,
});

export default store;
