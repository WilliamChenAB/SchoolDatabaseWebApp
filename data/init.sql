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
	birthday INTEGER,
	PRIMARY KEY (mid)
);

CREATE TABLE Coaches (
	cid INTEGER,
	name VARCHAR(50),
	birthday INTEGER,
	PRIMARY KEY (cid)
);

CREATE TABLE Referees (
	rid INTEGER,
	name VARCHAR(50),
	birthday INTEGER,
	PRIMARY KEY (rid)
);

CREATE TABLE Players (
	pid INTEGER,
	name VARCHAR(50),
	birthday INTEGER,
	total_goals INTEGER,
	position VARCHAR(20),
	PRIMARY KEY (pid)
);

CREATE TABLE Venues (
	address VARCHAR(50),
	name VARCHAR(50),
	capacity INTEGER,
	PRIMARY KEY (address)
);

CREATE TABLE Rinks(
	address VARCHAR(50),
	rnum INTEGER,
	rink_standard VARCHAR(50),
	rink_width FLOAT,
	rink_length FLOAT,
	PRIMARY KEY (address, rnum),
	FOREIGN KEY (address) REFERENCES Venues ON DELETE CASCADE
);

CREATE TABLE Events (
	eid INTEGER,
	address VARCHAR(50),
	rnum INTEGER,
	date_and_time TIMESTAMP,
	duration INTERVAL,
	PRIMARY KEY (eid),
	FOREIGN KEY (address, rnum) REFERENCES Rinks ON DELETE CASCADE,
	UNIQUE (address, rnum, date_and_time)
);

CREATE TABLE Teams (
	tid INTEGER,
	name VARCHAR(50),
	num_wins INTEGER,
	num_losses INTEGER,
	city VARCHAR(20),
	country VARCHAR(20),
	PRIMARY KEY (tid)
);

CREATE TABLE Sponsorship (
	sid INTEGER,
	tid INTEGER,
	sign_date INTEGER,
	donation INTEGER,
	PRIMARY KEY (sid, tid),
	FOREIGN KEY (sid) REFERENCES Sponsors ON DELETE CASCADE,
	FOREIGN KEY (tid) REFERENCES Teams ON DELETE CASCADE
);

CREATE TABLE Manages (
	mid INTEGER,
	tid INTEGER,
	sign_date INTEGER,
	salary INTEGER,
	PRIMARY KEY (mid),
	UNIQUE (tid),
	FOREIGN KEY (mid) REFERENCES Managers ON DELETE CASCADE,
	FOREIGN KEY (tid) REFERENCES Teams ON DELETE CASCADE
);

CREATE TABLE Coaches_for (
	cid INTEGER,
	tid INTEGER,
	sign_date INTEGER,
	salary INTEGER,
	PRIMARY KEY (cid),
	FOREIGN KEY (cid) REFERENCES Coaches ON DELETE CASCADE,
	FOREIGN KEY (tid) REFERENCES Teams ON DELETE CASCADE
);

CREATE TABLE Referees_at (
	rid INTEGER,
	address VARCHAR(50),
	sign_date INTEGER,
	salary INTEGER,
	PRIMARY KEY (rid),
	FOREIGN KEY (rid) REFERENCES Referees ON DELETE CASCADE,
	FOREIGN KEY (address) REFERENCES Venues ON DELETE CASCADE
);

CREATE TABLE Plays_with (
	pid INTEGER,
	tid INTEGER,
	sign_date INTEGER,
	salary INTEGER,
	PRIMARY KEY (pid),
	FOREIGN KEY (pid) REFERENCES Players ON DELETE CASCADE,
	FOREIGN KEY (tid) REFERENCES Teams ON DELETE CASCADE
);

CREATE TABLE Participates_in (
	pid INTEGER,
	eid INTEGER,
	num_goals INTEGER,
	time_played INTERVAL,
	PRIMARY KEY (pid, eid),
	FOREIGN KEY (pid) REFERENCES Players ON DELETE CASCADE,
	FOREIGN KEY (eid) REFERENCES Events ON DELETE CASCADE
);

CREATE TABLE Games (
	eid INTEGER,
	tid_1 INTEGER,
	tid_2 INTEGER,
	winner INTEGER,
	PRIMARY KEY (eid),
	FOREIGN KEY (tid_1) REFERENCES Teams ON DELETE CASCADE,
	FOREIGN KEY (tid_2) REFERENCES Teams ON DELETE CASCADE,
	FOREIGN KEY (eid) REFERENCES Events ON DELETE CASCADE
);

CREATE TABLE Practices (
	eid INTEGER,
	tid INTEGER,
	PRIMARY KEY (eid),
	FOREIGN KEY (eid) REFERENCES Events ON DELETE CASCADE,
	FOREIGN KEY (tid) REFERENCES Teams ON DELETE CASCADE
);
