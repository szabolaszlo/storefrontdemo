const db = require("../models");
const Subscriber = db.subscribers;
const Op = db.Sequelize.Op;

exports.create = (req, res) => {
  // Validate request
  if (!req.body.email) {
    res.status(400).send({
      message: "Email can not be empty!"
    });
    return;
  }


  const subscriber = {
    firstname: req.body.firstname,
    lastname: req.body.lastname,
    email: req.body.email,
    customer: req.body.customer || false,
  };

  // Save customer in the database
  Subscriber.create(subscriber)
    .then(data => {
      res.send(data);
    })
    .catch(err => {
      res.status(500).send({
        message:
          err.message || "Some error occurred while creating the subscriber."
      });
    });
};

exports.findAll = (req, res) => {

  Subscriber.findAll()
    .then(data => {
      res.send(data);
    })
    .catch(err => {
      res.status(500).send({
        message:
          err.message || "Some error occurred while retrieving subscribers."
      });
    });
};

// Find a single Customer with an id
exports.findOne = (req, res) => {
  const id = req.params.id;

  Subscriber.findByPk(id)
    .then(data => {
      if (data) {
        res.send(data);
      } else {
        res.status(404).send({
          message: `Cannot find Subscriber with id=${id}.`
        });
      }
    })
    .catch(err => {
      res.status(500).send({
        message: "Error retrieving Subscriber with id=" + id
      });
    });
};

exports.update = (req, res) => {
  const id = req.params.id;

  Subscriber.update(req.body, {
    where: { id: id }
  })
    .then(num => {
      if (num == 1) {
        res.send({
          message: "Subscriber was updated successfully."
        });
      } else {
        res.send({
          message: `Cannot update Subscriber with id=${id}. Maybe Subscriber was not found or req.body is empty!`
        });
      }
    })
    .catch(err => {
      res.status(500).send({
        message: "Error updating Subscriber with id=" + id
      });
    });
};

exports.delete = (req, res) => {
  const id = req.params.id;

  Subscriber.destroy({
    where: { id: id }
  })
    .then(num => {
      if (num == 1) {
        res.send({
          message: "Subscriber was deleted successfully!"
        });
      } else {
        res.send({
          message: `Cannot delete Subscriber with id=${id}. Maybe Subscriber was not found!`
        });
      }
    })
    .catch(err => {
      res.status(500).send({
        message: "Could not delete Subscriber with id=" + id
      });
    });
};

exports.deleteAll = (req, res) => {
  Subscriber.destroy({
    where: {},
    truncate: false
  })
    .then(nums => {
      res.send({ message: `${nums} Subscriber were deleted successfully!` });
    })
    .catch(err => {
      res.status(500).send({
        message:
          err.message || "Some error occurred while removing all Subscriber."
      });
    });
};

