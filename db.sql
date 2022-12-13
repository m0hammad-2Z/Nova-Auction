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

create table city(
id int PRIMARY key AUTO_INCREMENT,
city_name varchar(20)
);

create table car_info_makes(
id int PRIMARY key AUTO_INCREMENT,
makes_name varchar(20)
);

create table car_info_model(
id int PRIMARY key AUTO_INCREMENT,
model_name varchar(20)
);

create table car_info_type(
id int PRIMARY key AUTO_INCREMENT,
type_name varchar(20)
);

create table car_info(
id int PRIMARY key AUTO_INCREMENT,
year_of_make date,
user_id int,
makes int,
model int,
type int,
city int,
FOREIGN KEY (user_id) REFERENCES user_info(id),
FOREIGN KEY (makes) REFERENCES car_info_makes(id),
FOREIGN KEY (model) REFERENCES car_info_model(id),
FOREIGN KEY (type) REFERENCES car_info_type(id),
FOREIGN KEY (city) REFERENCES city(id)
);

