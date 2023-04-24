const express = require("express");
const cors = require("cors");
const mysql = require('mysql2');

const app = express();

const dbConfig = require("./app/config/db.config.js");

// parse requests of content-type - application/json
app.use(express.json());

// parse requests of content-type - application/x-www-form-urlencoded
app.use(express.urlencoded({ extended: true }));

const db = require("./app/models");

var con = mysql.createConnection({
    host     : dbConfig.HOST,
    user     : dbConfig.USER,
    password : dbConfig.PASSWORD
})

con.connect(function(err) {
    if (err) throw err;

    con.query('CREATE DATABASE IF NOT EXISTS customers;', function (err, result) {
        if (err) throw err;

        db.sequelize.sync()
            .then(() => {
                console.log("Synced db.");
            })
            .catch((err) => {
                console.log("Failed to sync db: " + err.message);
            });
    });
});


// // drop the table if it already exists
// db.sequelize.sync({ force: true }).then(() => {
//   console.log("Drop and re-sync db.");
// });


require("./app/routes/customer.routes")(app);

// set port, listen for requests
const PORT = process.env.PORT || 8081;
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}.`);
});
