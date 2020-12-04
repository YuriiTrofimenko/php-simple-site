<?php 
include_once('functions.php');
connect();
$ct1='create table countries(
id int not null auto_increment primary key, 
country varchar(64) unique
)default charset="utf8"';

$ct2='create table cities(
id int not null auto_increment primary key, 
city varchar(64), 
countryid int, 
foreign key(countryid) references countries(id) 
on delete cascade,
ucity varchar(128),
unique index ucity(city, countryid))default charset="utf8"';

$ct3='create table hotels(
id int not null auto_increment primary key, 
hotel varchar(64), 
cityid int, 
foreign key(cityid) references cities(id) on delete cascade, 
countryid int, 
foreign key(countryid) references countries(id) on delete cascade, 
stars int, 
cost int,
info varchar(1024))default charset="utf8"';

$ct4='create table images(
	id int not null auto_increment primary key,
	imagepath varchar(255),
	hotelid int, 
	foreign key(hotelid) references hotels(id) on delete cascade)
	default charset="utf8"';

$ct5='create table roles(
	id int not null auto_increment primary key,
	role varchar(32))default charset="utf8"';

$ct6='create table users(
	id int not null auto_increment primary key,
	login varchar(32) unique,
	pass varchar(128),
	email varchar(128),
	discount int,
	roleid int, 
	foreign key(roleid) references roles(id) on delete cascade,
	avatar mediumblob
	)default charset="utf8"';

mysql_query($ct1);
$err=mysql_errno();
if ($err){
	echo 'Error code 1:'.$err.'<br>';
	exit();
}
mysql_query($ct2);
$err=mysql_errno();
if ($err){
	echo 'Error code 2:'.$err.'<br>';
	exit();
}
mysql_query($ct3);
$err=mysql_errno();
if ($err){
	echo 'Error code 3:'.$err.'<br>';
	exit();
}
mysql_query($ct4);
$err=mysql_errno();
if ($err){
	echo 'Error code 4:'.$err.'<br>';
	exit();
}
mysql_query($ct5);
$err=mysql_errno();
if ($err){
	echo 'Error code 5:'.$err.'<br>';
	exit();
}
mysql_query($ct6);
$err=mysql_errno();
if ($err){
	echo 'Error code 6:'.$err.'<br>';
	exit();
}