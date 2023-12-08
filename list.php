<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 60px; /* Adjusted for the fixed navbar */
        }

        .book-container {
            border: 1px solid #dee2e6;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .book-container a {
            text-decoration: none;
            color: #212529;
        }

        .book-container h2 {
            margin-bottom: 10px;
        }

        .book-details {
            margin-bottom: 10px;
        }

        .book-cover {
            max-width: 100%;
            height: auto;
            display: block;
            margin-top: 10px;
        }

        h2{
            color: blue;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="padding-top:20px">
        <div class="container">
            <a class="navbar-brand" href="#">Library Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="forms/login.html">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="forms/register.html">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="forms/admin.php">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php
        // Read the JSON file
        $jsonData = file_get_contents('books.json');

        // Decode JSON data
        $booksData = json_decode($jsonData, true);

        // Check if decoding was successful
        if ($booksData === null) {
            echo "Error decoding JSON data.";
        } else {
            // Iterate through each book
            foreach ($booksData['books'] as $book) {
        ?>
                <div class="book-container">
                    <a href="display.php?isbn=<?php echo $book["isbn"]; ?>">
                        <h2><?php echo $book['title']; ?></h2>
                    </a>
                    <div class="book-details">
                        <p><strong>Author:</strong> <?php echo $book['author']; ?></p>
                        <p><strong>ISBN:</strong> <?php echo $book['isbn']; ?></p>
                        <p><strong>Language:</strong> <?php echo $book['language']; ?></p>
                        <p><strong>Pages:</strong> <?php echo $book['pages']; ?></p>
                    </div>
                    <img class="book-cover" src="<?php echo $book['cover_image_url']; ?>" alt="Book Cover">
                </div>
        <?php
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-ZJ35wos5PGuxuJZc4ZHAHGByA1YzqkMq6PW75t9R1Qtxh6C0iU6jg5Zf4PDJBJI" crossorigin="anonymous"></script>
</body>

</html>
