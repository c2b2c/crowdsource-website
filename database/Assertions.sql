/* Examples
CREATE ASSERTION smallClub
CHECK
( (SELECT COUNT (S.sid) FROM Sailors S)
+ (SELECT COUNT (B.bid) FROM Boats B) < 100)

CREATE ASSERTION BusySailors CHECK (
NOT EXISTS (
SELECT sid FROM Sailors WHERE sid NOT IN (
SELECT sid FROM Reserves) ))

CREATE TABLE Reserves ( sname CHAR(10),
AND rating <= 10 )
CREATE TABLE Sailors
bid INTEGER,
day DATE,
PRIMARY KEY (bid,day), CONSTRAINT noInterlakeRes CHECK (`Interlake’<>
(SELECT B.bname
FROM Boats B
WHERE B.bid=bid)))
*/


CREATE ASSERTION AtLeast1AskFor CHECK (
NOT EXISTS (
SELECT project_id FROM project WHERE project_id NOT IN (
SELECT project_id FROM askfor) ))

CREATE ASSERTION ArticleMustInProject CHECK (
NOT EXISTS (
SELECT post_id FROM article_post WHERE post_id NOT IN (
SELECT post_id FROM post_on) ))

CREATE ASSERTION CommentMustInPost CHECK (
NOT EXISTS (
SELECT comment_id FROM makes_comment WHERE comment_id NOT IN (
SELECT comment_id FROM comment_on) ))

CREATE ASSERTION ProjectMustInPublish CHECK (
NOT EXISTS (
SELECT project_id FROM project WHERE project_id NOT IN (
SELECT project_id FROM publish) ))
