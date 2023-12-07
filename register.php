<?php

// Function to check if username exists
function usernameExists($username, $users) {
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            return true;
        }
    }
    return false;
}

// Read data from CSV file
$users = array_map('str_getcsv', file('users.csv'));

// Validate user input
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);

$errors = [];

if (empty($username)) {
    $errors[] = "Username is required.";
} else if (strlen($username) < 4) {
    $errors[] = "Username must be at least 4 characters long.";
} else if (usernameExists($username, $users)) {
    $errors[] = "Username already exists.";
}

if (empty($email)) {
    $errors[] = "Email is required.";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

if (empty($password)) {
    $errors[] = "Password is required.";
} else if (strlen($password) < 8) {
    $errors[] = "Password must be at least 8 characters long.";
}

// If no errors, register user and write to CSV file
if (empty($errors)) {
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $hashed_password = $password;
    $new_user = array($username, $email, $hashed_password);
    $users[] = $new_user;

    file_put_contents('users.csv', implode("\n", array_map('implode', $users)));

    header('Location: success.html');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Error</title>
</head>
<body>
    <h1>Registration Error</h1>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="index.html">Try again</a>
</body>
</html>
