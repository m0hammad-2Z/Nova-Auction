create schema nova_auction;
use nova_auction;

create table user_info(
id int PRIMARY key AUTO_INCREMENT,
first_name varchar(25),
last_name varchar(25),
email varchar(50),
pass varchar(50),
phonenumber varchar(20)
);




