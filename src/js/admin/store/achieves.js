const store = {
  namespaced: true,
  state: {
    achieves: []
  },
  getters:{
    getAchieves(state){
      return state.achieves
    },
    getAchieve(state, id){
      return state.achieves.find(post => post.id == id);
    },
  },
  mutations: {
    setAchieves(state, data){
      state.achieves = data;
    },
    addAchieve(state, data){
      state.achieves.push(data);
    },
    updateAchieve(state, data){
      state.achieves.map(function(item, i, arr){
        if(item.id == data.id){
          state.achieves.splice(i, 1, data);
        }
      });
    },
  },
  actions: {
    setAchieves(context, data){
      context.commit('setAchieves', data);
    },
    addAchieve(context, data){
      context.commit('addAchieve', data);
    },
    updateAchieve(context, data){
      context.commit('updateAchieve', data);
    },
  },
  modules: {},
  strict: true,
};

export default store;