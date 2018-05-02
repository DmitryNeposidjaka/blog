const store = {
  namespaced: true,
  state: {
    tags: []
  },
  getters:{
    getTags(state){
      return state.tags
    },
    getTag(state, id){
      return state.tags.find(tag => tag.id == id);
    },
  },
  mutations: {
    setTags(state, data){
      state.tags = data;
    },
    addTag(state, data){
      state.tags.push(data);
    },
    updateTag(state, data){
      state.tags.map(function(item, i, arr){
        if(item.id == data.id){
          state.tags.splice(i, 1, data);
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