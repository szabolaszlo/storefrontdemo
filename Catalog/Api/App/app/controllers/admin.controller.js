const db = require("../models");
const Admin = db.admins;
const Op = db.Sequelize.Op;

exports.getByEmail = (req, res) => {
  if (!req.body.email) {
    res.status(400).send({
      message: "Email can not be empty!"
    });
    return;
  }

  Admin.findOne({where: {email: req.body.email}})
      .then(data => {
        if (data) {
          res.send(data);
        } else {
          res.status(401).send({
            message: `Admin is not found`
          });
        }
      })
      .catch(err => {
        res.status(500).send({
          message: "Error on getting Customer"
        });
      });
}

exports.auth = (req, res) => {
  if (!req.body.email || !req.body.password) {
    res.status(400).send({
      message: "Email and password can not be empty!"
    });
    return;
  }

  Admin.findOne({where: {email: req.body.email, password: req.body.password}})
      .then(data => {
        if (data) {
          res.send(data);
        } else {
          res.status(403).send({
            message: `Authentication is failed`
          });
        }
      })
      .catch(err => {
        res.status(500).send({
          message: "Error on authentication"
        });
      });
}

// Create and Save a new Customer
exports.create = (req, res) => {
  // Validate request
  if (!req.body.email || !req.body.password) {
    res.status(400).send({
      message: "Email can not be empty!"
    });
    return;
  }

  // Create a Customer
  const admin = {
    firstname: req.body.firstname,
    lastname: req.body.lastname,
    email: req.body.email,
    password: req.body.password
  };

  // Save customer in the database
  Admin.create(admin)
    .then(data => {
      res.send(data);
    })
    .catch(err => {
      res.status(500).send({
        message:
          err.message || "Some error occurred while creating the customer."
      });
    });
};

// Retrieve all Customer from the database.
exports.findAll = (req, res) => {

  Admin.findAll()
    .then(data => {
      res.send(data);
    })
    .catch(err => {
      res.status(500).send({
        message:
          err.message || "Some error occurred while retrieving customers."
      });
    });
};

// Find a single Customer with an id
exports.findOne = (req, res) => {
  const id = req.params.id;

  Admin.findByPk(id)
    .then(data => {
      if (data) {
        res.send(data);
      } else {
        res.status(404).send({
          message: `Cannot find Admin with id=${id}.`
        });
      }
    })
    .catch(err => {
      res.status(500).send({
        message: "Error retrieving Admin with id=" + id
      });
    });
};

// Update a Customer by the id in the request
exports.update = (req, res) => {
  const id = req.params.id;

  Admin.update(req.body, {
    where: { id: id }
  })
    .then(num => {
      if (num == 1) {
        res.send({
          message: "Admin was updated successfully."
        });
      } else {
        res.send({
          message: `Cannot update Admin with id=${id}. Maybe Customer was not found or req.body is empty!`
        });
      }
    })
    .catch(err => {
      res.status(500).send({
        message: "Error updating Admin with id=" + id
      });
    });
};

// Delete a Customer with the specified id in the request
exports.delete = (req, res) => {
  const id = req.params.id;

  Admin.destroy({
    where: { id: id }
  })
    .then(num => {
      if (num == 1) {
        res.send({
          message: "Admin was deleted successfully!"
        });
      } else {
        res.send({
          message: `Cannot delete Admin with id=${id}. Maybe Admin was not found!`
        });
      }
    })
    .catch(err => {
      res.status(500).send({
        message: "Could not delete CuCustomerAdminstomer with id=" + id
      });
    });
};

// Delete all Tutorials from the database.
exports.deleteAll = (req, res) => {
  Admin.destroy({
    where: {},
    truncate: false
  })
    .then(nums => {
      res.send({ message: `${nums} Admin were deleted successfully!` });
    })
    .catch(err => {
      res.status(500).send({
        message:
          err.message || "Some error occurred while removing all Customer."
      });
    });
};

