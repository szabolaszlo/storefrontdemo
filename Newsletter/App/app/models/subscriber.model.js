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
    customer: {
      type: Sequelize.BOOLEAN,
      defaultValue: 0
    }
  });

  return Subscriber;
};
