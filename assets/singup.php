<?php
/* Requested data:
 *      name, login, email, password, password_confirm
 * Loaded data:
 *      login, email
 * Constants:
 *      SQL_LOGIN, SQL_EMAIL, SQL_INSET_USER
 * Features:
 *      Redirect if session is active, Validation,
 *      Checking an existing login and e-mail,
 *      Password hashing, Verification code generation,
 *      Addition new user data to DB, Session initialize,
 *      Redirect to script of send verification code to user's e-mail
 */

session_start();
require_once 'dbh.php';
require_once 'validate.php';

$user = [
    'name' => $_POST['name'],
    'login' => $_POST['login'],
    'email' => $_POST['email'],
    'password' => $_POST['password']
];

// Validation  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Checking for empty values
if(empty($user['name']) OR empty($user['login'])
    OR empty($user['email']) OR empty($user['password'])) {
    exit('Please fill in all fields.');
}

// Checking that the entered password and password confirm are match
if ($user['password'] !== $_POST['password_confirm']) exit('Password and password confirm are not match.');

$user = clean($user); // clean() locate in validate.php

// E-mail validation
$email_validate = filter_var($user['email'], FILTER_VALIDATE_EMAIL);

// Data length check
if (!check_length($user['name'], 2, 255)) {
    exit('Name long must be between 2 and 255 characters.');
}
if (!check_length($user['login'], 2, 64)) {
    exit('Login long must be between 2 and 64 characters.');
}
if (!check_length($user['password'], 2, 64)) {
    exit('Password long must be between 2 and 255 characters.');
}
if (!$email_validate) {
    exit('Enter correct e-mail.');
}
// End Validation - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

try {
    // Checking an existing login
    $sth = $dbh->prepare(SQL_LOGIN);
    $sth->bindParam(':login', $user['login']);
    $sth->execute();
    $user_count = $sth->rowCount();
    if ($user_count > 0 ) {
        exit('Login already exists!');
    }

    // Checking an existing e-mail
    $sth = $dbh->prepare(SQL_EMAIL);
    $sth->bindParam(':email', $user['email']);
    $sth->execute();
    $user_count = $sth->rowCount();
    if ($user_count > 0 ) {
        exit('E-mail already exists.');
    }

    // Password hashing
    try {
        $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
    } catch (Exception $e) {
        echo 'HASHING ERROR: ' . $e->getMessage();
    }

    // Verification code generation
    $user['verify_code'] = md5(random_bytes(20));

    // Addition new user to DB
    $sth = $dbh->prepare(SQL_INSERT_USER);
    $sth->execute(array_values($user));

    // Cookie - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    require_once 'make-session.php';

    // Send verification code to user's e-mail
    header('Location: code_sender.php');
    
    
} catch (PDOException $e) {
    echo '= PDO EXCEPTION: =' . $e->getMessage();
} catch (Exception $e) {
    echo '= EXCEPTION: =' . $e->getMessage(); // for random_bytes()
}