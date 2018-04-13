import auth from './auth'
export default {
  install(Vue, options = {}){
    let pluginName = options.hasOwnProperty('name')? options.name : 'myAuth';
    Vue[pluginName] = auth;
  }
}