<?php

// Replace this with the path to your JSON file
$books_json_path = "books.json";

// Read the JSON file
$books_json = file_get_contents($books_json_path);

// Decode the JSON data into an array
$books = json_decode($books_json, true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Books</title>
</head>
<body>
  <h1>Book Catalog</h1>
  <ul>
    <?php foreach ($books["books"] as $book) : ?>
      <li>
        <a href="display.php?isbn=<?php echo $book["isbn"]; ?>">
          <?php echo $book["title"]; ?>
        </a> (ISBN: <?php echo $book["isbn"]; ?>)
      </li>
    <?php endforeach; ?>
  </ul>
</body>
</html>
