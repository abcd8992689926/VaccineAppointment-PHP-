const express = require('express');
const app = express(); 
const path = require('path');
var port = process.env.PORT || 3000;

app.use(express.static(path.join(__dirname, '')));
app.get('/', function (req, res) { 
    res.sendfile(__dirname + '/index.html'); 
});

app.listen(port, function() {
	console.log("Listening on Port 3000");
});