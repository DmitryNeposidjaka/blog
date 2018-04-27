const store = {
  namespaced: true,
  state: {
    categories: []
  },
  getters:{
    getCategories(state){
      return state.categories
    },
    getCategory(state, id){
      return state.categories.find(category => category.id == id);
    },
  },
  mutations: {
    setCategories(state, data){
      state.categories = data;
    },
    addCategory(state, data){
      state.categories.push(data);
    },
    updateCategory(state, data){
      state.categories.map(function(item, i, arr){
        if(item.id == data.id){
          state.categories.splice(i, 1, data);
        }
      });
    },
  },
  actions: {
    setCategories(context, data){
      context.commit('setCategories', data);
    },
    addCategory(context, data){
      context.commit('addCategory', data);
    },
    updateCategory(context, data){
      context.commit('updateCategory', data);
    },
  },
  modules: {},
  strict: true,
};

export default store;