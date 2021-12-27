drop database if exists usersdb;
create database usersdb;
use userstdb;


CREATE TABLE user2(
    id int primary key AUTO_INCREMENT,
    fname varchar(50) NOT NULL,
    lname varchar(50) NOT NULL,
    username varchar(50) NOT NULL,
    passwd varchar(50) NOT NULL,
);

CREATE TABLE user_data(
    data_id int primary key AUTO_INCREMENT,
    eMail varchar(50) NOT NULL,
    phoneNumber varchar(50) NOT NULL
    
);