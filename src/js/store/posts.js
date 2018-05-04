const posts = {
  state: {
    posts: []
  },
  namespaced: true,
  getters: {
    getPosts(state){
      return state.posts;
    },
    getPost(state, id){
      return state.posts.map(function (item, i, arr) {
        return item.id == id;
      });
    }
  },
  mutations: {
    setPosts(state, data){
      state.posts = data;
    },
  },
  actions: {
    setPosts(context, data){
      context.commit('setPosts', data);
    }
  },

}
export default posts;