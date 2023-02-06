module.exports = (sequelize, Sequelize) => {
  const Admin = sequelize.define("admin", {
    firstname: {
      type: Sequelize.STRING
    },
    lastname: {
      type: Sequelize.STRING
    },
    email: {
      type: Sequelize.STRING
    },
    password: {
      type: Sequelize.STRING
    }
  });

  return Admin;
};
