<?php
/* Connection ----------------------------------- */
$params = [
    'host' => 'localhost',
    'db'   => 'db_name',
    'user' => 'root',
    'pwd'  => '',
];

// Data Source Name.
$dsn = sprintf('mysql:host=%s;dbname=%s', $params['host'], $params['db']);

try {
    // Open connection. dbh - Database Handle.
    $dbh = new PDO($dsn, $params['user'], $params['pwd']);

    // Error handling settings.
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Default since PHP 8

} catch (PDOException $e) {
    echo 'PDO EXCEPTION: ' . $e->getMessage();
}
/* End Connection ----------------------------------- */


// SQL-constants
// ************* Users section ***************************************
const SQL_LOGIN = '
    SELECT *
    FROM users
    WHERE login = :login
';

const SQL_MAKE_SESSION = '
    SELECT *
    FROM users
    WHERE login = :login AND token = :token
';

const SQL_EMAIL = '
    SELECT *
    FROM users
    WHERE email = :email
';

const SQL_VERIFY_CODE = '
    SELECT *
    FROM users
    WHERE verify_code = :verify_code
';

const SQL_ACTIVATE_USER = '
    UPDATE users SET
      active = :active
    WHERE
      login = :login
';

const SQL_INSERT_USER = '
    INSERT INTO users (name, login, email, password, verify_code)
    VALUE (?,?,?,?,?)
';

const SQL_NEW_TOKEN = '
    UPDATE users SET
      token = :token
    WHERE
      login = :login
';

const SQL_GET_USERS = 'SELECT * FROM users';

const SQL_GET_USER = '
    SELECT id, active, role, name, login, email, password
    FROM users
    WHERE login = :login
';

const SQL_UPDATE_USER = '
    UPDATE users
    SET
      name = :name,
      email = :email
    WHERE
      login = :login
';


const SQL_UPDATE_PASSWORD = '
    UPDATE users
    SET
      password = :password
    WHERE
      login = :login
';

const SQL_UPDATE_USER_EXTENDED = '
    UPDATE users
    SET
      name = :name,
      email = :email,
      password = :password
    WHERE
      login = :login
';

const SQL_DELETE_USER = 'DELETE FROM users WHERE login = :login';



// ************* Posts section ***************************************
const SQL_GET_POSTS = 'SELECT * FROM posts WHERE user = :id';

const SQL_GET_POST = '
    SELECT *
    FROM posts
    WHERE id = :id AND user = :user
';

const SQL_DELETE_POST = 'DELETE FROM posts WHERE id = :id';

const SQL_UPDATE_POST = '
    UPDATE posts
    SET
      header = :header,
      content = :content
    WHERE
      id = :id
';

const SQL_INSERT_POST = '
    INSERT INTO posts (user, header, content)
    VALUE (:user, :header, :content)
';