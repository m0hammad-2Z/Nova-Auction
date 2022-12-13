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
makes int,
model_name varchar(20),
FOREIGN KEY (makes) REFERENCES car_info_makes(id)
);


create table car_info(
id int PRIMARY key AUTO_INCREMENT,
year_of_make date,
user_id int,
model int,
city int,
price int,
img MEDIUMBLOB,
FOREIGN KEY (user_id) REFERENCES user_info(id),
FOREIGN KEY (model) REFERENCES car_info_model(id),
FOREIGN KEY (city) REFERENCES city(id)
);

insert into car_info_makes values
    (default,'toyota'),
    (default,'hyundai'),
    (default,'jeep'),
    (default,'tesla'),
    (default,'ford'),
    (default,'bmw'),
    (default,'mazda'),
    (default,'nissan'),
    (default,'mercedes-benz');

 insert into car_info_model values
    (default,1,'avalon'),
    (default,1,'camry'),
    (default,1,'corolla'),
    (default,2,'sonata'),
    (default,2,'accent'),
    (default,8,'gtr'),
    (default,8,'patrol'),
    (default,8,'sunny'),
    (default,9,'g'),
    (default,5,'fusion'); 

insert into city values
    (default,'amman'),
    (default,'aqaba'),
    (default,'zarqa'),
    (default,'madaba'),
    (default,'karak'),
    (default,'salt'),
    (default,'jerash'),
    (default,'irbid');
