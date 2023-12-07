<?php

// Replace this with the path to your JSON file
$books_json_path = "books.json";

// Read the JSON file
$books_json = file_get_contents($books_json_path);

// Decode the JSON data into an array
$books = json_decode($books_json, true);

// Check if the 'isbn' parameter is set in the URL
if (isset($_GET['isbn'])) {
    // Retrieve the ISBN from the URL
    $requested_isbn = $_GET['isbn'];

    // Search for the book with the matching ISBN
    $selected_book = null;
    foreach ($books["books"] as $book) {
        if ($book["isbn"] === $requested_isbn) {
            $selected_book = $book;
            break;
        }
    }

    // Display book details
    if ($selected_book !== null) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $selected_book["title"]; ?></title>
        </head>
        <body>
            <h1><?php echo $selected_book["title"]; ?></h1>
            <p>Author: <?php echo $selected_book["author"]; ?></p>
            <p>Genre: <?php echo "Action, Adventure"; ?></p>
            <p>Publication Year: <?php echo "year: 1989 " ?></p>
            <p>Description: <?php echo $selected_book["description"]; ?></p>
            <p>ISBN: <?php echo $selected_book["isbn"]; ?></p>
        </body>
        </html>
        <?php
    } else {
        // Display a message if the book is not found
        echo "Book not found.";
    }
} else {
    // Display a message if 'isbn' parameter is not set
    echo "ISBN parameter not provided.";
}

?>
