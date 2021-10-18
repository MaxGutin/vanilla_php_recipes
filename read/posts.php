<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/authentication/assets/db-handle.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/authentication/assets/secure.php";
try {

    // get tasks of user
    $sth = $dbh->prepare(SQL_GET_POSTS);
    $sth->bindParam(':id', $_SESSION['user']['id']);
    $sth->execute();
    $posts = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '== PDO EXCEPTION (read.php): == <pre>' . $e->getMessage() . '</pre>';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Read posts</title>
</head>
<body>

<table>
    <thead>
        <tr>
            <td>Header</td>
            <td>edit</td>
            <td>Delete</td>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($posts as $post) { ?>
        <tr>
            <td>
                <a href="post.php?id=<?php echo $post['id'] ?>"><?php echo $post['header'] ?></a>
            </td>
            <td>
                <a href="/update/update.php?id=<?php echo $post['id'] ?>">
                    <i class="material-icons">edit</i>
                </a>
            </td>
            <td>
                <a href="/delete/delete-handle.php?id=<?= $post['id'] ?>">
                    <i class="material-icons">delete</i>
                </a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>