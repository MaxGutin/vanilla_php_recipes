<?php
// Cookie - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// make token
$token = md5(random_bytes(20));
// Addition new user's token to DB
$sth = $dbh->prepare(SQL_NEW_TOKEN);
$sth->bindParam(':login', $user['login']);
$sth->bindParam(':token', $token);
$sth->execute();

// make cookie
setcookie('login', $user['login'], time()+60*60*24*7); // time to leave login - 7 days
setcookie('token', $token, time()+60*60*24*7); // time to live token - 7 days
// Cookie end - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Make session
$_SESSION['user'] = $user;              // If all right, create session with user data,
