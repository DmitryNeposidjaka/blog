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
    },
    getCategoryPost: state => {
      return (id) => {
        return state.posts.filter(function (item, i, arr) {
          const c = item.categories.filter(function (item, i, arr) {
            return item.category_id == id;
          });
          return c.length > 0
        })
      }
    },
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