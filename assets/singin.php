<?php
/*
 * Requested data:
 *      login, password
 * Loaded data:
 *      id, login, password, role, full_name, login, email, password, verify_code
 * Constants:
 *      SQL_LOGIN, SQL_NEW_TOKEN
 * Features:
 *      Validation, Make Session and Cookie, Redirect.
 */

session_start();
require_once 'dbh.php';
require_once 'validate.php';

$form_data = array(
    'login' => $_POST['login'],
    'password' => $_POST['password']
);
// Validation
$form_data = clean($form_data); // clean() is locate in validate.php
// Login
try {
    $sth = $dbh->prepare(SQL_LOGIN);                // prepare — preparation SQL-request to perform.
    $sth->bindParam(':login', $form_data['login']); // bindParam — associate SQL-request and variable.
    $result = $sth->execute();                      // execute — perform prepare request.
    $user_count = $sth->rowCount();                 // rowCount() - returns the number of rows.

    // Check
    if ($user_count > 0) {                      // if count of found rows more than zero,
        $user = $sth->fetch(PDO::FETCH_ASSOC); // extract data,

        if (password_verify($form_data['password'], $user['password'])) { // and check password.

            // Cookie - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            require_once 'assets/make-session.php';

            header('Location: ./user.php'); // and redirect to task list page.

        } else echo "Wrong login or password."; // Wrong password or the user foes not need know about it

    } else echo "Wrong login or password."; // Wrong login or the user foes not need know about it

} catch (PDOException $e) {
    echo '= PDO EXCEPTION: =' . $e->getMessage();
} catch (Exception $e) {
    echo '= EXCEPTION: =' . $e->getMessage(); // for random_bytes()
}