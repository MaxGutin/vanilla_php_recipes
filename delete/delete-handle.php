<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/authentication/assets/db-handle.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/authentication/assets/secure.php";
try {
    // delete post
    $sth = $dbh->prepare(SQL_DELETE_POST);
    $sth->bindParam(':id', $_REQUEST['id']);
    $sth->execute();
    header("Location: /read/posts?message=post_deleted");
} catch (PDOException $e) {
    echo '== PDO EXCEPTION (tasks.php): == <pre>' . $e->getMessage() . '</pre>';
}