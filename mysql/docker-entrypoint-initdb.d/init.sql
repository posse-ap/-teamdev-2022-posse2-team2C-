DROP SCHEMA IF EXISTS shukatu;

CREATE SCHEMA shukatu;

USE shukatu;



-- ここからエージェントの掲載情報一覧テーブル
DROP TABLE IF EXISTS agent;
CREATE TABLE  agent(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  agent_id INT NOT NULL ,
  company_name VARCHAR(255) NOT NULL,
  catchphrase VARCHAR(255) NOT NULL,
  feature VARCHAR(255) NOT NULL,
  online_meeting VARCHAR(255) NOT NULL,
  membership VARCHAR(255) NOT NULL,
  pros VARCHAR(255) NOT NULL,
  cons VARCHAR(255) NOT NULL
);

INSERT INTO agent (agent_id, company_name, catchphrase, feature, online_meeting, membership, pros, cons) VALUES 
("1", "irodas", "「いい会社じゃなく,いい人生に出会える場所」","自己分析～内定まで1対1でメンターがサポート","可","1,000","サポート体制が厚い","連絡頻度が高い"),
("2", "リクナビ就活エージェント", "「いい会社じゃなく,いい人生に出会える場所」","自己分析～内定まで1対1でメンターがサポート","不可","1,000","サポート体制が厚い","連絡頻度が高い"),
("3", "マイナビ", "「いい会社じゃなく,いい人生に出会える場所」","自己分析～内定まで1対1でメンターがサポート","可","1,000","サポート体制が厚い","連絡頻度が高い"),
("4", "doda", "「いい会社じゃなく,いい人生に出会える場所」","自己分析～内定まで1対1でメンターがサポート","可","1,000","サポート体制が厚い","連絡頻度が高い"),
("5", "キャリタス", "「いい会社じゃなく,いい人生に出会える場所」","自己分析～内定まで1対1でメンターがサポート","可","1,000","サポート体制が厚い","連絡頻度が高い");


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
(2,4),
(3,1),
(4,1),
(4,4);


DROP TABLE IF EXISTS shukatu.tag_existence;
CREATE TABLE shukatu.tag_existence(
  agent_id INT NOT NULL,
  tag_1 INT NOT NULL,
  tag_2 INT NOT NULL,
  tag_3 INT NOT NULL,
  tag_4 INT NOT NULL,
  tag_5 INT NOT NULL,
  tag_6 INT NOT NULL,
  tag_7 INT NOT NULL,
  tag_8 INT NOT NULL,
  tag_9 INT NOT NULL,
  tag_10 INT NOT NULL,
  tag_11 INT NOT NULL,
  tag_12 INT NOT NULL,
  tag_13 INT NOT NULL,
  tag_14 INT NOT NULL,
  tag_15 INT NOT NULL
);

INSERT INTO shukatu.tag_existence(agent_id, tag_1, tag_2, tag_3, tag_4, tag_5, tag_6, tag_7, tag_8, tag_9, tag_10,tag_11, tag_12, tag_13, tag_14,tag_15) VALUES
(1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0),
(2,1,1,0,0,1,1,0,0,0,0,0,0,0,0,0),
(3,1,0,1,1,1,0,0,0,0,0,0,0,0,0,0),
(4,0,1,1,1,1,0,0,0,0,0,0,0,0,0,0),
(5,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0);


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
("1","irodas","小野寛太","onokan@icloud.com","0706","onokan@gmail.com","2022-3-1","2022-4-1"),
("2","リクナビ就職エージェント","寺下渓志朗","terashi@icloud.com","0225","terashi@gmail.com","2022-3-1","2022-4-1"),
("3","マイナビ","冨永桃","momo@icloud.com","0315","momo@gmail.com","2022-3-1","2022-4-1"),
("4","doda","小林哲","akira@icloud.com","0115","momo@gmail.com","2022-3-1","2022-4-1"),
("5","キャリタス","三浦ぽんた","ponta@icloud.com","1009","momo@gmail.com","2022-3-1","2022-4-1");

-- エージェントパスワードリセット用テーブル
DROP TABLE IF EXISTS shukatu.password_resets;
CREATE TABLE shukatu.password_resets (
  account_email_address VARCHAR(255) NOT NULL ,
  mail_send_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  pass_reset_token VARCHAR(255) NOT NULL
);

-- boozerスタッフテーブル
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


DROP TABLE IF EXISTS shukatu.student_info;
CREATE TABLE shukatu.student_info (
  id INT NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  student_family_name VARCHAR(255) NOT NULL,
  student_first_name VARCHAR(255) NOT NULL,
  student_family_name_ruby VARCHAR(255) NOT NULL,
  student_first_name_ruby VARCHAR(255) NOT NULL,
  email_address VARCHAR(255) NOT NULL,
  phone_number VARCHAR(255) NOT NULL,
  name_of_the_univ VARCHAR(255) NOT NULL,
  faculty VARCHAR(255) NOT NULL,
  department VARCHAR(255) NOT NULL,
  school_year INT NOT NULL,
  the_year_of_grad INT NOT NULL,
  form_send_time DATETIME NOT NULL
);

-- INSERT INTO shukatu.student_info (student_family_name, student_first_name, student_family_name_ruby, student_first_name_ruby, email_address, phone_number, name_of_the_univ, faculty, department, school_year, the_year_of_grad) VALUES
-- ("冨永","桃","とみなが","もも","momo1777@icloud.com", "09071250315","早稲田大学","政治経済学部","国際政治経済学科","2","25"),
-- ("寺下","渓志朗","とみなが","もも","momo1777@icloud.com", "09071250315","早稲田大学","政治経済学部","国際政治経済学科","1","26"),
-- ("小野","寛太","とみなが","もも","momo1777@icloud.com", "09071250315","早稲田大学","政治経済学部","国際政治経済学科","3","24");


DROP TABLE IF EXISTS shukatu.student_agent_connection_table;

CREATE TABLE shukatu.student_agent_connection_table (
  student_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  agent_id INT NOT NULL
);


-- INSERT INTO shukatu.student_agent_connection_table (agent_id) VALUES 
-- (1),
-- (2),
-- (3),
-- (1),
-- (3),
-- (2),
-- (4);

-- 削除申請した学生
DROP TABLE IF EXISTS shukatu.student_delete_request_table;
CREATE TABLE shukatu.student_delete_request_table (
  id INT NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  student_family_name VARCHAR(255) NOT NULL,
  student_first_name VARCHAR(255) NOT NULL,
  student_family_name_ruby VARCHAR(255) NOT NULL,
  student_first_name_ruby VARCHAR(255) NOT NULL,
  email_address VARCHAR(255) NOT NULL,
  phone_number VARCHAR(255) NOT NULL,
  name_of_the_univ VARCHAR(255) NOT NULL,
  faculty VARCHAR(255) NOT NULL,
  department VARCHAR(255) NOT NULL,
  school_year INT NOT NULL,
  the_year_of_grad INT NOT NULL,
  agent_id INT NOT NULL,
  reason VARCHAR(255) NOT NULL
);