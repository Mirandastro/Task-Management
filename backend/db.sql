SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS gtlmhd;
CREATE DATABASE gtlmhd;

USE gtlmhd;

CREATE TABLE Task(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(100),
    description varchar(100),
    stime varchar(16),
    etime varchar(16),
    state int NOT NULL DEFAULT 0,
    history int NOT NULL DEFAULT 0,
    fileid int NOT NULL DEFAULT 0,
    isgroup boolean NOT NULL DEFAULT false,
    groupid int NOT NULL DEFAULT 0,
    mbnum int NOT NULL DEFAULT 0,
    mb1 int NOT NULL DEFAULT 0,
    mb2 int NOT NULL DEFAULT 0,
    mb3 int NOT NULL DEFAULT 0,
    mb4 int NOT NULL DEFAULT 0,
    mb5 int NOT NULL DEFAULT 0,
    mb6 int NOT NULL DEFAULT 0,
    mb7 int NOT NULL DEFAULT 0,
    mb8 int NOT NULL DEFAULT 0,
    updated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) AUTO_INCREMENT = 1;

CREATE TABLE Member(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(100),
    username varchar(50) DEFAULT NULL,
    profilenum int NOT NULL DEFAULT 1,
    email varchar(100),
    position varchar(16),
    created_at datetime DEFAULT current_timestamp(),
    password varchar(255) DEFAULT NULL,
    jtime varchar(16),
    role  varchar(16),
    state int NOT NULL DEFAULT 0,
    updated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) AUTO_INCREMENT = 1;

CREATE TABLE MbGroup(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(100),
    description varchar(100),
    ctime varchar(16),
    state int NOT NULL DEFAULT 0,
    mbnum int NOT NULL DEFAULT 0,
    mb1 int NOT NULL DEFAULT 0,
    mb2 int NOT NULL DEFAULT 0,
    mb3 int NOT NULL DEFAULT 0,
    mb4 int NOT NULL DEFAULT 0,
    mb5 int NOT NULL DEFAULT 0,
    mb6 int NOT NULL DEFAULT 0,
    mb7 int NOT NULL DEFAULT 0,
    mb8 int NOT NULL DEFAULT 0,
    updated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) AUTO_INCREMENT = 1;

CREATE TABLE files(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    file_name varchar(100),
    file_type varchar(255) NOT NULL,
    description varchar(100) DEFAULT NULL,
    date_uploaded date DEFAULT NULL,
    last_updated date DEFAULT NULL,
    mb_id int DEFAULT NULL,
    taskid int NOT NULL DEFAULT 0,
    updated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) AUTO_INCREMENT = 1;


CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON gtlmhd.Task TO dbadmin@localhost;
GRANT all privileges ON gtlmhd.Member TO dbadmin@localhost;
GRANT all privileges ON gtlmhd.MbGroup TO dbadmin@localhost;
GRANT all privileges ON gtlmhd.files TO dbadmin@localhost;


INSERT INTO Task(name, description, stime, etime) 
VALUES('Task 1', 'someting', '2023-09-20', '2023-09-20');

INSERT INTO Task(name, description, stime, etime) 
VALUES('Task 2', 'someting', '2023-09-20', '2023-09-20');

INSERT INTO Task(name, description, stime, etime) 
VALUES('Task 3', 'someting', '2023-09-20', '2023-09-20');

INSERT INTO Task(name, description, stime, etime) 
VALUES('Task 4', 'someting', '2023-09-20', '2023-09-20');


INSERT INTO Member(name, profilenum, email, position, jtime) 
VALUES('Sam Hew', 3, 'samhew@hd.com', 'Manager', '2022-02-20');

INSERT INTO Member(name, profilenum, email, position, jtime) 
VALUES('Amy Song', 4, 'amysong@hd.com', 'Desinger', '2022-02-20');

INSERT INTO Member(name, profilenum, email, position, jtime) 
VALUES('Jay Kwon', 3, 'jaykwon@hd.com', 'Manager', '2022-02-20');

INSERT INTO Member(name, profilenum, email, position, jtime) 
VALUES('Lei Tang', 1, 'leitang@hd.com', 'Desinger', '2022-02-20');



INSERT INTO MbGroup(name, description)
VALUES('Group01', 'group 01');

INSERT INTO MbGroup(name, description) 
VALUES('Group02', 'group 02');


INSERT INTO `files` (`id`, `file_name`, `file_type`, `description`, `date_uploaded`, `last_updated`, `mb_id`, `taskid`, `updated`) VALUES
(1, 'LOGIN_EOI_NUMBER.PNG', 'png', NULL, '2023-09-21', '2023-09-21', 1, 0, '2023-10-08 13:44:27'),
(2, 'CV.jpg', 'jpg', NULL, '2023-09-21', '2023-09-21', 2, 0, '2023-10-08 13:44:27');



CREATE TABLE myGroup(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    group_name VARCHAR(100),
    leader VARCHAR(100),
    project_name VARCHAR(100),
    updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) AUTO_INCREMENT = 1;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON gtlmhd.myGroup TO dbadmin@localhost;


INSERT INTO myGroup(group_name, leader, project_name)
VALUES
    ('Cycle 1 Team', 'Amy Song', 'Topic 9030'),
    ('Cycle 2 Team', 'Lei Tang', 'Topic 9030'),
    ('Cycle 3 Team', 'Jay Kwon', 'Topic 9030');

CREATE TABLE myMember(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    group_name VARCHAR(100),
    group_member VARCHAR(100),
    email VARCHAR(100),
    member_role VARCHAR(100),
    updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) AUTO_INCREMENT = 1;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON gtlmhd.myMember TO dbadmin@localhost;


INSERT INTO myMember(group_name, group_member, email, member_role)
VALUES
    ('Cycle 1 Team', 'Lei Tang', 'leitang@hd.com', 'Desinger'),
    ('Cycle 2 Team', 'Amy', 'amy@hd.com', 'Desinger');


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);


ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;


GRANT all privileges ON gtlmhd.users TO dbadmin@localhost;


