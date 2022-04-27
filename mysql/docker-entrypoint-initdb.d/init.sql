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
  agent_id INT NOT NULL ,
  catchphrase VARCHAR(255) NOT NULL,
  feature VARCHAR(255) NOT NULL,
  region_code VARCHAR(255) NOT NULL,
  prefecture_code VARCHAR(255) NOT NULL,
  online_meeting VARCHAR(255) NOT NULL,
  membership VARCHAR(255) NOT NULL,
  pros VARCHAR(255) NOT NULL,
  cons VARCHAR(255) NOT NULL
);

INSERT INTO agent (agent_id, catchphrase, feature, region_code, prefecture_code, online_meeting, membership, pros, cons) VALUES 
("1","「いい会社じゃなく,いい人生に出会える場所」","自己分析～内定まで1対1でメンターがサポート","1","1","可","1,000","サポート体制が厚い","連絡頻度が高い"),
("2","「いい会社じゃなく,いい人生に出会える場所」","自己分析～内定まで1対1でメンターがサポート","1","1","不可","1,000","サポート体制が厚い","連絡頻度が高い"),
("3","「いい会社じゃなく,いい人生に出会える場所」","自己分析～内定まで1対1でメンターがサポート","1","1","可","1,000","サポート体制が厚い","連絡頻度が高い");


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

-- タグテーブル
DROP TABLE IF EXISTS tag;
CREATE TABLE  tag(
  tag_code INT NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  tag_name VARCHAR(255) NOT NULL
);

INSERT INTO tag (tag_code, tag_name) VALUES
(1,"文系"),
(2,"理系"),
(3,"オンライン面談可"),
(4,"23卒"),
(5,"24卒"),
(6,"25卒"),
(7,"大手"),
(8,"ベンチャー"),
(9,"広告・出版・マスコミ"),
(10,"金融"),
(11,"サービス・インフラ"),
(12,"小売"),
(13,"ソフトウェア"),
(14,"官公庁・校舎・団体"),
(15,"商社");

-- エージェントとタグを結びつけるテーブル
DROP TABLE IF EXISTS tag_agent_connect;
CREATE TABLE  tag_agent_connect(
  id INT NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  agent_id INT NOT NULL,
  tag_code INT NOT NULL
);

INSERT INTO tag_agent_connect (agent_id, tag_code) VALUES
(1,1),
(1,2),
(1,3),
(2,1),
(2,4);


-- ここからエージェント自身の情報テーブル
DROP TABLE IF EXISTS agent_account;
CREATE TABLE  agent_account(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  agent_id INT NOT NULL ,
  company_name VARCHAR(255) NOT NULL,
  company_staff VARCHAR(255) NOT NULL,
  account_email_address VARCHAR(255) NOT NULL,
  account_password VARCHAR(255) NOT NULL,
  google_account VARCHAR(255) NOT NULL,
  post_period_start VARCHAR(255) NOT NULL,
  post_period_end VARCHAR(255) NOT NULL
);

INSERT INTO agent_account (agent_id, company_name, company_staff, account_email_address, account_password, google_account, post_period_start, post_period_end) VALUES 
("1","就活エージェントA","小野寛太","onokan@icloud.com","0706","onokan@gmail.com","2022-3-1","2022-4-1"),
("2","就活エージェントB","寺下渓志朗","terashi@icloud.com","0706","terashi@gmail.com","2022-3-1","2022-4-1"),
("3","就活エージェントC","冨永桃","momo@icloud.com","0706","momo@gmail.com","2022-3-1","2022-4-1");


DROP TABLE IF EXISTS shukatu.staff;
CREATE TABLE shukatu.staff (
code INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
name VARCHAR(225) NOT NULL,
password VARCHAR(225) NOT NULL,
mail_address VARCHAR(50) NOT NULL
); 

INSERT INTO shukatu.staff (code, name, password, mail_address) VALUES 
("1","小野寛太","0706","onokan@gmail.com"),
("2","寺下渓志朗","0225","terashi@gmail.com"),
("3","冨永桃","0315","momo@gmail.com");