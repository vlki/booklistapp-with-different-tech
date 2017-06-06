# Booklistapp in plain PHP

## Run it

If you haven't already, reset the SQLite database by copying the default
database file over the one which is used by the app:

```bash
# from /php-plain directory
$ cp ../db.default.sqlite ../db.sqlite
```

Then you can use built-in PHP development server to run the app:

```bash
$ php -S localhost:8000
```

Now open the app in browser at: [http://localhost:8000/](http://localhost:8000/)

Since it is plain PHP, you don't need to download any dependencies before
running it.

## Requirements

* PHP 7.0 or higher
