<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/authentication/assets/db-handle.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/authentication/assets/secure.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/authentication/assets/validate.php";

$form_data = array(
    'header' => $_POST['header'],
    'content' => $_POST['content']
);

// Validation
$form_data = clean($form_data); // clean() locate in validate.php

// Add task to DB
try {
    $sth = $dbh->prepare(SQL_INSERT_POST);
    $sth->bindParam(':user', $_SESSION['user']['id']);
    $sth->bindParam(':header', $form_data['header']);
    $sth->bindParam(':content', $form_data['content']);
    $sth->execute();
    header("Location: /create/add?message=post_added");
} catch (PDOException $e) {
    echo '== PDO EXCEPTION (create-handle.php): == <pre>' . $e->getMessage() . '</pre>';
}