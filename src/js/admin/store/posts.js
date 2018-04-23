const store = {
  namespaced: true,
  state: {
    posts: []
  },
  getters:{
    getPosts(state){
      return state.posts
    },
    getPost(state, id){
      return state.posts.find(post => post.id == id);
    },
  },
  mutations: {
    setPosts(state, data){
      state.posts = data;
    },
    addPost(state, data){
      state.posts.push(data);
    }
  },
  actions: {
    setPosts(context, data){
      context.commit('setPosts', data);
    },
    addPost(context, data){
      context.commit('addPost', data);
    }
  },
  modules: {},
  strict: true,
};

export default store;