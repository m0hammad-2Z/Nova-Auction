create schema nova_auction;
use nove_auction;

create table user_info(
user_id int PRIMARY key AUTO_INCREMENT,
user_firstname varchar(25),
user_secondname varchar(25),
email varchar(50),
pass varchar(50),
phonenumber varchar(20)
);