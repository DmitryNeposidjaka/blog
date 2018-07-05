const store = {
  namespaced: true,
  state: {
    noteTags: []
  },
  getters:{
    getTags(state){
      return state.noteTags
    },
    getTag(state, id){
      return state.noteTags.find(tag => tag.id == id);
    },
  },
  mutations: {
    setTags(state, data){
      state.noteTags = data;
    },
    addTag(state, data){
      state.noteTags.push(data);
    },
    updateTag(state, data){
      state.noteTags.map(function(item, i, arr){
        if(item.id == data.id){
          state.noteTags.splice(i, 1, data);
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