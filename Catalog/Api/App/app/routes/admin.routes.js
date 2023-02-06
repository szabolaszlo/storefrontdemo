
module.exports = app => {
  const admins = require("../controllers/admin.controller.js");

  var router = require("express").Router();

  router.post("/", admins.create);

  router.get("/", admins.findAll);

  router.post("/auth", admins.auth);

  router.post("/by_email", admins.getByEmail);

  router.get("/:id", admins.findOne);

  router.put("/:id", admins.update);

  router.delete("/", admins.deleteAll);

  app.use('/api/admins', router);
};
