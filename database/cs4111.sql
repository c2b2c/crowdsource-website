mysqldump -h cs4111.cievuwypzozw.us-west-2.rds.amazonaws.com -P 3306 -u xw2344 -p cs4111 > cs4111.sql

CREATE TABLE user (
	user_id INT(9) AUTO_INCREMENT,
	user_name VARCHAR(20) NOT NULL,
	password VARCHAR(50) NOT NULL,
	name VARCHAR(50),
	email VARCHAR(40) NOT NULL,
	address VARCHAR(50),
	telephone INT,
	profile_picture CHAR(200),
	PRIMARY KEY (user_id),
	UNIQUE(user_name),
	UNIQUE(email));

CREATE TABLE project (
	project_id INT(9) AUTO_INCREMENT,
	status VARCHAR(10) NOT NULL,
	name VARCHAR(60) NOT NULL,
	website_url VARCHAR(200),
	summary TEXT,
	category VARCHAR(20),
	PRIMARY KEY (project_id));

CREATE TABLE resource (
	resource_id INT(9) AUTO_INCREMENT,
	category VARCHAR(40),
	description TEXT,
	PRIMARY KEY (resource_id));

CREATE TABLE article_post (
	post_id INT(9) AUTO_INCREMENT,
	image VARCHAR(200),
	post_time TIMESTAMP,
	title VARCHAR(50) NOT NULL,
	article TEXT,
	PRIMARY KEY (post_id));

CREATE TABLE make_comment(
	comment_id INT(9) AUTO_INCREMENT,
	comment_time TIMESTAMP,
	user_id INT(9) NOT NULL,
	content TEXT ,
	PRIMARY KEY (comment_id),
	FOREIGN KEY (user_id) REFERENCES user (user_id) ON DELETE CASCADE);

CREATE TABLE reward(
	reward_id INT(9) AUTO_INCREMENT,
	type VARCHAR(40),
	description TEXT,
	PRIMARY KEY (reward_id));

CREATE TABLE publish(
	project_id INT(9),
	user_id INT(9) NOT NULL,
	publish_time TIMESTAMP,
	PRIMARY KEY (project_id),
	FOREIGN KEY (user_id) REFERENCES user (user_id) ON DELETE CASCADE,
	FOREIGN KEY (project_id) REFERENCES project (project_id) ON DELETE CASCADE);

CREATE TABLE post_on (
	project_id INT(9) NOT NULL,
	post_id INT(9),
	PRIMARY KEY (post_id),
	FOREIGN KEY (project_id) REFERENCES project (project_id) ON DELETE CASCADE,
	FOREIGN KEY (post_id) REFERENCES article_post (post_id) ON DELETE CASCADE);

CREATE TABLE askfor(
	project_id INT(9) NOT NULL,
	resource_id INT(9) NOT NULL,
	quantity VARCHAR(10),
	PRIMARY KEY (project_id,resource_id),
	FOREIGN KEY (project_id) REFERENCES project (project_id) ON DELETE CASCADE,
	FOREIGN KEY (resource_id) REFERENCES resource (resource_id) ON DELETE CASCADE);

CREATE TABLE payback(
	project_id INT(9),
	reward_id INT(9),
	quantity_per_supporter VARCHAR(50),
	delivery_method VARCHAR(50),
	PRIMARY KEY (project_id, reward_id),
	FOREIGN KEY (project_id) REFERENCES project (project_id) ON DELETE CASCADE,
	FOREIGN KEY (reward_id) REFERENCES reward (reward_id) ON DELETE CASCADE);

CREATE TABLE comment_on(
	post_id INT(9),
	comment_id INT(9),
	PRIMARY KEY (comment_id),
	FOREIGN KEY (post_id) REFERENCES article_post (post_id) ON DELETE CASCADE,
	FOREIGN KEY (comment_id) REFERENCES make_comment (comment_id) ON DELETE CASCADE);

CREATE TABLE offers (
	user_id INT(9),
	project_id INT(9),
	resource_id INT(9),
	quantity VARCHAR(10),
	offer_time TIMESTAMP,
	PRIMARY KEY (user_id, project_id, resource_id, offer_time),
	FOREIGN KEY (resource_id) REFERENCES resource (resource_id) ON DELETE CASCADE);


LOAD DATA LOCAL INFILE '/Users/apple/Desktop/\[Columbia\]/课程（学期2）/INTRODUCTION\ TO\ DATABASES/project1.2/datasets\(returned\ 2\)/user.csv '
INTO TABLE user 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n' 
IGNORE 1 ROWS;

LOAD DATA LOCAL INFILE '/Users/apple/Desktop/\[Columbia\]/课程（学期2）/INTRODUCTION\ TO\ DATABASES/project1.2/datasets\(returned\ 2\)/project.csv '
INTO TABLE project 
FIELDS TERMINATED BY ','  
ENCLOSED BY '"'
LINES TERMINATED BY '\n' 
IGNORE 1 ROWS;

LOAD DATA LOCAL INFILE '/Users/apple/Desktop/\[Columbia\]/课程（学期2）/INTRODUCTION\ TO\ DATABASES/project1.2/datasets\(returned\ 2\)/resource.csv '
INTO TABLE resource 
FIELDS TERMINATED BY ','  
ENCLOSED BY '"'
LINES TERMINATED BY '\n' 
IGNORE 1 ROWS;

LOAD DATA LOCAL INFILE '/Users/apple/Desktop/\[Columbia\]/课程（学期2）/INTRODUCTION\ TO\ DATABASES/project1.2/datasets\(returned\ 2\)/article_post.csv '
INTO TABLE article_post 
FIELDS TERMINATED BY ','  
ENCLOSED BY '"'
LINES TERMINATED BY '\n' 
IGNORE 1 ROWS;

LOAD DATA LOCAL INFILE '/Users/apple/Desktop/\[Columbia\]/课程（学期2）/INTRODUCTION\ TO\ DATABASES/project1.2/datasets\(returned\ 2\)/make_comment.csv '
INTO TABLE make_comment 
FIELDS TERMINATED BY ','  
ENCLOSED BY '"'
LINES TERMINATED BY '\n' 
IGNORE 1 ROWS;

/*LOAD DATA LOCAL INFILE '/Users/apple/Desktop/\[Columbia\]/课程（学期2）/INTRODUCTION\ TO\ DATABASES/project1.2/datasets\(returned\ 2\)/make_comment.csv '
INTO TABLE make_comment 
(@var1)
FIELDS TERMINATED BY ','  
ENCLOSED BY '"'
LINES TERMINATED BY '\n' 
SET comment_time=str_to_date(SUBSTR(@var1,2,10),'%m/%d/%Y'),
IGNORE 1 ROWS;*/

LOAD DATA LOCAL INFILE '/Users/apple/Desktop/\[Columbia\]/课程（学期2）/INTRODUCTION\ TO\ DATABASES/project1.2/datasets\(returned\ 2\)/reward.csv '
INTO TABLE reward 
FIELDS TERMINATED BY ','  
ENCLOSED BY '"'
LINES TERMINATED BY '\n' 
IGNORE 1 ROWS;

LOAD DATA LOCAL INFILE '/Users/apple/Desktop/\[Columbia\]/课程（学期2）/INTRODUCTION\ TO\ DATABASES/project1.2/datasets\(returned\ 2\)/publish.csv '
INTO TABLE publish 
FIELDS TERMINATED BY ','  
ENCLOSED BY '"'
LINES TERMINATED BY '\n' 
IGNORE 1 ROWS;

LOAD DATA LOCAL INFILE '/Users/apple/Desktop/\[Columbia\]/课程（学期2）/INTRODUCTION\ TO\ DATABASES/project1.2/datasets\(returned\ 2\)/post_on.csv '
INTO TABLE post_on 
FIELDS TERMINATED BY ','  
ENCLOSED BY '"'
LINES TERMINATED BY '\n' 
IGNORE 1 ROWS;

LOAD DATA LOCAL INFILE '/Users/apple/Desktop/\[Columbia\]/课程（学期2）/INTRODUCTION\ TO\ DATABASES/project1.2/datasets\(returned\ 2\)/askfor.csv '
INTO TABLE askfor 
FIELDS TERMINATED BY ','  
ENCLOSED BY '"'
LINES TERMINATED BY '\n' 
IGNORE 1 ROWS;


LOAD DATA LOCAL INFILE '/Users/apple/Desktop/\[Columbia\]/课程（学期2）/INTRODUCTION\ TO\ DATABASES/project1.2/datasets\(returned\ 2\)/payback.csv '
INTO TABLE payback 
FIELDS TERMINATED BY ','  
ENCLOSED BY '"'
LINES TERMINATED BY '\n' 
IGNORE 1 ROWS;

LOAD DATA LOCAL INFILE '/Users/apple/Desktop/\[Columbia\]/课程（学期2）/INTRODUCTION\ TO\ DATABASES/project1.2/datasets\(returned\ 2\)/comment_on.csv '
INTO TABLE comment_on 
FIELDS TERMINATED BY ','  
ENCLOSED BY '"'
LINES TERMINATED BY '\n' 
IGNORE 1 ROWS;

LOAD DATA LOCAL INFILE '/Users/apple/Desktop/\[Columbia\]/课程（学期2）/INTRODUCTION\ TO\ DATABASES/project1.2/datasets\(returned\ 2\)/offers.csv '
INTO TABLE offers 
FIELDS TERMINATED BY ','  
ENCLOSED BY '"'
LINES TERMINATED BY '\n' 
IGNORE 1 ROWS;
