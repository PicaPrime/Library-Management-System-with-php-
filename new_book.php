<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
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

      <br>
    <h2 class="container">New Book Added to books.txt</h2>
    <h2 class="container">Book List</h2>
    <br>

    <?php
        // Read data from the books.txt file
        $filename = 'books.txt';
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Display the data in a table
        if ($lines !== false) {
            echo '<table class="container">';
            echo '<tr><th>Title</th><th>Description</th><th>ISBN</th></tr>';
            
            foreach ($lines as $line) {
                if (strpos($line, 'Title:') === 0) {
                    $title = trim(substr($line, 7));
                } elseif (strpos($line, 'Description:') === 0) {
                    $description = trim(substr($line, 13));
                } elseif (strpos($line, 'ISBN:') === 0) {
                    $isbn = trim(substr($line, 5));

                    // Display each book's information in a table row
                    echo '<tr>';
                    echo '<td>' . $title . '</td>';
                    echo '<td>' . $description . '</td>';
                    echo '<td>' . $isbn . '</td>';
                    echo '</tr>';
                }
            }

            echo '</table>';
        } else {
            echo '<p>Error reading the file.</p>';
        }
    ?>
    <br>
    <a href="submit.php" class="container justify-content-center" style="padding-left: 5%;">
      <button type="button" class="btn btn-primary btn-lg container">Return to Admin Dashboard</button></a>

</body>
</html>
