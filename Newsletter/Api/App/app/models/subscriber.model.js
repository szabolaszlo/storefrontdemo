module.exports = (sequelize, Sequelize) => {
  const Subscriber = sequelize.define("subscriber", {
    firstname: {
      type: Sequelize.STRING
    },
    lastname: {
      type: Sequelize.STRING
    },
    email: {
      type: Sequelize.STRING
    },
    customerId: {
      type: Sequelize.INTEGER,
      defaultValue: null
    }
  });

  return Subscriber;
};
