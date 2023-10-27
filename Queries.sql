DROP DATABASE IF EXISTS college;

CREATE DATABASE IF NOT EXISTS college;

USE college;

CREATE TABLE IF NOT EXISTS books (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  book_name VARCHAR(255),
  publishing_date DATE,
  author_name VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS book_details(
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Stock INT(5),
  FOREIGN KEY (id) REFERENCES books(id)
);

CREATE TABLE IF NOT EXISTS borrowings (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_name VARCHAR(100),
  book_id INT(11),
  borrow_date DATE
);

CREATE TABLE IF NOT EXISTS returns (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_name VARCHAR(100),
  book_id INT(11),
  return_date DATE
);

CREATE TABLE IF NOT EXISTS courses (
  course_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  course_name VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS enrollments (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  student_id INT(11),
  course_id INT(11),
  semester VARCHAR(100),
  department VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS user (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(250),
  email VARCHAR(250),
  status VARCHAR(255) DEFAULT 'student',
  phone VARCHAR(100),
  password VARCHAR(10)
);

SHOW TABLES;
