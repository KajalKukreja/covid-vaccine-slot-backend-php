create database covid_vaccine_slot;
use covid_vaccine_slot;
drop table member;
create table member(
    id int primary key auto_increment,
    email varchar(100),
    mobile_no bigint(10),
    pincode int(6),
    district_id int(6),
    age int(2),
    dose varchar(5)
);
-- Only for testing
-- insert into member(email, mobile_no, pincode, district_id, age, dose) values('kajalkukreja694@gmail.com', 0, 110005, 0, 45, 'dose1');
-- insert into member(email, mobile_no, pincode, district_id, age, dose) values('kajalkukreja694@gmail.com', 0, 0, 141, 45, 'dose2');
-- insert into member(email, mobile_no, pincode, district_id, age, dose) values('kajalkukreja0694@gmail.com', 0, 110005, 0, 18, 'dose1');
-- insert into member(email, mobile_no, pincode, district_id, age, dose) values('kajalkukreja0694@gmail.com', 0, 0, 141, 18, 'dose2');
-- insert into member(email, mobile_no, pincode, district_id, age, dose) values('kajalkukreja0694@gmail.com', 0, 110005, 141, null, null);
select * from member;
