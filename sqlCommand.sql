mysql -u root p 

show databases;

create database if not exists students;
 
use students;

create table if not exists studentsinfo(
    id int primary key auto_increment,
    name varchar(100),
    result varchar(50)
);
describe studentsinfo;

show tables;


insert into studentsinfo(name, result) values
('John Doe', 'Pass'),
('Jane Smith', 'Fail'),
('Alice Johnson', 'Pass');

alter table studentsinfo add column grade varchar(100);

alter table studentsinfo change result marks varchar(50);

mysqldump -u root -p students > g:/xamp/htdocs/mysql/mysql/studentsinfo.sql
