drop database if exists todo;

create database todo;

use todo;

create table user_data (
    id int primary key auto_increment,
    username varchar(30) not null unique,
    password varchar(255) not null,
    firstname varchar(100),
    lastname varchar(100)
);

create table task (
    id int primary key auto_increment,
    title varchar(255) not null,
    added timestamp default current_timestamp,
    description text,
    user_id int not null,
    index (user_id),
    foreign key (user_id) references user_data(id)
    on delete restrict
);