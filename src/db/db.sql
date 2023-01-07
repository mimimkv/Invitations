DROP DATABASE IF EXISTS invitations;

CREATE DATABASE invitations;

USE invitations;

CREATE TABLE users(
  fn INT PRIMARY KEY,
  email VARCHAR(30) NOT NULL UNIQUE,
  password VARCHAR(20) NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  course INT NOT NUll,
  specialty VARCHAR(50) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE invitations(
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(100) NOT NULL UNIQUE,
  place VARCHAR(50) NOT NULL,
  date date NOT NULL, 
  time time NOT NULL,
  filename VARCHAR(30),
  UNIQUE KEY unique_time(date, time)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;