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
            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <style>
                body {
                    padding: 20px;
                }

                h1 {
                    color: #007bff;
                }

                p {
                    margin-bottom: 10px;
                }

                img {
                    max-width: 100%;
                    height: auto;
                    margin-top: 10px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1><?php echo $selected_book["title"]; ?></h1>
                <p>Author: <?php echo $selected_book["author"]; ?></p>
                <p><strong>Genre:</strong> <?php echo implode(', ', $selected_book['genre']); ?></p>
                <p><strong>Description:</strong> <?php echo $selected_book['description']; ?></p>
                <p><strong>Publication Date:</strong> <?php echo $selected_book['publication_date']; ?></p>
                <p>ISBN: <?php echo $selected_book["isbn"]; ?></p>
                <p><strong>Language:</strong> <?php echo $selected_book['language']; ?></p>
                <p><strong>Pages:</strong> <?php echo $selected_book['pages']; ?></p>
                <img src="<?php echo $selected_book['cover_image_url']; ?>" alt="Book Cover">
            </div>
            
            <!-- Bootstrap JS and Popper.js (required for Bootstrap JavaScript components) -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-ZJ35wos5PGuxuJZc4ZHAHGByA1YzqkMq6PW75t9R1Qtxh6C0iU6jg5Zf4PDJBJI" crossorigin="anonymous"></script>
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
