CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED WITH mysql_native_password BY 'password';
GRANT SELECT, UPDATE, INSERT,DELETE ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
CREATE TABLE IF NOT EXISTS users
(
    ID       INT(11)      NOT NULL AUTO_INCREMENT,
    username VARCHAR(32)  NOT NULL,
    password VARCHAR(256) NOT NULL,
    email    VARCHAR(64)  NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS phone
(
    ID          INT(11)      NOT NULL AUTO_INCREMENT,
    name        VARCHAR(255)  NOT NULL,
    description VARCHAR(256) NOT NULL,
    price       INT(7)       NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS files (
                                     ID INT(11) NOT NULL  AUTO_INCREMENT,
                                     content LONGBLOB NOT NULL,
                                     author VARCHAR(32) NOT NULL,
                                     file_name VARCHAR(256) NOT NULL,
                                     `type` VARCHAR(256) NOT NULL,
                                     PRIMARY KEY (ID)
);

INSERT INTO phone (name,description,price) VALUES ('Samsung gallaxy note 4','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam tristique, diam in consequat iaculis, est purus iaculis mauris, imperdiet facilisis ante ligula at nulla.',400);
INSERT INTO phone (name,description,price) VALUES ('Nokia Lumia 1320','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam tristique, diam in consequat iaculis, est purus iaculis mauris, imperdiet facilisis ante ligula at nulla.',899);
INSERT INTO phone (name,description,price) VALUES ('Samsung Galaxy s5- 2015','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam tristique, diam in consequat iaculis, est purus iaculis mauris, imperdiet facilisis ante ligula at nulla.',700);