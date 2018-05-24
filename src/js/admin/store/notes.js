const store = {
  namespaced: true,
  state: {
    notes: []
  },
  getters:{
    getNotes(state){
      return state.notes
    },
    getNote(state, id){
      return state.notes.find(post => post.id == id);
    },
  },
  mutations: {
    setNotes(state, data){
      state.notes = data;
    },
    addNote(state, data){
      state.notes.push(data);
    },
    updateNote(state, data){
      state.notes.map(function(item, i, arr){
        if(item.id == data.id){
          state.notes.splice(i, 1, data);
        }
      });
    },
  },
  actions: {
    setNotes(context, data){
      context.commit('setNotes', data);
    },
    addNote(context, data){
      context.commit('addNote', data);
    },
    updateNote(context, data){
      context.commit('updateNote', data);
    },
  },
  modules: {},
  strict: true,
};

export default store;