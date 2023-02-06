const db = require("../models");
const Admin = db.admins;
const Op = db.Sequelize.Op;
const axios = require('axios');


// Create and Save a new Customer
exports.auth = (req, res) => {
  let url = new URL('http://localhost:8085/authorize');
  url.searchParams.append('response_type','code');
  url.searchParams.append('client_id','feb1d8d3365777f837a20e2cfb1e40b9');
  url.searchParams.append('redirect_uri','http://localhost:5007/check');
  url.searchParams.append('scope','customer_list');
  url.searchParams.append('state','12345');
  res.redirect(301, url.toString());
};

exports.check = (req, res) => {

  const data = {
    grant_type: 'authorization_code',
    client_id: 'feb1d8d3365777f837a20e2cfb1e40b9',
    client_secret: '277270b113971cd441d70b6761a999c311da21d715bc662555cf42ddb688d9e385105719e6aa27f9cd72d7a449747b653d921b2d5f56437c94c6ed8e01b56c68',
    redirect_uri: 'http://localhost:5007/check',
    code: req.query.code,
  };
let d = {};
  axios.post('http://oauth_server_ngnix_php:8090/token', data,{
    headers: {
      "Content-Type": "multipart/form-data",
    },
  })
      .then((response) => {
        req.session.token = response.data;
        let url = new URL('http://localhost:5000/');
        res.redirect(301, url.toString());
      }).catch((err) => {
    console.error(err);
  });

};

// Create and Save a new Customer
exports.token = (req, res) => {
console.log(req.session);
    if (req.session.token){
      res.json({ token: req.session.token.access_token })
    }
    res.json({token:''});
};
