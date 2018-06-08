const store = {
  namespaced: true,
  state: {
    taskTags: []
  },
  getters:{
    getTags(state){
      return state.taskTags
    },
    getTag(state, id){
      return state.taskTags.find(tag => tag.id == id);
    },
  },
  mutations: {
    setTags(state, data){
      state.taskTags = data;
    },
    addTag(state, data){
      state.taskTags.push(data);
    },
    updateTag(state, data){
      state.taskTags.map(function(item, i, arr){
        if(item.id == data.id){
          state.taskTags.splice(i, 1, data);
        }
      });
    },
  },
  actions: {
    setTags(context, data){
      context.commit('setTags', data);
    },
    addTag(context, data){
      context.commit('addTag', data);
    },
    updateTag(context, data){
      context.commit('updateTag', data);
    },
  },
  modules: {},
  strict: true,
};

export default store;