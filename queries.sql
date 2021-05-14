create database covid_vaccine_slot;
use covid_vaccine_slot;
drop table member;
create table member(id int primary key auto_increment, email varchar(100), mobile_no bigint(10), pincode int(6), district_id int(6));