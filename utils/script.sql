CREATE DATABASE __dd_mm;
USE __dd_mm;

CREATE TABLE person (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name varchar(256) NOT NULL,
  password varchar(256) NOT NULL,
  email varchar(256) NOT NULL
);

CREATE TABLE product (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  price decimal(10,2) NOT NULL,
  name varchar(256) NOT NULL,
  description text DEFAULT NULL,

  owner_id int(11) NOT NULL,

  FOREIGN KEY (owner_id) REFERENCES person(id)
);