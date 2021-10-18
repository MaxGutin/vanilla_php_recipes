# MySQL 8.0

CREATE DATABASE IF NOT EXISTS db_name
    CHARACTER SET = utf8mb4
    COLLATE = utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `users`
(
    `id`          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `active`      BOOLEAN         NOT NULL DEFAULT '0',
    `role`        VARCHAR(50)     NOT NULL DEFAULT 'user',
    `name`        VARCHAR(255)    NOT NULL,
    `login`       VARCHAR(255)    NOT NULL UNIQUE,
    `email`       VARCHAR(255)    NOT NULL UNIQUE,
    `password`    VARCHAR(255)    NOT NULL,
    `verify_code` CHAR(32)        NOT NULL,
    `token`       CHAR(32)        NOT NULL,
    `created_at`  TIMESTAMP       NULL     DEFAULT CURRENT_TIMESTAMP,
    `updated_at`  TIMESTAMP       NULL     DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
CREATE TABLE IF NOT EXISTS `groups`
(
    `id`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`        VARCHAR(255) NOT NULL,
    `description` TEXT         NULL,
    `created_at`  TIMESTAMP    NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`  TIMESTAMP    NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);
CREATE TABLE IF NOT EXISTS `post_categories`
(
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `parent_id`  INT UNSIGNED NULL,
    `name`       VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP    NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP    NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
    );
CREATE TABLE IF NOT EXISTS `posts`
(
    `id`          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `category_id` INT UNSIGNED    NULL,
    `user`        VARCHAR(255)    NULL,
    `header`      VARCHAR(255)    NULL,
    `content`     TEXT            NULL,
    `created_at`  TIMESTAMP       NULL     DEFAULT CURRENT_TIMESTAMP,
    `updated_at`  TIMESTAMP       NULL     DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);