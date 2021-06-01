create database covid_vaccine_slot;
use covid_vaccine_slot;
drop table member;
create table member(id int primary key auto_increment, email varchar(100), mobile_no bigint(10), pincode int(6), district_id int(6));
-- Only for testing
-- insert into member(email, mobile_no, pincode, district_id) values('kajalkukreja694@gmail.com', 0, 110005, 0);
-- insert into member(email, mobile_no, pincode, district_id) values('kajalkukreja694@gmail.com', 0, 0, 3);
-- insert into member(email, mobile_no, pincode, district_id) values('kajalkukreja0694@gmail.com', 0, 110005, 0);
-- insert into member(email, mobile_no, pincode, district_id) values('kajalkukreja0694@gmail.com', 0, 0, 3);
-- insert into member(email, mobile_no, pincode, district_id) values('kajalkukreja0694@gmail.com', 0, 110005, 3);
select * from member;
