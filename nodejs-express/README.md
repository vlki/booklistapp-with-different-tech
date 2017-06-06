# Booklistapp in Node.js and Express

## Run

First you have to fetch all needed dependencies using NPM:

```bash
$ npm install
```

After that, you should be able to start the script which binds to port 8000:

```bash
$ npm start
```

## Requirements

* Node.js 8.0.0 or higher
* NPM 5.0.1 or higher

## Relevant files

* `controllers/bookController.js` - All the logic of request processing is
  there. Also connecting and fetching of database.
* `views/book/index.ejs` - EJS (Embedded JS) template used to generate HTML
  of books list.
* `routes/index.js` - Mapping actual URLs and HTTP methods to controller
  functions.
