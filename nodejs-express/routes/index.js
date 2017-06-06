var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
  var books = [
    { id: 1, title: 'Slaughterhouse Five by Kurt Vonnegut' }
  ];

  res.render('index', { books });
});

module.exports = router;
