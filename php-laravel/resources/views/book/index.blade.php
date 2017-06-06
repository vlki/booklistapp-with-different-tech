<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Booklistapp in PHP and Laravel</title>
  </head>
  <body>
    <h1>Books</h1>

    <ul>
      @foreach ($books as $book)
        <li>
          {{ $book['title'] }}
          {{ link_to_action('BookController@delete', 'delete', ['id' => $book['id']]) }}
        </li>
      @endforeach
    </ul>

    <form action="{{ action('BookController@create') }}" method="POST">
      <input type="text" name="title">
      <input type="submit" value="Add">

      {{-- Laravel comes with CSRF security out of the box, lets use it --}}
      {{ csrf_field() }}
    </form>
  </body>
</html>
