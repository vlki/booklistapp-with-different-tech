<?php

include 'common.php';

try {
  $pdo = new PDO('sqlite:' . $dbPath);

  // Make sure that exception is throw for any error
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Lets fetch all the books to array of arrays
  $stmt = $pdo->query('SELECT * FROM books');
  $books = $stmt->fetchAll();

  // Making sure we remove references to PDO connection
  $stmt = null;
  $pdo = null;
} catch (PDOException $e) {
  // If something goes wrong, respond with HTTP code 500 and show what
  // happenned
  http_response_code(500);
  echo "Error when connecting to database: " . $e->getMessage() . "<br>";
  exit;
}

?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Booklistapp in plain PHP</title>
  </head>
  <body>
    <h1>Books</h1>
    <ul>
      <?php foreach($books as $book) { ?>
        <li>
          <?php echo htmlspecialchars($book['title']) ?>
          <a href="delete-book.php?id=<?php echo htmlspecialchars($book['id']) ?>">delete</a>
        </li>
      <?php } // foreach ?>
    </ul>
    <form action="add-book.php" method="POST">
      <input type="text" name="title">
      <input type="submit" value="Add">
    </form>
  </body>
</html>
