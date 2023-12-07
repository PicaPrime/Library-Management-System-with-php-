<?php
// Define variables to store form data

$title = $description = $isbn = '';

// Define an array to store validation errors
$errors = array();

// Function to sanitize and validate form data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data and sanitize
    $title = sanitizeInput($_POST['title']);
    $description = sanitizeInput($_POST['description']);
    $isbn = sanitizeInput($_POST['isbn']);

    // Basic validation
    if (empty($title)) {
        $errors['title'] = 'Title is required';
    }

    if (empty($description)) {
        $errors['description'] = 'Description is required';
    }

    if (empty($isbn)) {
        $errors['isbn'] = 'ISBN is required';
    }

    // If there are no validation errors, store the data in a text file
    if (empty($errors)) {
        $bookData = "Title: $title\nDescription: $description\nISBN: $isbn\n\n";
        // Change the file path based on your server configuration
        $filePath = 'books.txt';

        // Open the file in append mode
        $file = fopen($filePath, 'a');

        // Write the data to the file
        fwrite($file, $bookData);

        // Close the file
        fclose($file);

        // Optionally, you can redirect the user to a success page
        header('Location: submit.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Books</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }

        span.error {
            color: red;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>

</head>

<body>

<nav class="container navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">
          Library Management
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="list.php">All books</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="forms/admin.html">Admin</a>
            </li>
          </ul>
        </div>
      </nav>



    <div class="container">
        <h1 class="text-center">Welcome back, Admin</h1>
        <h2 class="text-center">Add Books to the Library</h2>

        <br>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>">
                <span class="error"><?php echo isset($errors['title']) ? $errors['title'] : ''; ?></span>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" class="form-control"><?php echo htmlspecialchars($description); ?></textarea>
                <span class="error"><?php echo isset($errors['description']) ? $errors['description'] : ''; ?></span>
            </div>

            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN:</label>
                <input type="text" name="isbn" class="form-control" value="<?php echo htmlspecialchars($isbn); ?>">
                <span class="error"><?php echo isset($errors['isbn']) ? $errors['isbn'] : ''; ?></span>
            </div>

            <input type="submit" value="Submit" class="btn btn-primary">
            <a href="index.html"><button type="button" class="btn btn-primary">logout</button></a>
        </form>

    </div>
</body>

</html>
