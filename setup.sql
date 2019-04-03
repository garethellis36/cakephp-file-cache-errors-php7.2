CREATE DATABASE cake_test_app;
CREATE DATABASE cake_test_test;

USE cake_test_app;
CREATE TABLE users (
    id   int AUTO_INCREMENT,
    name varchar(20) NULL,
    CONSTRAINT users_id_pk
        PRIMARY KEY (id)
);

