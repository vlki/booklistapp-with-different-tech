var path = require('path');
var util = require('util');
var sqlite3 = require('sqlite3').verbose();

// Using path.join so it works on Unix as well as Windows systems which
// have different characters as directory delimiters
var dbPath = path.join(__dirname, '..', '..', 'db.sqlite');

function connectToDb(callback) {
  return new sqlite3.Database(dbPath, sqlite3.OPEN_READWRITE | sqlite3.OPEN_CREATE, callback);
}

// Displays list of books with actions to delete each and input for
// adding new book
exports.index = function (req, res) {
  var db = connectToDb(function(err) {
    if (err !== null) {
      // Return 500 if we fail to connect
      res.status(500).send('Failed to connect to database, error: ' + util.inspect(err));
      return;
    }

    db.all('SELECT * FROM books', function(err, books) {
      if (err !== null) {
        // Return 500 if we fail to get books
        res.status(500).send('Failed to fetch books from database, error: ' + util.inspect(err));
        return;
      }

      db.close(function() {
        res.render('book/index', { books });
      });
    });
  });
};

// Creates new book in database on POST request
exports.create = function (req, res) {
  req.checkBody('title').notEmpty().isLength({ min: 1, max: 255 });

  req.getValidationResult().then(function(validationResult) {
    if (!validationResult.isEmpty()) {
      res.status(400).send('There have been validation errors: ' + util.inspect(validationResult.array()));
      return;
    }

    var title = req.body.title;

    var db = connectToDb(function(err) {
      if (err !== null) {
        // Return 500 if we fail to connect
        res.status(500).send('Failed to connect to database, error: ' + util.inspect(err));
        return;
      }

      db.run('INSERT INTO books (title) VALUES ($title)', { $title: title }, function(err) {
        if (err !== null) {
          // Return 500 if we fail to add book to db
          res.status(500).send('Failed to add book to db, error: ' + util.inspect(err));
          return;
        }

        db.close(function() {
          // Redirect to list of books
          res.redirect('/');
        });
      });
    });

  });
};

// Deletes book specified by ID in URL from database on GET request
exports.delete = function (req, res) {
  req.checkParams('id').notEmpty().isInt();

  req.getValidationResult().then(function(validationResult) {
    if (!validationResult.isEmpty()) {
      res.status(400).send('There have been validation errors: ' + util.inspect(validationResult.array()));
      return;
    }

    var bookId = req.params.id;

    var db = connectToDb(function(err) {
      if (err !== null) {
        // Return 500 if we fail to connect
        res.status(500).send('Failed to connect to database, error: ' + util.inspect(err));
        return;
      }

      db.get('SELECT * FROM books WHERE id = $id', { $id: bookId }, function(err, book) {
        if (err !== null) {
          // Return 500 if we fail to fetch book from db
          res.status(500).send('Failed to fetch book from db, error: ' + util.inspect(err));
          return;
        }

        if (book === undefined) {
          // Return 400 if we there is no book with such ID
          res.status(400).send('There is no book with passed ID');
          return;
        }

        db.run('DELETE FROM books WHERE id = $id', { $id: bookId }, function(err) {
          if (err !== null) {
            // Return 500 if we fail to delete book from db
            res.status(500).send('Failed to delete book from db, error: ' + util.inspect(err));
            return;
          }

          db.close(function() {
            // Redirect to list of books
            res.redirect('/');
          });
        });
      });
    });
  });
};
