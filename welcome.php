<?php

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <p>You are now logged in.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
