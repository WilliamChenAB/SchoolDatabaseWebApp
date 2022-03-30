CREATE DATABASE Hockey_League;

use Hockey_League;

CREATE TABLE Sponsors (
	sid INTEGER,
	name VARCHAR(50),
	PRIMARY KEY (sid)
);

CREATE TABLE Managers (
	mid INTEGER,
	name VARCHAR(50),
	birthday DATE,
	PRIMARY KEY (mid)
);

CREATE TABLE Coaches (
	cid INTEGER,
	name VARCHAR(50),
	birthday DATE,
	PRIMARY KEY (cid)
);

CREATE TABLE Referees (
	rid INTEGER,
	name VARCHAR(50),
	birthday DATE,
	PRIMARY KEY (rid)
);

CREATE TABLE Players (
	pid INTEGER,
	name VARCHAR(50),
	birthday DATE,
	total_goals INTEGER,
	position VARCHAR(20),
	PRIMARY KEY (pid)
);

CREATE TABLE Cities(
	city VARCHAR(20),
	country VARCHAR(20),
	PRIMARY KEY (city)
);

CREATE TABLE Venues (
	address VARCHAR(50),
	name VARCHAR(50),
	capacity INTEGER,
	city VARCHAR(20),
	PRIMARY KEY (address),
	FOREIGN KEY (city) REFERENCES Cities(city) ON DELETE SET NULL
);

CREATE TABLE Rink_sizes(
	rink_standard VARCHAR(50),
	rink_width FLOAT,
	rink_length FLOAT,
	PRIMARY KEY (rink_standard)
);

CREATE TABLE Rinks(
	address VARCHAR(50),
	rnum INTEGER,
	rink_standard VARCHAR(50),
	city VARCHAR(20),
	PRIMARY KEY (address, rnum),
	FOREIGN KEY (address) REFERENCES Venues(address) ON DELETE CASCADE,
	FOREIGN KEY (rink_standard) REFERENCES Rink_sizes(rink_standard) ON DELETE SET NULL,
	FOREIGN KEY (city) REFERENCES Cities(city) ON DELETE SET NULL
);

CREATE TABLE Events (
	eid INTEGER,
	address VARCHAR(50),
	rnum INTEGER,
	date_and_time TIMESTAMP,
	duration INTEGER,
	PRIMARY KEY (eid),
	FOREIGN KEY (address, rnum) REFERENCES Rinks(address, rnum) ON DELETE CASCADE,
	UNIQUE (address, rnum, date_and_time)
);

CREATE TABLE Teams (
	tid INTEGER,
	name VARCHAR(50),
	num_wins INTEGER,
	num_losses INTEGER,
	city VARCHAR(20),
	PRIMARY KEY (tid),
	FOREIGN KEY (city) REFERENCES Cities(city) ON DELETE SET NULL
);

CREATE TABLE Sponsorship (
	sid INTEGER,
	tid INTEGER,
	sign_date DATE,
	donation INTEGER,
	PRIMARY KEY (sid, tid),
	FOREIGN KEY (sid) REFERENCES Sponsors(sid) ON DELETE CASCADE,
	FOREIGN KEY (tid) REFERENCES Teams(tid) ON DELETE CASCADE
);

CREATE TABLE Manages (
	mid INTEGER,
	tid INTEGER,
	sign_date DATE,
	salary INTEGER,
	PRIMARY KEY (mid),
	UNIQUE (tid),
	FOREIGN KEY (mid) REFERENCES Managers(mid) ON DELETE CASCADE,
	FOREIGN KEY (tid) REFERENCES Teams(tid) ON DELETE CASCADE
);

CREATE TABLE Coaches_for (
	cid INTEGER,
	tid INTEGER,
	sign_date DATE,
	salary INTEGER,
	PRIMARY KEY (cid),
	FOREIGN KEY (cid) REFERENCES Coaches(cid) ON DELETE CASCADE,
	FOREIGN KEY (tid) REFERENCES Teams(tid) ON DELETE CASCADE
);

CREATE TABLE Referees_at (
	rid INTEGER,
	address VARCHAR(50),
	sign_date DATE,
	salary INTEGER,
	PRIMARY KEY (rid),
	FOREIGN KEY (rid) REFERENCES Referees(rid) ON DELETE CASCADE,
	FOREIGN KEY (address) REFERENCES Venues(address) ON DELETE CASCADE
);

CREATE TABLE Plays_with (
	pid INTEGER,
	tid INTEGER,
	sign_date DATE,
	salary INTEGER,
	PRIMARY KEY (pid),
	FOREIGN KEY (pid) REFERENCES Players(pid) ON DELETE CASCADE,
	FOREIGN KEY (tid) REFERENCES Teams(tid) ON DELETE CASCADE
);

CREATE TABLE Participates_in (
	pid INTEGER,
	eid INTEGER,
	num_goals INTEGER,
	time_played INTEGER,
	PRIMARY KEY (pid, eid),
	FOREIGN KEY (pid) REFERENCES Players(pid) ON DELETE CASCADE,
	FOREIGN KEY (eid) REFERENCES Events(eid) ON DELETE CASCADE
);

CREATE TABLE Games (
	eid INTEGER,
	tid_1 INTEGER,
	tid_2 INTEGER,
	winner INTEGER,
	PRIMARY KEY (eid),
	FOREIGN KEY (tid_1) REFERENCES Teams(tid) ON DELETE SET NULL,
	FOREIGN KEY (tid_2) REFERENCES Teams(tid) ON DELETE SET NULL,
	FOREIGN KEY (eid) REFERENCES Events(eid) ON DELETE CASCADE
);

CREATE TABLE Practices (
	eid INTEGER,
	tid INTEGER,
	PRIMARY KEY (eid),
	FOREIGN KEY (eid) REFERENCES Events(eid) ON DELETE CASCADE,
	FOREIGN KEY (tid) REFERENCES Teams(tid) ON DELETE CASCADE
);

INSERT INTO Sponsors(sid, name)
VALUES 
(1, 'Jeremy Clarkson'),
(2, 'James May'),
(3, 'Richard Hammond'),
(4, 'Queen Elizabeth'),
(5, 'Rowan Atkinson');

INSERT INTO Managers(mid, name, birthday)
VALUES
(1, 'Naomi Nagata', '1970-01-01'),
(2, 'James Holden', '1970-01-01'),
(3, 'Amos Burton', '1970-01-01'),
(4, 'Alex Kamal', '1970-01-01'),
(5, 'Bobbie Draper', '1970-01-01');

INSERT INTO Coaches(cid, name, birthday)
VALUES
(1, 'Bryan Edgecombe', '1970-01-01'),
(2, 'Sean Bocirnea', '1970-01-01'),
(3, 'William Chen', '1970-01-01'),
(4, 'Robert Paulson', '1970-01-01'),
(5, 'Gilbert Gottfried', '1970-01-01');

INSERT INTO Referees(rid, name, birthday)
VALUES
(1, 'Harry Potter', '1970-01-010'),
(2, 'Hermionie Granger', '1970-01-01'),
(3, 'Ronald Weasley', '1970-01-01'),
(4, 'Rubeus Hagrid', '1970-01-01'),
(5, 'Draco Malfoy', '1970-01-01');

INSERT INTO Players(pid, name, birthday, total_goals, position)
VALUES
(1, 'Albert Albertson', '1970-01-01', 4, "goalie"),
(2, 'Todd Toddson', '1970-01-01', 1024, "offense"),
(3, 'Matt Mattson', '1970-01-01', 2048, "offense"),
(4, 'John Johnson', '1970-01-01', 256, "defense"),
(5, 'Pat Patterson', '1970-01-01', 512, "defense");

INSERT INTO Cities(city, country)
VALUES
('Vancouver', 'Canada'),
('Calgary', 'Canada'),
('Toronto', 'Canada'),
('Chumpsterfire', 'United Kingdom'),
('Earth', 'U.S.A.');

INSERT INTO Teams(tid, name, num_wins, num_losses, city)
VALUES
(1001, 'Canucks', 1258, 2000, 'Vancouver'),
(1002, 'Flames', 1024, 4012, 'Calgary'),
(1003, 'Maple Leaves', 17909, 14402, 'Toronto'),
(1004, 'Thumb Suckers', 20, 100000, 'Chumpsterfire'),
(1005, 'Comp-Sci Majors', 0, 1, 'Earth');

INSERT INTO Venues(address, name, capacity, city)
VALUES
('123 Granville St.', 'Corporate Arena', 2000, 'Vancouver'),
('987 Main St.', 'Suckers Stadium', 1000, 'Calgary'),
('4022 16th Ave.', 'The Place', 420, 'Vancouver'),
('5423 18th Ave.', 'The Other Place', 420, 'Vancouver'),
('123 Main St.', 'Moms Basement', 1, 'Toronto');

INSERT INTO Rink_sizes(rink_standard, rink_width, rink_length)
VALUES
('North American', 85, 200),
('Odd', 73.9, 199.9),
('Even', 84.8, 202.2),
('European', 85, 200),
('International', 85, 200);

INSERT INTO Rinks(address, rnum, rink_standard, city)
VALUES
('123 Granville St.', 1, 'North American', 'Vancouver'),
('987 Main St.', 1, 'North American', 'Calgary'),
('4022 16th Ave.', 1, 'North American', 'Vancouver'),
('4022 16th Ave.', 3, 'Odd', 'Vancouver'),
('123 Main St.', 1, 'International', 'Toronto');

INSERT INTO Events(eid, address, rnum, date_and_time, duration)
VALUES
(1, '123 Granville St.', 1, '2021-01-10 16:00:00', 120),
(2, '987 Main St.', 1, '2021-03-14 16:00:00', 120),
(3, '4022 16th Ave.', 1, '2021-08-01 16:00:00', 120),
(4, '4022 16th Ave.', 3, '2021-08-01 16:00:00', 90),
(5, '123 Main St.', 1, '2021-08-01 18:00:00', 120);

INSERT INTO Games(eid, tid_1, tid_2, winner)
VALUES
(1, 1001, 1002, 1002),
(2, 1002, 1004, 1002),
(3, 1003, 1001, 1003),
(4, 1004, 1005, 1005),
(5, 1005, 1002, 1002);

INSERT INTO Practices(eid, tid)
VALUES
(1, 1001),
(2, 1002),
(3, 1003),
(4, 1004),
(5, 1001);

INSERT INTO Sponsorship(sid, tid, donation)
VALUES
(1, 1001, 1),
(1, 1002, 4),
(3, 1001, 42),
(4, 1004, 1337),
(5, 1005, 1738);

INSERT INTO Manages(mid, tid, sign_date, salary)
VALUES
(1, 1003, '1970-01-01', 1),
(2, 1004, '1970-01-01', 4),
(3, 1002, '1970-01-01', 42),
(4, 1005, '1970-01-01', 1337),
(5, 1001, '1970-01-01', 1738);

INSERT INTO Coaches_for(cid, tid, sign_date, salary)
VALUES
(1, 1003, '1970-01-01', 1),
(2, 1004, '1970-01-01', 4),
(3, 1002, '1970-01-01', 42),
(4, 1005, '1970-01-01', 1337),
(5, 1001, '1970-01-01', 1738);

INSERT INTO Referees_at(rid, address, sign_date, salary)
VALUES
(1, '123 Granville St.', '1970-01-01', 1),
(2, '987 Main St.', '1970-01-01', 4),
(3, '4022 16th Ave.', '1970-01-01', 42),
(4, '5423 18th Ave.', '1970-01-01', 1337),
(5, '123 Main St.', '1970-01-01', 1738);

INSERT INTO Plays_with(pid, tid, sign_date, salary)
VALUES
(1, 1003, '1970-01-01', 1),
(2, 1004, '1970-01-01', 4),
(3, 1002, '1970-01-01', 42),
(4, 1005, '1970-01-01', 1337),
(5, 1001, '1970-01-01', 1738);

INSERT INTO Participates_in(pid, eid, num_goals, time_played)
VALUES
(1, 1, 1, 30),
(2, 1, 2, 90),
(3, 2, 0, 120),
(4, 2, 4, 90),
(5, 4, 3, 60);