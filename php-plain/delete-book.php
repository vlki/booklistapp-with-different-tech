<?php

include 'common.php';

// Check if the request is HTTP GET
if (!isset($_GET)) {
  // If not, show 400 Bad Request error
  http_response_code(400);
  echo "Only GET methods are allowed to delete-book.php script";
  exit;
}

// Check if the GET query contains "id" parameter which defines the book
// to be deleted
$bookId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
if ($bookId === null) {
  // If not, show 400 Bad Request error
  http_response_code(400);
  echo "Query parameters must contain parameter \"id\" with the ID of book to be deleted";
  exit;
}

// Lets connect to database
try {
  $pdo = new PDO('sqlite:' . $dbPath);

  // Make sure that exception is throw for any error
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (RuntimeException $e) {
  // If something goes wrong, respond with HTTP code 500 and show what
  // happenned
  http_response_code(500);
  echo "Error when coonecting to database: " . $e->getMessage() . "<br>";
  exit;
}

// And check if there is book with such ID
try {
  // Lets prepare the query, bind the values to be safe against SQL injection,
  // and execute it!
  $stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
  $stmt->execute(array(':id' => $bookId));

  // Check if there is such a book
  $book = $stmt->fetch();
  if ($book === false) {
    http_response_code(400);
    echo "There is no book with passed ID " . htmlspecialchars($bookId);
    exit;
  }

  // Making sure we remove references to PDO connection
  $stmt = null;
} catch (RuntimeException $e) {
  // If something goes wrong, respond with HTTP code 500 and show what
  // happenned
  http_response_code(500);
  echo "Error when checking if a book exists in database: " . $e->getMessage() . "<br>";
  exit;
}

try {
  // Lets prepare the query, bind the values to be safe against SQL injection,
  // and execute it!
  $stmt = $pdo->prepare('DELETE FROM books WHERE id = :id');
  $stmt->execute(array(':id' => $bookId));

  // Making sure we remove references to PDO connection
  $stmt = null;
} catch (RuntimeException $e) {
  // If something goes wrong, respond with HTTP code 500 and show what
  // happenned
  http_response_code(500);
  echo "Error when deleting a book from database: " . $e->getMessage() . "<br>";
  exit;
}

// Making sure we remove references to PDO connection
$pdo = null;

// Redirect to the list of books now
header('Location: /');
exit;
