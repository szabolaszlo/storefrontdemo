const jwt = require("jsonwebtoken");
const fs = require('fs');
const config = process.env;

const verifyToken = (req, res, next) => {
    var tokenArray = req.headers.authorization.split(" ");
    const token = tokenArray[1];

    if (!token) {
        return res.status(403).send("A token is required for authentication");
    }

    try {
        cert = fs.readFileSync(__dirname + '/../../keys/public.pem')
        const decoded = jwt.verify(token, cert);
        req.user = decoded;
    } catch (err) {
        return res.status(401).send("Invalid Token");
    }
    return next();
};

module.exports = verifyToken;