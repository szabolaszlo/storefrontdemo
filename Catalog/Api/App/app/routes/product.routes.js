const products = require('../controllers/product.controller')

module.exports = app => {
  const products = require("../controllers/product.controller");

  var router = require("express").Router();

  router.post("/", products.create);

  router.get("/", products.findAll);

  router.get("/:id", products.findOne);

  router.get("/by_sku/:sku", products.getBySku);

  router.put("/:id", products.update);

  router.delete("/:id", products.delete);

  app.use('/api/products', router);
};
