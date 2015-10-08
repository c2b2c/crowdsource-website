# crowdsource-website
crowdsource website

Description of the Application

        We are interested in building a platform for users to post their project ideas and get resources and supports. Internet offers a great solution for people to get support from people all around the world within a short period of time. Our website will be center around a list of on-going projects. Users can publish their projects and post articles about their projects to attract others’ attention to get the resources they need. As an example, if someone has a good idea on E-commerce but does not know how to build a website, the person could offer some reward, such as cookies made by his wife, and ask for help from developers. On the other way around, if a PhD student works on a cool research project but needs financial help, the student may collect fund on our website. Users can also search for and view various projects based on their interests, make comments on article posts and support the projects they like. The challenging part is the complicated relationships between user and project with reward and offers involved. Some example entities are user, project, resource and example relations are post, publish, support. For more details, please refer the ER diagram and schemas below. We will follow option 1 for part 3 and build a website front-end. To get started, we will populate the database with some PhD research projects going on at Columbia University and maybe some project ideas from kickstarter.com. 

Contingency plan

        we won’t include article_post and comment entities and relationships on them if one of us drops the class. 




















ER Diagram
 
Assumptions and Clarifications

•	We will use SQL assertions to capture and ensure total participations shown in the diagram, and they are not handled in schema design.
•	After a user decides to support a project, the user could add offers to that support relationship multiple times.
•	There could be article posts that are not about any projects, so there is no total participation of article post on post_on relationship.

Relational Schema

CREATE TABLE user (
user_id INTEGER,
user_name CHAR(20) NOT NULL,
password CHAR(50) NOT NULL,
name CHAR(20),
email CHAR(30) NOT NULL,
address CHAR(50),
telephone INTEGER),
profile_picture CHAR(200),
PRIMARY KEY (user_id)
UNIQUE(user_name)
UNIQUE(email))

CREATE TABLE project (
project_id INTEGER,
status CHAR(5) NOT NULL,
summary TEXT,
category CHAR(20),
PRIMARY KEY (project_id))

CREATE TABLE resource (
resource_id INTEGER,
category CHAR(20),
description TEXT,
PRIMARY KEY (resource_id))

CREATE TABLE article-post (
post_id INTEGER,
website_url CHAR(200),
images CHAR(200),
timestamp TIMESTAMP,
title CHAR(30) NOT NULL,
article TEXT,
PRIMARY KEY (post_id))

CREATE TABLE comment(
comment_id INTEGER,
timestamp TIMESTAMP,
content TEXT ,
PRIMARY KEY (comment_id))

CREATE TABLE reward(
reward_id INTEGER,
type CHAR(20),
description TEXT,
PRIMARY KEY (reward_id))

CREATE TABLE publish(
	project_id INTEGER,
	user_id INTEGER,
date DATE,
PRIMARY KEY (project_id),
FOREIGN KEY (user_id) REFERENCES user ON DELETE CASCADE,
FOREIGN KEY (project_id) REFERENCES project ON DELETE CASCADE)

CREATE TABLE support (
	user_id INTEGER,
	project_id INTEGER,
PRIMARY KEY (user_id,project_id),
FOREIGN KEY (user_id) REFERENCES user ON DELETE CASCADE,
FOREIGN KEY (user_id,project_id) REFERENCES project ON DELETE CASCADE)

CREATE TABLE offers (
	user_id INTEGER,
	project_id INTEGER,
	resource_id INTEGER,
quantity CHAR(10),
date DATE,
PRIMARY KEY (user_id, project_id, resource_id,date),
FOREIGN KEY (user_id, project_id) REFERENCES support ON DELETE CASCADE, 
FOREIGN KEY (resource_id) REFERENCES resource ON DELETE CASCADE)

CREATE TABLE post_on (
	project_id INTEGER,
	post_id INTEGER,
PRIMARY KEY (post_id),
FOREIGN KEY (project_id) REFERENCES project ON DELETE CASCADE,
FOREIGN KEY (post_id) REFERENCES post ON DELETE CASCADE)

CREATE TABLE askfor(
	project_id INTEGER,
	resource_id INTEGER,
quantity CHAR(10) ,
PRIMARY KEY (project_id,resource_id),
FOREIGN KEY (project_id) REFERENCES project ON DELETE CASCADE,
FOREIGN KEY (resource_id) REFERENCES resource ON DELETE CASCADE)

CREATE TABLE payback(
	project_id INTEGER,
	reward_id INTEGER,
quantity_per_supporter CHAR(20),
delivery_method CHAR(20),
PRIMARY KEY (project_id, reward_id),
FOREIGN KEY (project_id) REFERENCES project ON DELETE CASCADE,
FOREIGN KEY (reward_id) REFERENCES reward ON DELETE CASCADE)

CREATE TABLE comment_on(
	post_id INTEGER,
	comment_id INTEGER,
PRIMARY KEY (comment_id),
FOREIGN KEY (post_id) REFERENCES post ON DELETE CASCADE,
FOREIGN KEY (comment_id) REFERENCES comment ON DELETE CASCADE)

CREATE TABLE makes_comment(
	user_id INTEGER,
	comment_id INTEGER,
PRIMARY KEY (comment_id),
FOREIGN KEY (user_id) REFERENCES user ON DELETE CASCADE,
FOREIGN KEY (comment_id) REFERENCES comment ON DELETE CASCADE)

