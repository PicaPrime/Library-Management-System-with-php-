<?php

// Function to check if user credentials are valid
function validateUser($username, $password, $users) {
    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            return true;
        }
    }
    return false;
}

// Read data from CSV file
$users = array_map('str_getcsv', file('users.csv'));

// Get user input
$username = trim($_POST['username']);
$password = trim($_POST['password']);

// Validate user credentials
if (validateUser($username, $password, $users)) {
    // User is logged in
    session_start();
    $_SESSION['username'] = $username;
    header('Location: welcome.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Error</title>
</head>
<body>
    <h1>Login Error</h1>
    <p>Invalid username or password.</p>
    <a href="login.html">Try again</a>
</body>
</html>
