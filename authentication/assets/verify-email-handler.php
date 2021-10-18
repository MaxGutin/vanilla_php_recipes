<?php
// проверка наличия кода в ссылке
// сравнение ссылки с БД
// смена значения активации аккаунта
// авторизация
// перенаправление на профиль
session_start();
require_once 'db-handle.php';
if ($_REQUEST) {
    $verify_code = array_key_first($_REQUEST);

    // search verify_code in DB
    try {
        $sth = $dbh->prepare(SQL_VERIFY_CODE);
        $sth->bindParam(':verify_code', $verify_code);
        $sth->execute();
        $user_count = $sth->rowCount();

        // check the code
        if ($user_count > 0) {
            $user = $sth->fetch(PDO::FETCH_ASSOC);

            // change account status
            $active = 1;
            $sth = $dbh->prepare(SQL_ACTIVATE_USER);
            $sth->bindParam(':active', $active);
            $sth->bindParam(':login', $user['login']);
            $sth->execute();

            // start session
            $_SESSION['user'] = $user;
            header('Location: /user?message=verify_success');
        } else echo "Не правильный код активации аккаунта.";
    } catch (PDOException $e) {
        echo '==== PDO Exception =====: ' . $e->getMessage();
    }
} else header('Location: /index.php?message=verify_error');
