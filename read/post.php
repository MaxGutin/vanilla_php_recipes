<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/authentication/assets/db-handle.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/authentication/assets/secure.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/authentication/assets/debug.php";

try {
    $sth = $dbh->prepare(SQL_GET_POST);
    $sth->bindParam(':id', $_REQUEST['id']);
    $sth->bindParam(':user', $_SESSION['user']['id']);
    $sth->execute();
    $posts_count = $sth->rowCount();
    if (empty($posts_count) OR $posts_count < 0) {
        header("Location: /read/posts.php?message=404");
//        exit('404 not found!');
    }
    $post = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '== PDO EXCEPTION (task.php) ==: <pre>' . $e->getMessage() . '</pre>';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
foreach ($post as $key => $value) { ?>
    <p><b><?= $key ?>: </b><?= $value ?></p>
<?php
}
?>
</body>
</html>