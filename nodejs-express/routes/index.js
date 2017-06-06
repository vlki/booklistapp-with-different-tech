var express = require('express');
var bookController = require('../controllers/bookController');
var router = express.Router();

router.get('/', bookController.index);
router.post('/create-book', bookController.create);
router.get('/delete-book/:id', bookController.delete);

module.exports = router;
