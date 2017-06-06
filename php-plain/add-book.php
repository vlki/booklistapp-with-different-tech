<?php

include 'common.php';

// Check if the request is HTTP POST
if (!isset($_POST)) {
  // If not, show 400 Bad Request error
  http_response_code(400);
  echo "Only POST methods are allowed to add-book.php script";
  exit;
}

// Check if the POST form data contain "title" param with the title
// of book which is about to be added
if (!isset($_POST['title']) || !is_string($_POST['title']) || empty($_POST['title'])) {
  // If not, show 400 Bad Request error
  http_response_code(400);
  echo "Form data of the POST request must contain non-empty \"title\" parameter";
  exit;
}

// This is the title of new book we are adding
$title = $_POST['title'];

try {
  $pdo = new PDO('sqlite:' . $dbPath);

  // Make sure that exception is throw for any error
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Lets prepare the query, bind the values to be safe against SQL injection,
  // and execute it!
  $stmt = $pdo->prepare('INSERT INTO books (title) VALUES (:title)');
  $stmt->execute(array(':title' => $title));

  // Making sure we remove references to PDO connection
  $stmt = null;
  $pdo = null;
} catch (RuntimeException $e) {
  // If something goes wrong, respond with HTTP code 500 and show what
  // happenned
  http_response_code(500);
  echo "Error when adding a book to database: " . $e->getMessage() . "<br>";
  exit;
}

// Redirect to the list of books now
header('Location: /');
exit;
