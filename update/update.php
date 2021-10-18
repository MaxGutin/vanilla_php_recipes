<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/authentication/assets/db-handle.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/authentication/assets/secure.php";
try {
    $sth = $dbh->prepare(SQL_GET_POST);
    $sth->bindParam(':id', $_REQUEST['id']);
    $sth->bindParam(':user', $_SESSION['user']['id']);
    $sth->execute();
    $task_count = $sth->rowCount();
    if ($task_count > 0) {
        $post = $sth->fetch(PDO::FETCH_ASSOC);
    } else {
        exit('Access denied!');
    }

} catch (PDOException $e) {
    echo '== PDO EXCEPTION (update.php) == : <pre>' . $e->getMessage() . '</pre>';
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
<form action="assets/update-handle.php?id=<?= $post['id'] ?>" method="post">
    <p><label>id :              <?= $post['id'] ?></label></p>
    <p><label>category_id : <input type="text" name="category_id" value="<?= $post['category_id'] ?>"></label></p>
    <p><label>user :            <?= $post['user'] ?></label></p>
    <p><label>header :      <input type="text" name="header" value="<?= $post['header'] ?>"></label></p>
    <p><label>content :     <textarea name="content" id="content" cols="30" rows="10"><?= $post['content'] ?></textarea></label></p>
    <p><label>created_at :  <input type="text" name="created_at" value="<?= $post['created_at'] ?>"></label></p>
    <p><label>updated_at :  <input type="text" name="updated_at" value="<?= $post['updated_at'] ?>"></label></p>
    <button type="submit">UPDATE</button>
</form>
</body>
</html>