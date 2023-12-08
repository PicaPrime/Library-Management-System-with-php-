<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        } */

        .login-container {
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate input (you may want to add more validation)
    if (empty($username) || empty($password)) {
        echo '<div class="alert alert-danger" role="alert">Please enter both username and password.</div>';
    } else {
        // Check if the username and password match the records in admins.csv
        $admins = array_map('str_getcsv', file('../storage/admins.csv'));
        foreach ($admins as $admin) {
            if ($admin[0] == $username && $admin[1] == $password) {
                $_SESSION['username'] = $username;
                header("Location: ../submit.php");
                exit();
            }
        }

        // If no match is found
        echo '<div class="alert alert-danger" role="alert">Invalid username or password.</div>';
    }
}
?>

<br>
<br>
<div class="login-container container">
    <h2 class="mb-4">Admin Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap JavaScript components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-ZJ35wos5PGuxuJZc4ZHAHGByA1YzqkMq6PW75t9R1Qtxh6C0iU6jg5Zf4PDJBJI" crossorigin="anonymous"></script>

</body>
</html>
