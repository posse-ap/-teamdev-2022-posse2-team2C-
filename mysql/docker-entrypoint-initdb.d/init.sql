DROP SCHEMA IF EXISTS shukatu;

CREATE SCHEMA shukatu;

USE shukatu;

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

-- ここからエージェントの掲載情報一覧テーブル
DROP TABLE IF EXISTS agent;
CREATE TABLE  agent(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  agent_code INT NOT NULL ,
  catchphrase VARCHAR(255) NOT NULL,
  feature VARCHAR(255) NOT NULL,
  region_code VARCHAR(255) NOT NULL,
  prefecture_code VARCHAR(255) NOT NULL,
  online_meeting VARCHAR(255) NOT NULL,
  membership VARCHAR(255) NOT NULL,
  pros VARCHAR(255) NOT NULL,
  cons VARCHAR(255) NOT NULL
);


-- 地域指定テーブル
DROP TABLE IF EXISTS region;
CREATE TABLE  region(
  region_code INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  region_name VARCHAR(255) NOT NULL
);

-- 県指定テーブル
DROP TABLE IF EXISTS prefecture;
CREATE TABLE  prefecture(
  region_code INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  prefecture_code INT NOT NULL ,
  prefecture_name VARCHAR(255) NOT NULL
);

-- エージェントとエリアを結びつけるテーブル
DROP TABLE IF EXISTS agent_area_connect;
CREATE TABLE  agent_area_connect(
  agent_id INT NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  region_code INT NOT NULL ,
  prefecture_code INT NOT NULL
);


-- ここからエージェント自身の情報テーブル
DROP TABLE IF EXISTS agent_acount;
CREATE TABLE  agent_acount(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  agent_id INT NOT NULL ,
  conpany_name VARCHAR(255) NOT NULL,
  company_staff VARCHAR(255) NOT NULL,
  account_email_address VARCHAR(255) NOT NULL,
  account_password VARCHAR(255) NOT NULL,
  google_account VARCHAR(255) NOT NULL,
  `post_period` DATETIME NOT NULL
);

-- タグテーブル
DROP TABLE IF EXISTS tag;
CREATE TABLE  tag(
  tag_code INT NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  tag_name VARCHAR(255) NOT NULL
);

-- エージェントとタグを結びつけるテーブル
DROP TABLE IF EXISTS tag_agent_connect;
CREATE TABLE  tag_agent_connect(
  agent_id INT NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  tag_code INT NOT NULL
);
DROP TABLE IF EXISTS staff;
CREATE TABLE staff (
code INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
name VARCHAR(225) NOT NULL,
password VARCHAR(225) NOT NULL
); 