const store = {
  namespaced: true,
  state: {
    tasks: []
  },
  getters:{
    getTasks(state){
      return state.tasks
    },
    getTask(state, id){
      return state.tasks.find(post => post.id == id);
    },
  },
  mutations: {
    setTasks(state, data){
      state.tasks = data;
    },
    addTask(state, data){
      state.tasks.push(data);
    },
    updateTask(state, data){
      state.tasks.map(function(item, i, arr){
        if(item.id == data.id){
          state.tasks.splice(i, 1, data);
        }
      });
    },
  },
  actions: {
    setTasks(context, data){
      context.commit('setTasks', data);
    },
    addTask(context, data){
      context.commit('addTask', data);
    },
    updateTask(context, data){
      context.commit('updateTask', data);
    },
  },
  modules: {},
  strict: true,
};

export default store;