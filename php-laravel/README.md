# Booklistapp in PHP and Laravel

## Run

If you haven't already, reset the SQLite database by copying the default
database file over the one which is used by the app:

```bash
# from /php-laravel directory
$ cp ../db.default.sqlite ../db.sqlite
```

Continue by downloading all dependencies via Composer:

```bash
$ composer install
```

And then run the PHP built-in development server by the recommended
command

```bash
$ php artisan serve
```

Now open the app in browser at: [http://localhost:8000/](http://localhost:8000/)

## Requirements

* PHP 7.0 or higher
* Composer

## Relevant files

* `config/database.php` - Configuration of the connection to our Sqlite
  database.
* `routes/web.php` - Maps the HTTP requests to controller actions
* `app/Book.php` - Defines the Book model, active record, which we are using
  for all database queries
* `app/Http/Controllers/BookController` - Logic executed for requests. Defines
  which view gets rendered or where we should redirect.
* `resources/views/book/index.blade.php` - Template which renders the HTML for
  list of books
