import Vue from 'vue';

const statuses = {
  401: function(data){
    Vue.auth.refresh()

  },
  200: function(data){

  }
}

export default statuses;