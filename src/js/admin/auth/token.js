module.exports = {

  request: function (req, token) {
    this.options.http._setHeaders.call(this, req, {Authorization: 'Bearer ' + token});
  },

  response: function (res) {
      token = res.accessToken;

    if (token) {
      return token;
    }
  }
};