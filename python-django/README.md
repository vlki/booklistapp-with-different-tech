# Booklistapp in PHP and Django

## Run it

If you haven't already, reset the SQLite database by copying the default
database file over the one which is used by the app:

```bash
# In directory /python-django
$ cp ../db.default.sqlite ../db.sqlite
```

Then run the development server responding at port 8000 by running:

```bash
# In directory /python-django
$ python manage.py runserver
```

## Requirements

* Python 2.7.13 or higher (but not 3.*.*)

## Relevant files

* `booklistapp/settings.py` - Where path to database is specified
* `books/urls.py` - Where all the URLs where app responds are defined
* `books/views.py` - Where the logic of handling requests is
* `books/forms.py` - Where form for creating new book is defined
* `books/models.py` - Where Book model is defined and how it is
  represented in database
* `books/templates/books/index.html` - Template which is used to display
  list of books in HTML
