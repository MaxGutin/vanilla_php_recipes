<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sing Up</title>
</head>
<body>
<form action="assets/singup-handle.php" method="post">
    <p>
        <input type="text" id="name" name="name" required>
        <label for="name">Name</label>
    </p>
    <p>
        <input type="text" id="login" name="login" required>
        <label for="login">Login</label>
    </p>
    <p>
        <input type="email" id="email" name="email" required>
        <label for="email">E-mail</label>
    </p>
    <p>
        <input type="password" id="password" name="password" required>
        <label for="password">Password</label>
    </p>
    <p>
        <input type="password" id="password_confirm" name="password_confirm" required>
        <label for="password_confirm">Password confirm</label>
    </p>
    <p class="mdl-cell mdl-cell--12-col">
        <button type="submit">Sing Up</button>
        <button type="reset">Clean</button>
        <a href="index.php">Cancel</a>
    </p>
</form>
</body>
</html>