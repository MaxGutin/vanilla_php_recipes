<?php
function logout()
{
    $_SESSION = array();
    unset($_SESSION[session_name()]);
    session_destroy();
    unset($_COOKIE['login']);
    unset($_COOKIE['token']);
    setcookie('login', '', time()-3600);
    setcookie('token', '', time()-3600);
    header('Location: index.php');
}
logout();
