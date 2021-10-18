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
const SQL_CREATE_USERS_TABLE = '
	CREATE TABLE IF NOT EXISTS users (
		id INT UNSIGNED AUTO_INCREMENT NOT NULL,
		active BOOLEAN NOT NULL DEFAULT \'0\',
		role VARCHAR(50) NOT NULL DEFAULT \'user\',
		name VARCHAR(255) NOT NULL,
		login VARCHAR(255) NOT NULL UNIQUE,
		email VARCHAR(255) NOT NULL UNIQUE,
		password VARCHAR(255) NOT NULL,
		verify_code CHAR(32) NOT NULL,
		token CHAR(32),
		PRIMARY KEY (id)
	)
';

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

const SQL_PASSWORD = '
    SELECT *
    FROM users
    WHERE password = :password
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


const SQL_UPDATE_UPASSWORD = '
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



// ************* Tasks section ***************************************
const SQL_CREATE_TASKS_TABLE = '
	CREATE TABLE IF NOT EXISTS tasks (
		id INT UNSIGNED AUTO_INCREMENT NOT NULL,
		user_id INT UNSIGNED NOT NULL,
		done BOOLEAN NOT NULL DEFAULT \'0\',
		create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		header VARCHAR(35) NOT NULL,
		description VARCHAR(1000) NOT NULL,
		deadline DATETIME NULL,
		PRIMARY KEY (id)
	)
';

const SQL_GET_TASKS = 'SELECT * FROM tasks WHERE user_id = :user_id';

const SQL_GET_TASK = '
    SELECT *
    FROM tasks
    WHERE id = :task_id AND user_id = :user_id
';

const SQL_DELETE_TASK = 'DELETE FROM tasks WHERE id = :task_id';

const SQL_UPDATE_TASK = '
    UPDATE tasks
    SET
      header = :header,
      done = :done,
      description = :description
    WHERE
      id = :task_id
';

const SQL_INSERT_TASK = '
    INSERT INTO tasks (user_id, done, header, description)
    VALUE (:user_id, :done, :header, :description)
';