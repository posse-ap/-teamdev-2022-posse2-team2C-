DROP SCHEMA IF EXISTS shukasu;

CREATE SCHEMA shukatsu;

USE shukatsu;

DROP TABLE IF EXISTS users;



CREATE TABLE users (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  email VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO
  users
SET
  email = 'test@posse-ap.com',
  password = sha1('password');

DROP TABLE IF EXISTS events;

CREATE TABLE events (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO
  events
SET
  title = 'イベント1';

INSERT INTO
  events
SET
  title = 'イベント2';



DROP TABLE IF EXISTS agent_acount;
CREATE TABLE agent_acount (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `agent_id` INT NOT NULL ,
  `conpany_name` VARCHAR(255) NOT NULL,
  `company_staff` VARCHAR(255) NOT NULL,
  `account_email_address` VARCHAR(255) NOT NULL,
  `account_password` VARCHAR(255) NOT NULL,
  `google account` VARCHAR(255) NOT NULL,
  `post_period` DATETIME NOT NULL
);

DROP TABLE IF EXISTS agent_acount;
CREATE TABLE agent_acount (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `agent_id` INT NOT NULL ,
  `conpany_name` VARCHAR(255) NOT NULL,
  `company_staff` VARCHAR(255) NOT NULL,
  `account_email_address` VARCHAR(255) NOT NULL,
  `account_password` VARCHAR(255) NOT NULL,
  `google account` VARCHAR(255) NOT NULL,
  `post_period` DATETIME NOT NULL
);




