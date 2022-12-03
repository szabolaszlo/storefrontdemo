module.exports = app => {
  const subscribers = require("../controllers/subscriber.controller.js");

  var router = require("express").Router();

  router.post("/", subscribers.create);

  router.get("/", subscribers.findAll);


  router.get("/:id", subscribers.findOne);


  router.put("/:id", subscribers.update);


  router.delete("/", subscribers.deleteAll);

  app.use('/api/subscribers', router);
};
