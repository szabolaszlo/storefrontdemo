
module.exports = app => {
  const admins = require("../controllers/admin.controller.js");

  var router = require("express").Router();

  router.get("/auth", admins.auth);
  router.get("/check", admins.check);
  router.get("/token", admins.token);

  app.use('/', router);
};
