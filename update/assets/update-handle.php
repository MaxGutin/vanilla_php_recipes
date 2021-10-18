<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/authentication/assets/db-handle.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/authentication/assets/secure.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/authentication/assets/validate.php";
$form_data = array(
    'header' => $_POST['header'],
    'content' => $_POST['content'],
    'id' => $_POST['id'],
);

// Validation
$form_data = clean($form_data); // clean() locate in validate.php

// update DB
try {
    $sth = $dbh->prepare(SQL_UPDATE_POST);
    $sth->bindParam(':header', $form_data['header']);
    $sth->bindParam(':content', $form_data['content']);
    $sth->bindParam(':id', $_REQUEST['id']);
    $sth->execute();
    header("Location: /read/posts?message=post_updated");
} catch (PDOException $e) {
    echo '== PDO EXCEPTION (update-handle.php): == <pre>' . $e->getMessage() . '</pre>';
}