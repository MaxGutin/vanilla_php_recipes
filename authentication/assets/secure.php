<?php
/* This file contains:
 * Session and Cookies authentication,  Activate account check.
 */

session_start();

// Session and Cookies authentication - - - - - - - - - - - - - - - - - - - - -

// if session is empty
if (empty($_SESSION['user']['login']) OR $_SESSION['user']['login'] == null) {

    // if cookie is empty
    if (empty($_COOKIE['login']) OR empty($_COOKIE['token'])) {
        header('Location: index?message=empty_cookie');
    } else {

        // Make session
        try {
            $sth = $dbh->prepare(SQL_MAKE_SESSION);
            $sth->bindParam(':login', $_COOKIE['login']);
            $sth->bindParam(':token', $_COOKIE['token']);
            $result = $sth->execute();
            $user_count = $sth->rowCount();

            if ($user_count > 0) {
                $user = $sth->fetch(PDO::FETCH_ASSOC);
                $_SESSION['user'] = $user;  // Make session
            } else {
                // When cookies not find in DB
                header('Location: logout?message=wrong_cookie');
            }
        } catch (PDOException $e) {
            echo '= PDO EXCEPTION: =' . $e->getMessage();
        }
    }
    /* todo Проверку соответствия токена на девайсе с токеном в БД. Для работы с разных девайсов.
     * Наверно нужна ещё одна таблица для хранения токенов с привязкой к учётке.
     * */
} // End Session and Cookies authentication - - - - - - - - - - - - - - - - - -

// Activate account check
if ($_SESSION['user']['active'] == 0) {?>
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <h1>Please activate your account</h1>
            <p><a href="/assets/code_sender.php">Resend e-mail confirmation.</a></p>
        </div>
    </div>
    <?php
    exit;
}