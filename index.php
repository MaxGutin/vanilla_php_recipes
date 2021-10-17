<?php
// Redirect if session is active
if (isset($_SESSION['user']['login']) OR isset($_COOKIE['login'])) {
    header('Location: user.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
</head>
<body>
<form action="assets/singin.php" method="post">
    <p>
        <input type="text" id="login" name="login" autofocus>
        <label for="login">login</label>
    </p>
    <p>
        <input type="password" id="password" name="password">
        <label for="password">password</label>
    </p>
    <p>
        <button type="submit">LOG IN</button>
        <a href="singup.php">SING UP</a>
    </p>
    <a href="password_reset.php">Password recovery</a>
</form>
</body>
</html>