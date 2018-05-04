const categories = {
  state: {
    categories: []
  },
  namespaced: true,
  getters: {
    getCategories(state){
      return state.categories;
    },
    getCategorie(state, id){
      return state.categories.map(function (item, i, arr) {
        return item.id == id;
      });
    }
  },
  mutations: {
    setCategories(state, data){
      state.categories = data;
    },
  },
  actions: {
    setCategories(context, data){
      context.commit('setCategories', data);
    }
  },

}
export default categories;