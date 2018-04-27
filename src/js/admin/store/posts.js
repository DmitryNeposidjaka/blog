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
    },
    updatePost(state, data){
      state.posts.map(function(item, i, arr){
        if(item.id == data.id){
          state.posts.splice(i, 1, data);
        }
      });
    },
  },
  actions: {
    setPosts(context, data){
      context.commit('setPosts', data);
    },
    addPost(context, data){
      context.commit('addPost', data);
    },
    updatePost(context, data){
      console.log(data)
      context.commit('updatePost', data);
    },
  },
  modules: {},
  strict: true,
};

export default store;