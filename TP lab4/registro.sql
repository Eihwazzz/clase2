create database utn_labIV;
	use utn_labIV;

	create table user(
		id int not null auto_increment primary key,
		username varchar(100) not null unique,
		password varchar(50) not null
		);