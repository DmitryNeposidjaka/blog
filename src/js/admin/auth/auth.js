const auth = {
  version: '0.1',
  isAuthorized: false,
  getToken(){
    console.log(document.cookie)
  }
}
export default auth;