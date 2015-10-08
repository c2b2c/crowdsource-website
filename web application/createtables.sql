CREATE TABLE user (
	user_id INT(9) AUTO_INCREMENT,
	user_name VARCHAR(50) NOT NULL,
	password VARCHAR(50) NOT NULL,
	name VARCHAR(50),
	email VARCHAR(50) NOT NULL,
	address VARCHAR(50),
	telephone INT(10),
	profile_picture VARCHAR(200),
	PRIMARY KEY (user_id),
	UNIQUE(user_name),
	UNIQUE(email));

CREATE TABLE project (
	project_id INT(9) AUTO_INCREMENT,
	status VARCHAR(10) NOT NULL,
	name VARCHAR(60) NOT NULL,
	website_url VARCHAR(200),
	summary TEXT,
	category VARCHAR(50),
	PRIMARY KEY (project_id),
	CHECK (status = 'open' OR status = 'closed'));

CREATE TABLE resource (
	resource_id INT(9) AUTO_INCREMENT,
	category VARCHAR(50),
	description TEXT,
	PRIMARY KEY (resource_id));

CREATE TABLE article_post (
	post_id INT(9) AUTO_INCREMENT,
	image VARCHAR(200),
	post_time TIMESTAMP,
	title VARCHAR(200) NOT NULL,
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
	type VARCHAR(50),
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
	quantity INTEGER,
	PRIMARY KEY (project_id,resource_id),
	FOREIGN KEY (project_id) REFERENCES project (project_id) ON DELETE CASCADE,
	FOREIGN KEY (resource_id) REFERENCES resource (resource_id) ON DELETE CASCADE,
	CHECK (quantity > 0));

CREATE TABLE payback(
	project_id INT(9) NOT NULL,
	reward_id INT(9) NOT NULL,
	quantity_per_supporter INTEGER,
	delivery_method VARCHAR(50),
	PRIMARY KEY (project_id, reward_id),
	FOREIGN KEY (project_id) REFERENCES project (project_id) ON DELETE CASCADE,
	FOREIGN KEY (reward_id) REFERENCES reward (reward_id) ON DELETE CASCADE,
	CHECK (quantity_per_supporter > 0));

CREATE TABLE comment_on(
	post_id INT(9) NOT NULL,
	comment_id INT(9),
	PRIMARY KEY (comment_id),
	FOREIGN KEY (post_id) REFERENCES article_post (post_id) ON DELETE CASCADE,
	FOREIGN KEY (comment_id) REFERENCES makes_comment (comment_id) ON DELETE CASCADE);

CREATE TABLE offers (
	user_id INT(9) NOT NULL,
	project_id INT(9) NOT NULL,
	resource_id INT(9),
	quantity INTEGER,
	offer_time TIMESTAMP,
	PRIMARY KEY (user_id, project_id, resource_id, offer_time),
	FOREIGN KEY (resource_id) REFERENCES resource (resource_id) ON DELETE CASCADE,
	CHECK (quantity > 0));

CREATE ASSERTION AtLeast1AskForPerProject CHECK (
	NOT EXISTS (
	SELECT project_id FROM project WHERE project_id NOT IN (
	SELECT project_id FROM askfor) ));

CREATE ASSERTION ArticleMustAssociatedWithProject CHECK (
	NOT EXISTS (
	SELECT post_id FROM article_post WHERE post_id NOT IN (
	SELECT post_id FROM post_on) ));

CREATE ASSERTION CommentMustAssociatedWithPost CHECK (
	NOT EXISTS (
	SELECT comment_id FROM makes_comment WHERE comment_id NOT IN (
	SELECT comment_id FROM comment_on) ));

CREATE ASSERTION ProjectMustHaveAPublisher CHECK (
	NOT EXISTS (
	SELECT project_id FROM project WHERE project_id NOT IN (
	SELECT project_id FROM publish) ));

