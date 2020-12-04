<?php 
include_once('functions.php');
$pdo = connect();

$createTables = [];

$createTables[1]='create table countries(
id int not null auto_increment primary key, 
country varchar(64) unique
)default charset="utf8"';

$createTables[2]='create table cities(
id int not null auto_increment primary key, 
city varchar(64), 
countryid int, 
foreign key(countryid) references countries(id) 
on delete cascade,
ucity varchar(128),
unique index ucity(city, countryid))default charset="utf8"';

$createTables[3]='create table hotels(
id int not null auto_increment primary key, 
hotel varchar(64), 
cityid int, 
foreign key(cityid) references cities(id) on delete cascade, 
countryid int, 
foreign key(countryid) references countries(id) on delete cascade, 
stars int, 
cost int,
info varchar(1024))default charset="utf8"';

$createTables[4]='create table images(
	id int not null auto_increment primary key,
	imagepath varchar(255),
	hotelid int, 
	foreign key(hotelid) references hotels(id) on delete cascade)
	default charset="utf8"';

$createTables[5]='create table roles(
	id int not null auto_increment primary key,
	role varchar(32))default charset="utf8"';

$createTables[6]='create table users(
	id int not null auto_increment primary key,
	login varchar(32) unique,
	pass varchar(128),
	email varchar(128),
	discount int,
	roleid int, 
	foreign key(roleid) references roles(id) on delete cascade,
	avatar mediumblob
	)default charset="utf8"';


foreach ($createTables as $idx => $ct) {
    try {
        $resultCode = $pdo->exec($ct);
    } catch (PDOException $e) {
        echo "Error code $idx: $e->getMessage()<br>";
        exit();
    }
}